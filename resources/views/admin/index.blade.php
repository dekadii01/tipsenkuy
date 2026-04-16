<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Dashboard Admin">

    <x-navbar-admin />

    <main class="max-w-6xl mx-auto px-6 py-10 flex flex-col gap-8">


        <section class="flex items-start justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-2xl font-light tracking-tight text-gray-900">
                    Halo, <span class="font-medium">{{ auth()->user()->name ?? 'Admin' }}</span> 👋
                </h1>
                <p class="text-xs font-light text-gray-400 mt-1 tracking-wide">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <span
                class="text-[0.65rem] font-light tracking-widest uppercase text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-3 py-1">
                Administrator
            </span>
        </section>


        <section class="grid grid-cols-2 lg:grid-cols-4 gap-3">

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">8</p>
                <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Sesi aktif<br>hari ini</p>
                <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full w-4/5 bg-blue-900 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">{{ $allStudent }}</p>
                <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Total<br>peserta</p>
                <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full w-full bg-blue-200 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">94<span
                        class="text-base text-gray-400">%</span></p>
                <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Rata-rata<br>kehadiran</p>
                <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full w-[94%] bg-green-500 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-[1.8rem] font-light leading-none tracking-tight text-gray-900">36</p>
                <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Total sesi<br>bulan ini</p>
                <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full w-3/5 bg-blue-200 rounded-full"></div>
                </div>
            </div>

        </section>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            <div class="lg:col-span-2 flex flex-col gap-4">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-gray-900">Sesi Hari Ini</h2>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">{{ $sessions->count() }} sesi
                            terjadwal</p>
                    </div>
                    <a href="{{ route('admin.attendance.create') }}"
                        class="flex items-center gap-1.5 px-4 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                        </svg>
                        Buat Sesi
                    </a>
                </div>

                <div class="flex flex-col gap-3">

                    @foreach ($sessions->take(6) as $session)
                        <div
                            class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:border-gray-300 transition-colors">

                            <div class="flex">
                                <div @class([
                                    'w-[3px] shrink-0 rounded-l-2xl',
                                    'bg-blue-900' => $session->status,
                                    'bg-gray-200' => !$session->status,
                                ])></div>

                                <div class="flex-1 px-5 py-4 flex items-center gap-4 flex-wrap">

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $session->nama_sesi }}</p>
                                            </p>
                                            <div @class([
                                                'flex items-center gap-1.5 text-[0.65rem] font-light px-2 py-0.5 rounded-full border',
                                                'bg-green-50 border-green-200 text-green-700' =>
                                                    $session->status === 'active',
                                                'bg-gray-100 border-gray-200 text-gray-400' => $session->status === 'ended',
                                                'bg-yellow-50 border-yellow-200 text-yellow-700' =>
                                                    $session->status === 'pending',
                                            ])>
                                                <span @class([
                                                    'w-1 h-1 rounded-full',
                                                    'bg-green-500 animate-pulse' => $session->status === 'active',
                                                    'bg-gray-400' => $session->status === 'ended',
                                                    'bg-yellow-300' => $session->status === 'pending',
                                                ])></span>

                                                @if ($session->status === 'active')
                                                    · Sedang berlangsung
                                                @elseif ($session->status === 'pending')
                                                    · Menunggu mulai
                                                @else
                                                    · Sesi berakhir
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 mt-1.5">
                                            <div class="flex items-center gap-1">
                                                <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                                    class="text-gray-400">
                                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                                        stroke-width="1.2" />
                                                    <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor"
                                                        stroke-width="1.2" stroke-linecap="round" />
                                                </svg>
                                                <span
                                                    class="text-[0.7rem] font-light text-gray-400">{{ $session->jam_mulai }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                                    class="text-gray-400">
                                                    <circle cx="6" cy="4" r="2" stroke="currentColor"
                                                        stroke-width="1.2" />
                                                    <path d="M2 10c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                                        stroke-width="1.2" stroke-linecap="round" />
                                                </svg>
                                                <span class="text-[0.7rem] font-light text-gray-400">{{ $allStudent }}
                                                    peserta</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-1.5 shrink-0">
                                        <p class="text-sm font-light text-gray-900">
                                            <span class="font-medium">{{ $present }}</span>
                                            <span class="text-gray-400">/ {{ $allStudent }}</span>
                                        </p>
                                        <div class="w-24 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                                            <div @class([
                                                'h-full rounded-full',
                                                'bg-blue-900' => $active,
                                                'bg-gray-300' => !$active,
                                            ])
                                                style="width: {{ $allStudent > 0 ? round(($present / $allStudent) * 100) : 0 }}%">
                                            </div>
                                        </div>
                                        <span class="text-[0.65rem] font-light text-gray-400">
                                            {{ $allStudent > 0 ? round(($present / $allStudent) * 100) : 0 }}% hadir
                                        </span>
                                    </div>

                                    <a href="{{ route('admin.attendance.detail', $session->id) }}"
                                        class="flex items-center gap-1 text-[0.75rem] font-normal text-blue-900 hover:opacity-70 transition-opacity no-underline shrink-0">
                                        Detail
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                            <path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <a href="{{ route('admin.attendance.index') }}"
                    class="flex items-center justify-center gap-1.5 py-3 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-sm font-light text-gray-500 rounded-2xl transition-colors no-underline">
                    Lihat semua sesi
                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none">
                        <path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>

            </div>


            <div class="flex flex-col gap-4">

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">
                        <h2 class="text-sm font-medium text-gray-900">Aksi Cepat</h2>

                        <a href=""
                            class="flex items-center gap-3 px-4 py-3 bg-blue-900 hover:bg-blue-950 text-white rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                            <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                <svg width="13" height="13" viewBox="0 0 12 12" fill="none">
                                    <path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium">Buat Sesi Baru</p>
                                <p class="text-[0.65rem] font-light text-white/60 mt-0.5">Generate QR otomatis</p>
                            </div>
                        </a>

                        <a href=""
                            class="flex items-center gap-3 px-4 py-3 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                                <svg width="13" height="13" viewBox="0 0 14 14" fill="none"
                                    class="text-blue-900">
                                    <circle cx="5" cy="4" r="2" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M1 12c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                        stroke-width="1.2" stroke-linecap="round" />
                                    <path d="M10 6v4M12 8h-4" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-800">Kelola Peserta</p>
                                <p class="text-[0.65rem] font-light text-gray-400 mt-0.5">Tambah atau hapus peserta</p>
                            </div>
                        </a>

                        <a href=""
                            class="flex items-center gap-3 px-4 py-3 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                                <svg width="13" height="13" viewBox="0 0 14 14" fill="none"
                                    class="text-blue-900">
                                    <rect x="2" y="1" width="10" height="12" rx="1.5"
                                        stroke="currentColor" stroke-width="1.2" />
                                    <path d="M5 5h4M5 7.5h4M5 10h2" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-800">Laporan Kehadiran</p>
                                <p class="text-[0.65rem] font-light text-gray-400 mt-0.5">Export data absensi</p>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-5 pt-5 pb-4 border-b border-gray-100">
                        <h2 class="text-sm font-medium text-gray-900">Scan Terbaru</h2>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">Aktivitas real-time</p>
                    </div>

                    <div class="px-5">
                        @foreach ($recentScans as $scan)
                            <div @class([
                                'flex items-center gap-3 py-3',
                                'border-b border-gray-100' => !$loop->last,
                            ])>
                                <div
                                    class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[0.6rem] font-medium text-blue-900 shrink-0">
                                    {{ strtoupper(substr($scan->user->first_name . ' ' . $scan->user->last_name, 0, 2)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-normal text-gray-800 truncate">
                                        {{ $scan->user->first_name . ' ' . $scan->user->last_name }}
                                    </p>
                                    <p class="text-[0.65rem] font-light text-gray-400 truncate">
                                        {{ $scan->session->nama_sesi }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <span
                                        class="text-[0.65rem] font-light text-gray-400">{{ $scan->session->created_at->format('H:i') }}</span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>


        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>


    </main>

</x-layout-main>
