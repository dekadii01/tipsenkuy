<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Dashboard User">
    <x-navbar-auth-user />

    <main class="max-w-5xl mx-auto px-6 py-10 flex flex-col gap-6">
        <section class="flex items-start justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-2xl font-light tracking-tight text-gray-900">
                    Halo, <span class="font-medium">{{ auth()->user()->first_name ?? 'User' }}</span> 👋
                </h1>
                <p class="text-xs font-light text-gray-400 mt-1 tracking-wide">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <span
                class="text-[0.65rem] font-light tracking-widest uppercase text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-3 py-1">
                Participant
            </span>
        </section>


        @php $isPresent = true; @endphp

        <section>
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                <div @class([
                    'h-[3px]',
                    'bg-green-600' => $isPresent,
                    'bg-red-500' => !$isPresent,
                ])></div>

                <div class="p-7">
                    <div class="flex items-start justify-between flex-wrap gap-4">

                        <div class="flex flex-col gap-3">

                            <div class="flex items-center gap-2.5">
                                <div @class([
                                    'w-2.5 h-2.5 rounded-full shrink-0 animate-pulse',
                                    'bg-green-600 shadow-[0_0_0_4px_rgba(22,163,74,0.15)]' => $isPresent,
                                    'bg-red-500   shadow-[0_0_0_4px_rgba(220,38,38,0.15)]' => !$isPresent,
                                ])></div>
                                <span @class([
                                    'text-[0.7rem] font-light tracking-widest uppercase',
                                    'text-green-700' => $isPresent,
                                    'text-red-600' => !$isPresent,
                                ])>
                                    {{ $isPresent ? 'Hadir' : 'Belum absen' }}
                                </span>
                            </div>

                            <p class="text-2xl font-light leading-snug tracking-tight text-gray-900">
                                @if ($isPresent)
                                    Sudah absen<br>
                                    <span class="font-medium">hari ini ✓</span>
                                @else
                                    Kamu belum<br>
                                    <span class="font-medium">absen hari ini</span>
                                @endif
                            </p>

                            @if ($isPresent)
                                <div class="flex flex-wrap gap-2 mt-1">
                                    <div
                                        class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                                stroke-width="1.2" />
                                            <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span class="text-[0.72rem] font-light text-gray-500">
                                            08:42 WIB
                                        </span>
                                    </div>
                                    <div
                                        class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <rect x="1.5" y="2.5" width="9" height="8" rx="1.5"
                                                stroke="currentColor" stroke-width="1.2" />
                                            <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor"
                                                stroke-width="1.2" stroke-linecap="round" />
                                        </svg>
                                        <span class="text-[0.72rem] font-light text-gray-500">
                                            Sesi Pagi — Kelas A
                                        </span>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div @class([
                            'w-[72px] h-[72px] rounded-[18px] shrink-0 flex items-center justify-center border',
                            'bg-green-50 border-green-200' => $isPresent,
                            'bg-red-50   border-red-200' => !$isPresent,
                        ])>
                            @if ($isPresent)
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    class="text-green-600">
                                    <path d="M6 17l8 8L26 9" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @else
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    class="text-red-500">
                                    <path d="M8 8l16 16M24 8L8 24" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="grid grid-cols-2 gap-3">

                <a href="{{ route('attendance.scan') }}"
                    class="flex flex-col items-center justify-center gap-2.5 px-4 py-5 bg-blue-900 hover:bg-blue-950 text-white rounded-2xl transition-all duration-200 hover:-translate-y-px no-underline">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <rect x="2" y="2" width="8" height="8" rx="1.5" stroke="white"
                                stroke-width="1.5" />
                            <rect x="12" y="2" width="8" height="8" rx="1.5" stroke="white"
                                stroke-width="1.5" />
                            <rect x="2" y="12" width="8" height="8" rx="1.5" stroke="white"
                                stroke-width="1.5" />
                            <path d="M13 16h2M16 13v2M16 16v2M19 16h-2" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-medium">Scan QR</p>
                        <p class="text-[0.7rem] font-light text-white/60 mt-0.5">Absen sekarang</p>
                    </div>
                </a>

                <a href="{{ route('my-sessions') }}"
                    class="flex flex-col items-center justify-center gap-2.5 px-4 py-5 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 rounded-2xl transition-all duration-200 hover:-translate-y-px no-underline">

                    <div
                        class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-200 flex items-center justify-center">

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="text-blue-900">
                            <rect x="3" y="4" width="14" height="13" rx="2" stroke="currentColor"
                                stroke-width="1.4" />
                            <path d="M3 7h14" stroke="currentColor" stroke-width="1.4" />
                            <path d="M7 2v4M13 2v4" stroke="currentColor" stroke-width="1.4"
                                stroke-linecap="round" />
                        </svg>

                    </div>

                    <div class="text-center">
                        <p class="text-sm font-medium text-gray-900">Sesi Saya</p>
                        <p class="text-[0.7rem] font-light text-gray-400 mt-0.5">
                            Lihat sesi yang tersedia
                        </p>
                    </div>

                </a>

            </div>
        </section>


        <section>
            <div class="grid grid-cols-3 gap-3">

                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">
                        {{ $presentCount }}</p>
                    <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Hari hadir<br>bulan ini</p>
                    <div class="mt-3 h-0.75 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full w-[{{ min(100, ($presentCount / 30) * 100) }}%] bg-green-500 rounded-full">
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">{{ $sessionTotal }}
                    </p>
                    <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Total sesi<br>diikuti</p>
                    <div class="mt-3 h-0.75 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full w-[{{ min(100, ($sessionTotal / 30) * 100) }}%] bg-blue-500 rounded-full">
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">
                        {{ $attendanceRate }}<span class="text-base text-gray-400">%</span>
                    </p>
                    <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Tingkat<br>kehadiran</p>
                    <div class="mt-3 h-0.75 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full w-[{{ $attendanceRate }}%] bg-green-500 rounded-full"></div>
                    </div>
                </div>

            </div>
        </section>


        <section>
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                <div class="px-6 pt-5 pb-4 flex items-center justify-between border-b border-gray-100">
                    <div>
                        <h2 class="text-sm font-medium text-gray-900">Riwayat Terbaru</h2>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">{{ $history->count() }} absensi
                            terakhir</p>
                    </div>
                    <a href="{{ route('attendance.user.history') }}"
                        class="flex items-center
                        gap-1 text-[0.75rem] font-normal text-blue-900 hover:opacity-70 transition-opacity
                        no-underline">
                        Lihat semua
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor" stroke-width="1.2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>

                <div class="px-6">
                    @foreach ($history as $record)
                        <div @class([
                            'flex items-center gap-3.5 py-3.5',
                            'border-b border-gray-100' => !$loop->last,
                        ])>

                            <div @class([
                                'w-9 h-9 rounded-xl border flex items-center justify-center shrink-0',
                                'bg-green-50 border-green-200' => $record->status === 'present',
                                'bg-red-50 border-red-200' => $record->status === 'absent',
                                'bg-yellow-50 border-yellow-200' => in_array($record->status, [
                                    'sick',
                                    'permit',
                                ]),
                            ])>

                                @if ($record->status === 'present')
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        class="text-green-600">
                                        <path d="M4 8l3 3 5-5" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                @elseif ($record->status === 'absent')
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        class="text-red-500">
                                        <path d="M5 5l6 6M11 5l-6 6" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" />
                                    </svg>
                                @else
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        class="text-yellow-600">
                                        <circle cx="8" cy="8" r="5" stroke="currentColor"
                                            stroke-width="1.4" />
                                    </svg>
                                @endif

                            </div>

                            <div class="flex-1 min-w-0">
                                <a href="{{ route('session.detail', $record->session->id) }}"
                                    class="text-sm font-normal text-gray-800 truncate">
                                    {{ $record->session->nama_sesi }}
                                </a>
                                <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">
                                    {{ $record->session->tanggal->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            <div class="text-right shrink-0">
                                <span class="text-[0.72rem] font-light text-gray-400">
                                    {{ $record->session->jam_mulai }} – {{ $record->session->jam_selesai }}
                                </span>

                                <div @class([
                                    'text-[0.6rem] font-light tracking-widest uppercase px-2 py-0.5 rounded-full mt-1 border text-center',
                                    'bg-green-50 border-green-200 text-green-700' =>
                                        $record->status === 'present',
                                    'bg-red-50 border-red-200 text-red-600' => $record->status === 'absent',
                                    'bg-yellow-50 border-yellow-200 text-yellow-700' => in_array(
                                        $record->status,
                                        ['sick', 'permit']),
                                ])>
                                    {{ strtoupper($record->status) }}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </section>


        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>

    </main>
</x-layout-main>
