<?php
use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $query = '';

    public function render()
    {
        $history = Attendance::with('session')
            ->where('user_id', Auth::id())

            ->when($this->query, function ($query) {
                $query->whereHas('session', function ($query2) {
                    $query2->where('nama_sesi', 'like', '%' . $this->query . '%');
                });
            })

            ->latest('scanned_at')
            ->limit(10)
            ->get();

        return view('components.search-session-history', compact('history'));
    }
};
?>
<div class="">

    <div class=" w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
            <svg width="13" height="13" viewBox="0 0 14 14" fill="none" class="text-gray-400">
                <circle cx="6" cy="6" r="4" stroke="currentColor" stroke-width="1.3" />
                <path d="M10 10l2 2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
            </svg>
        </div>
        <input type="text" name="search" wire:model.live="query" placeholder="Cari nama sesi..."
            class="w-full pl-9 pr-4 py-2.5 text-sm font-light text-gray-900 bg-white border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-100 transition-all duration-200">
    </div>
    <div class="">
        @if ($query)
            <div class="bg-white border border-gray-200 mt-3 rounded-2xl overflow-hidden">
                @foreach ($history as $item)
                    <a href="{{ route('session.detail', $item->session->id) }}">

                        <div @class([
                            'flex items-center gap-4 px-5 py-4',
                            'border-b border-gray-100' => !$loop->last,
                        ])>
                            <div @class([
                                'w-9 h-9 rounded-xl border flex items-center justify-center shrink-0',
                                'bg-gray-50  border-gray-200' => $item->status === 'present',
                                'bg-red-50   border-red-200' => !$item->status === 'present',
                            ])>
                                @if ($item->status === 'present')
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        class="text-blue-900">
                                        <path d="M4 8l3 3 5-5" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                @else
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        class="text-red-500">
                                        <path d="M5 5l6 6M11 5l-6 6" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" />
                                    </svg>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-normal text-gray-800 truncate">{{ $item->session->nama_sesi }}
                                </p>
                                <p @class([
                                    'text-[0.7rem] font-light mt-0.5',
                                    'text-gray-400' => $item->status === 'present',
                                    'text-red-400' => !$item->status === 'present',
                                ])>{{ $item->session->deskripsi }}</p>
                            </div>

                            <div class="flex flex-col items-end gap-1 shrink-0">
                                <span
                                    class="text-[0.72rem] font-light text-gray-400">{{ $item->session->jam_mulai }}</span>
                                <div @class([
                                    'text-[0.6rem] font-light tracking-widest uppercase px-2 py-0.5 rounded-full border',
                                    'bg-green-50 border-green-200 text-green-700' =>
                                        $item->status === 'present',
                                    'bg-red-50   border-red-200   text-red-600' => !$item->status === 'present',
                                ])>
                                    {{ $item->status === 'present' ? 'HADIR' : 'ABSEN' }}
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    </div>

</div>
