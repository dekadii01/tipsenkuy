<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Riwayat Absensi">

    <x-navbar-auth-user />

    <main class="max-w-5xl mx-auto px-6 py-10 flex flex-col gap-6">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-1.5 flex-wrap">
            <a href="{{ route('dashboard-user') }}"
                class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                Dashboard
            </a>
            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <a href="{{ route('attendance.user.history') }}"
                class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                History Absensi
            </a>

        </nav>

        <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-light tracking-tight text-gray-900">
                    Riwayat <span class="font-medium">Absensi</span>
                </h1>
                <p class="text-xs font-light text-gray-400 mt-1 tracking-wide">
                    Seluruh catatan kehadiranmu
                </p>
            </div>
            <span
                class="text-[0.65rem] font-light tracking-widest uppercase text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-3 py-1 self-start sm:self-auto">
                Participant
            </span>
        </section>


        <section class="grid grid-cols-3 gap-3">

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">18</p>
                <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Hari hadir<br>bulan ini</p>
                <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full w-3/4 bg-blue-900 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">24</p>
                <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Total sesi<br>diikuti</p>
                <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full w-[60%] bg-blue-200 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">
                    96<span class="text-base text-gray-400">%</span>
                </p>
                <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Tingkat<br>kehadiran</p>
                <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full w-[96%] bg-green-500 rounded-full"></div>
                </div>
            </div>

        </section>


        <section class="flex flex-col sm:flex-row gap-3">

            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg width="13" height="13" viewBox="0 0 14 14" fill="none" class="text-gray-400">
                        <circle cx="6" cy="6" r="4" stroke="currentColor" stroke-width="1.3" />
                        <path d="M10 10l2 2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                    </svg>
                </div>
                <input type="text" name="search" placeholder="Cari nama sesi..."
                    class="w-full pl-9 pr-4 py-2.5 text-sm font-light text-gray-900 bg-white border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-100 transition-all duration-200">
            </div>

            <div class="flex items-center gap-1.5 p-1 bg-white border border-gray-200 rounded-xl shrink-0">
                @foreach ([['all', 'Semua', true], ['hadir', 'Hadir', false], ['absen', 'Absen', false]] as [$val, $label, $active])
                    <a href="{{ request()->fullUrlWithQuery(['filter' => $val]) }}" @class([
                        'px-3 py-1.5 rounded-lg text-xs font-normal transition-all duration-150 no-underline',
                        'bg-blue-900 text-white' => $active,
                        'text-gray-500 hover:text-gray-800' => !$active,
                    ])>
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="shrink-0">
                <select name="bulan"
                    class="w-full sm:w-auto px-4 py-2.5 text-sm font-light text-gray-700 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-100 transition-all duration-200 appearance-none cursor-pointer">
                    <option value="">Semua bulan</option>
                    <option value="4" selected>April 2026</option>
                    <option value="3">Maret 2026</option>
                    <option value="2">Februari 2026</option>
                    <option value="1">Januari 2026</option>
                </select>
            </div>

        </section>


        <section class="flex flex-col gap-4">

            <p class="text-[0.72rem] font-light text-gray-400">
                Menampilkan <span class="font-medium text-gray-600">24</span> catatan
            </p>

            @foreach ([
        [
            'label' => 'Senin, 5 April 2026',
            'records' => [['Sesi Pagi — Kelas A', '08:42', true, 'Hadir tepat waktu'], ['Sesi Siang — Kelas A', '13:05', true, 'Hadir tepat waktu']],
        ],
        [
            'label' => 'Kamis, 3 April 2026',
            'records' => [['Sesi Pagi — Workshop', '—', false, 'Tidak hadir']],
        ],
        [
            'label' => 'Rabu, 2 April 2026',
            'records' => [['Sesi Pagi — Kelas A', '08:55', true, 'Hadir tepat waktu']],
        ],
        [
            'label' => 'Selasa, 1 April 2026',
            'records' => [['Sesi Siang — Kelas B', '12:58', true, 'Hadir tepat waktu'], ['Sesi Pagi — Kelas A', '08:31', true, 'Hadir tepat waktu']],
        ],
        [
            'label' => 'Jumat, 28 Maret 2026',
            'records' => [['Sesi Pagi — Kelas A', '09:12', true, 'Terlambat'], ['Sesi Siang — Workshop', '—', false, 'Tidak hadir']],
        ],
        [
            'label' => 'Kamis, 27 Maret 2026',
            'records' => [['Sesi Pagi — Kelas A', '08:03', true, 'Hadir tepat waktu']],
        ],
    ] as $group)
                <div class="flex items-center gap-3">
                    <span class="text-[0.7rem] font-normal text-gray-400 shrink-0">
                        {{ $group['label'] }}
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    @foreach ($group['records'] as $i => [$session, $time, $present, $note])
                        <div @class([
                            'flex items-center gap-4 px-5 py-4',
                            'border-b border-gray-100' => !$loop->last,
                        ])>
                            <div @class([
                                'w-9 h-9 rounded-xl border flex items-center justify-center shrink-0',
                                'bg-gray-50  border-gray-200' => $present,
                                'bg-red-50   border-red-200' => !$present,
                            ])>
                                @if ($present)
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
                                <p class="text-sm font-normal text-gray-800 truncate">{{ $session }}</p>
                                <p @class([
                                    'text-[0.7rem] font-light mt-0.5',
                                    'text-gray-400' => $present,
                                    'text-red-400' => !$present,
                                ])>{{ $note }}</p>
                            </div>

                            <div class="flex flex-col items-end gap-1 shrink-0">
                                <span class="text-[0.72rem] font-light text-gray-400">{{ $time }}</span>
                                <div @class([
                                    'text-[0.6rem] font-light tracking-widest uppercase px-2 py-0.5 rounded-full border',
                                    'bg-green-50 border-green-200 text-green-700' => $present,
                                    'bg-red-50   border-red-200   text-red-600' => !$present,
                                ])>
                                    {{ $present ? 'HADIR' : 'ABSEN' }}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endforeach


            {{-- ── EMPTY STATE — uncomment when list is empty ── --}}
            {{--
            <div class="flex flex-col items-center justify-center gap-5 py-20 text-center">
                <div class="w-14 h-14 rounded-2xl bg-white border border-gray-200 flex items-center justify-center">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" class="text-gray-300">
                        <rect x="3" y="2" width="16" height="18" rx="2.5" stroke="currentColor" stroke-width="1.4" />
                        <path d="M7 8h8M7 12h8M7 16h5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Belum ada riwayat absensi</p>
                    <p class="text-[0.75rem] font-light text-gray-400 mt-1">Scan QR untuk mulai mencatat kehadiranmu</p>
                </div>
                <a href="{{ route('attendance.scan') }}"
                    class="flex items-center gap-2 px-5 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                    Scan QR Sekarang
                </a>
            </div>
            --}}

        </section>


        <section class="flex items-center justify-between flex-wrap gap-4">

            <p class="text-[0.72rem] font-light text-gray-400">
                Halaman <span class="font-medium text-gray-600">1</span> dari <span
                    class="font-medium text-gray-600">4</span>
            </p>

            <div class="flex items-center gap-1.5">
                <a href="#"
                    class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M8 3L5 6l3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>

                @foreach ([1, 2, 3, 4] as $page)
                    <a href="#" @class([
                        'flex items-center justify-center w-8 h-8 rounded-lg text-xs font-normal transition-colors no-underline',
                        'bg-blue-900 text-white border border-blue-900' => $page === 1,
                        'border border-gray-200 text-gray-500 hover:bg-gray-50 hover:border-gray-300' =>
                            $page !== 1,
                    ])>
                        {{ $page }}
                    </a>
                @endforeach

                <a href="#"
                    class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

        </section>


        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>


    </main>

</x-layout-main>
