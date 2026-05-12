<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassSession;
use App\Models\QrsSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function dashboard()
    {
        $allStudent = User::where('role', 'user')->count();
        $sessions   = ClassSession::all();

        $activeCount  = ClassSession::where('status', 'active')->count();
        $presentCount = Attendance::whereDate('created_at', today())->count();

        $recentScans = Attendance::with('user', 'session')
            ->latest()
            ->take(5)
            ->get();

        return view('admin/index', [
            'allStudent'   => $allStudent,
            'sessions'     => $sessions,
            'activeCount'  => $activeCount,
            'presentCount' => $presentCount,
            'recentScans'  => $recentScans,
        ]);
    }

    public function profile()
    {
        return view('admin/profile');
    }

    public function indexDiscussion()
    {
        return view('admin/discussion/index');
    }

    //Update profil admin (nama & email)
    public function updateProfile(Request $request)
    {        /** @var User $admin */
        $admin = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $admin->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }



    //Update Password Admin
    public function updatePassword(Request $request)
    {        /** @var User $admin */
        $admin = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'new_password_confirmation' => 'required|same:new_password',
        ]);


        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $admin->update([
            'password' => Hash::make($request->new_password)
        ]);


        return back()->with('success', 'Password berhasil diperbarui.');
    }


    public function endSession(ClassSession $session)
    {
        if ($session->status === 'ended') {
            return back()->withErrors(['message' => 'Sesi sudah berakhir.']);
        }

        // Nonaktifkan semua QR aktif
        QrsSession::where('session_id', $session->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $session->update(['status' => 'ended']);

        return back()->with('success', 'Sesi berhasil diakhiri.');
    }

    public function startSession(ClassSession $session)
    {
        if ($session->status === 'active') {
            return back()->withErrors(['message' => 'Sesi sudah aktif.']);
        }

        $session->update(['status' => 'active']);

        // update qr session yang sudah tidak aktif menjadi aktif
        QrsSession::where('session_id', $session->id)
            ->where('is_active', false)
            ->update(['is_active' => true]);

        $session->update(['started_at' => now()]);

        return back()->with('success', 'Sesi berhasil dimulai.');
    }

    public function showAttendanceDetail($id)
    {
        $session = ClassSession::findOrFail($id);
        // dd($session->status, Carbon::now(), Carbon::parse("{$session->tanggal->format('Y-m-d')} {$session->jam_mulai}"));
        $activeQr = QrsSession::where('session_id', $session->id)
            ->where('is_active', true)
            ->where('expired_at', '>', now())
            ->latest()
            ->first();

        $qrSvg = null;

        if ($activeQr) {
            $qrUrl = url('/scan?token='.$activeQr->token);
            $qrSvg = QrCode::size(220)->generate($qrUrl);
        }

        $allStudent = User::where('role', 'user')->count();
        $allStudentname = User::where('role', 'user')->get();
        $attendances = $session->attendances()->with('user')->latest()->get();
        $presentCount = $attendances->count();

        return view('admin.attendance.detail', compact(
            'session',
            'allStudent',
            'presentCount',
            'attendances',
            'qrSvg',
            'activeQr',
            'allStudentname'
        ));
    }

    public function attendanceIndex(Request $request)
    {

        $filteredSessions = $request->get('filter', 'all');
        $sessions = ClassSession::withCount([
            'attendances as present_count' => function ($query) {
                $query->where('status', 'present');
            },
        ])
            ->when($filteredSessions === 'aktif', function ($query) {
                $query->where('status', 'active');
            })->when($filteredSessions === 'selesai', function ($query) {
                $query->where('status', 'ended');
            })->when($filteredSessions === 'hari-ini', function ($query) {
                $query->whereDate('tanggal', Carbon::today());
            })
            ->get();
        $totalUsers = User::where('role', 'user')->count();

        return view('admin.attendance.index', compact('sessions', 'totalUsers'));
    }

    public function showCreateAttendance()
    {
        return view('admin.attendance.create');
    }

    public function createAttendance(Request $request)
    {
        $validated = $request->validate([
            'nama_sesi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        ClassSession::create($validated);

        return redirect()->route('admin.attendance.index')->with('success', 'Sesi berhasil dibuat!');
    }

    // public funtion searchAttendance(Request $request)
    // {
    //     $query = $request->input('query');
    //     $sessions = ClassSession::where('nama_sesi', 'like', '%' . $query . '%')->get();
    //     return view('admin.attendance.index', compact('sessions'));
    // }
}
