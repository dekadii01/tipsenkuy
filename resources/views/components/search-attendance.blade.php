<?php

use Livewire\Component;
use App\Models\ClassSession;

new class extends Component {
    public $query = '';

    public function render()
    {
        $sessions = ClassSession::query()
            ->when($this->query, function ($q) {
                $q->where('nama_sesi', 'like', '%' . $this->query . '%');
            })
            ->limit(10)
            ->get();

        return view('components.search-attendance', compact('sessions'));
    }
};
?>

<div class="w-full">
    <input type="text" wire:model.live="query" placeholder="Cari nama sesi..."
        class="w-full pl-9 pr-4 py-2.5 text-sm font-light text-gray-900 bg-white border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-100 transition-all duration-200">
    @if ($query)
        <div class="">
            @forelse($sessions as $session)
                <div
                    class="bg-white border border-gray-200 mt-5 rounded-2xl overflow-hidden hover:border-gray-300 transition-colors">
                    <div class="flex">

                        <div @class([
                            'w-[3px] shrink-0',
                            'bg-green-500' => $session['status'] === 'active',
                            'bg-yellow-400' => $session['status'] === 'pending',
                            'bg-gray-200' => $session['status'] === 'ended',
                        ])></div>

                        <div class="flex-1 px-5 py-4 flex flex-col sm:flex-row sm:items-center gap-4">

                            <div class="flex-1 min-w-0 flex flex-col gap-1.5">

                                <div class="flex items-center gap-2.5 flex-wrap">
                                    <p class="text-sm font-medium text-gray-900">{{ $session['nama_sesi'] }}</p>

                                    <div @class([
                                        'flex items-center gap-1.5 px-2 py-0.5 rounded-full border text-[0.65rem] font-light',
                                        'bg-green-50  border-green-200  text-green-700' =>
                                            $session['status'] === 'active',
                                        'bg-yellow-50 border-yellow-200 text-yellow-700' =>
                                            $session['status'] === 'pending',
                                        'bg-gray-100  border-gray-200   text-gray-400' =>
                                            $session['status'] === 'ended',
                                    ])>
                                        <span @class([
                                            'w-1 h-1 rounded-full',
                                            'bg-green-500 animate-pulse' => $session['status'] === 'active',
                                            'bg-yellow-400' => $session['status'] === 'pending',
                                            'bg-gray-400' => $session['status'] === 'ended',
                                        ])></span>
                                        @if ($session['status'] === 'active')
                                            Aktif
                                        @elseif ($session['status'] === 'pending')
                                            Menunggu
                                        @else
                                            Selesai
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <div class="flex items-center gap-1">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <rect x="1.5" y="2.5" width="9" height="8" rx="1.5"
                                                stroke="currentColor" stroke-width="1.2" />
                                            <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor"
                                                stroke-width="1.2" stroke-linecap="round" />
                                        </svg>
                                        <span
                                            class="text-[0.72rem] font-light text-gray-400">{{ $session['tanggal'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                                stroke-width="1.2" />
                                            <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span
                                            class="text-[0.72rem] font-light text-gray-400">{{ $session['jam_mulai'] }}
                                            WIB</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <circle cx="6" cy="4" r="2" stroke="currentColor"
                                                stroke-width="1.2" />
                                            <path d="M2 10c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                                stroke-width="1.2" stroke-linecap="round" />
                                        </svg>

                                    </div>
                                </div>

                                <div class="w-full sm:w-48 h-[3px] rounded-full bg-gray-100 overflow-hidden mt-0.5">
                                    <div @class([
                                        'h-full rounded-full',
                                        'bg-blue-900' => $session['status'] === 'active',
                                        'bg-gray-300' => $session['status'] !== 'active',
                                    ])
                                        style="width: {{ $session['total'] > 0 ? round(($session['present'] / $session['total']) * 100) : 0 }}%">
                                    </div>
                                </div>

                            </div>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 shrink-0">

                                @if ($session['status'] === 'pending')
                                    <form method="POST" action="{{ route('admin.sessions.start', $session['id']) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                            <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                                <path d="M3 2.5l7 3.5-7 3.5V2.5z" fill="currentColor" />
                                            </svg>
                                            Mulai Sesi
                                        </button>
                                    </form>
                                @elseif ($session['status'] === 'active')
                                    <form method="POST" action="{{ route('admin.sessions.end', $session['id']) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                            <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                                <rect x="2.5" y="2.5" width="7" height="7" rx="1.5"
                                                    fill="currentColor" />
                                            </svg>
                                            Akhiri Sesi
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.attendance.detail', $session['id']) }}"
                                    class="flex items-center justify-center gap-1.5 px-4 py-2 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-xl transition-all duration-200 no-underline">
                                    Detail
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                        <path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="p-3 text-sm text-gray-400">
                    Tidak ada sesi ditemukan
                </div>
            @endforelse
        </div>
    @endif

    <!-- ⏳ Loading -->
    <div wire:loading class="text-sm text-gray-400 mt-2">
        Searching...
    </div>
</div>
