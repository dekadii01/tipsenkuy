<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Detail Sesi — Admin">

    <x-navbar-admin />


    <main class="max-w-6xl mx-auto px-6 py-10 flex flex-col gap-8">


        <section class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <a href=""
                        class="flex items-center gap-1 text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M8 3L4 6l4 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Semua Sesi
                    </a>
                    <span class="text-gray-300 text-xs">/</span>
                    <span class="text-xs font-light text-gray-400">Detail Sesi</span>
                </div>

                <h1 class="text-2xl font-light tracking-tight text-gray-900">
                    Kelas <span class="font-medium">Basis Data</span>
                </h1>

                <div class="flex flex-wrap items-center gap-3 mt-1">
                    <div class="flex items-center gap-1.5">
                        <svg width="11" height="11" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                            <rect x="1.5" y="2.5" width="9" height="8" rx="1.5" stroke="currentColor"
                                stroke-width="1.2" />
                            <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor" stroke-width="1.2"
                                stroke-linecap="round" />
                        </svg>
                        <span class="text-xs font-light text-gray-400">Senin, 5 April 2026</span>
                    </div>
                    <span class="text-gray-300 text-xs">·</span>
                    <div class="flex items-center gap-1.5">
                        <svg width="11" height="11" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                            <circle cx="6" cy="6" r="4.5" stroke="currentColor" stroke-width="1.2" />
                            <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                stroke-linecap="round" />
                        </svg>
                        <span class="text-xs font-light text-gray-400">08:00 – 10:00 WIB</span>
                    </div>
                </div>
            </div>

            @php $sessionActive = true; @endphp

            <div @class([
                'flex items-center gap-2 px-3 py-1.5 rounded-xl border text-xs font-light self-start',
                'bg-green-50 border-green-200 text-green-700' => $sessionActive,
                'bg-gray-100 border-gray-200 text-gray-500' => !$sessionActive,
            ])>
                <span @class([
                    'w-1.5 h-1.5 rounded-full',
                    'bg-green-500 animate-pulse' => $sessionActive,
                    'bg-gray-400' => !$sessionActive,
                ])></span>
                {{ $sessionActive ? 'Sesi Aktif' : 'Sesi Berakhir' }}
            </div>

        </section>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


            <div class="flex flex-col gap-4">

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="h-0.75 bg-blue-900"></div>

                    <div class="p-8 flex flex-col items-center gap-6">

                        <div class="p-5 border border-gray-200 rounded-2xl bg-white">
                            <svg width="200" height="200" viewBox="0 0 120 120" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="8" width="34" height="34" rx="4" fill="#0f4c81" />
                                <rect x="14" y="14" width="22" height="22" rx="2" fill="white" />
                                <rect x="20" y="20" width="10" height="10" rx="1" fill="#0f4c81" />
                                <rect x="78" y="8" width="34" height="34" rx="4" fill="#0f4c81" />
                                <rect x="84" y="14" width="22" height="22" rx="2" fill="white" />
                                <rect x="90" y="20" width="10" height="10" rx="1" fill="#0f4c81" />
                                <rect x="8" y="78" width="34" height="34" rx="4" fill="#0f4c81" />
                                <rect x="14" y="84" width="22" height="22" rx="2" fill="white" />
                                <rect x="20" y="90" width="10" height="10" rx="1" fill="#0f4c81" />
                                <rect x="52" y="8" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="64" y="8" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="52" y="20" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="64" y="20" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="52" y="32" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="8" y="52" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="20" y="52" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="32" y="52" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="8" y="64" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="20" y="64" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="32" y="64" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="52" y="52" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="64" y="52" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="78" y="52" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="90" y="52" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="102" y="52" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="52" y="64" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="64" y="64" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="78" y="64" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="90" y="64" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="102" y="64" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="52" y="78" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="64" y="78" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="78" y="78" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="90" y="90" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="102" y="78" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="52" y="90" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="64" y="90" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="78" y="90" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="102" y="90" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="52" y="102" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="64" y="102" width="10" height="10" rx="1.5" fill="#c0d4ea" />
                                <rect x="78" y="102" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="90" y="102" width="10" height="10" rx="1.5" fill="#0f4c81" />
                                <rect x="102" y="102" width="10" height="10" rx="1.5" fill="#0f4c81" />
                            </svg>
                        </div>

                        <div class="flex flex-col items-center gap-2 w-full">
                            <div
                                class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <rect x="2" y="5" width="8" height="6" rx="1.5"
                                        stroke="currentColor" stroke-width="1.2" />
                                    <path d="M4 5V3.5a2 2 0 1 1 4 0V5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span
                                    class="text-[0.7rem] font-light text-gray-500 tracking-widest">TKN-8F3A2C1D</span>
                            </div>

                            <div @class([
                                'flex items-center gap-1.5 text-[0.72rem] font-light',
                                'text-green-600' => $sessionActive,
                                'text-gray-400' => !$sessionActive,
                            ])>
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                @if ($sessionActive)
                                    Berlaku selama <span class="font-medium">07:42</span>
                                @else
                                    Sesi telah berakhir
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex flex-col gap-2.5">

                    @if ($sessionActive)
                        <button
                            class="w-full flex items-center justify-center gap-2 py-3 bg-gray-900 hover:bg-gray-800 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <rect x="2" y="2" width="10" height="10" rx="2" stroke="currentColor"
                                    stroke-width="1.3" />
                            </svg>
                            Akhiri Sesi
                        </button>

                        <button
                            class="w-full flex items-center justify-center gap-2 py-3 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-sm font-light text-gray-700 rounded-xl transition-all duration-200 hover:-translate-y-px">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M2 7a5 5 0 1 1 1.4 3.5" stroke="currentColor" stroke-width="1.3"
                                    stroke-linecap="round" />
                                <path d="M2 11V7h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Generate Ulang QR
                        </button>
                    @else
                        <button disabled
                            class="w-full flex items-center justify-center gap-2 py-3 bg-gray-100 text-gray-400 text-sm font-normal rounded-xl cursor-not-allowed">
                            Sesi Telah Berakhir
                        </button>
                    @endif

                </div>

            </div>


            <div class="flex flex-col gap-4">

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white border border-gray-200 rounded-2xl p-5">
                        <p class="text-[1.6rem] font-light leading-none tracking-tight text-gray-900">32</p>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Total<br>peserta</p>
                        <div class="mt-3 h-0.75 rounded-full bg-gray-100 overflow-hidden">
                            <div class="h-full w-full bg-gray-200 rounded-full"></div>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-5">
                        <p class="text-[1.6rem] font-light leading-none tracking-tight text-gray-900">
                            12 <span class="text-base text-gray-400 font-light">/ 32</span>
                        </p>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Sudah<br>hadir</p>
                        <div class="mt-3 h-0.75 rounded-full bg-gray-100 overflow-hidden">
                            <div class="h-full w-[37.5%] bg-blue-900 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden flex flex-col flex-1">

                    <div class="px-6 pt-5 pb-4 flex items-center justify-between border-b border-gray-100 shrink-0">
                        <div>
                            <h2 class="text-sm font-medium text-gray-900">Peserta Hadir</h2>
                            <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">12 orang tercatat</p>
                        </div>
                        <span
                            class="text-[0.65rem] font-light tracking-widest uppercase text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-1">
                            Live
                        </span>
                    </div>

                    <div class="px-6 overflow-y-auto max-h-105">

                        @foreach ([['Andi Pratama', '08:03'], ['Budi Santoso', '08:07'], ['Citra Dewi', '08:09'], ['Dimas Rahardjo', '08:11'], ['Eka Fitriani', '08:14'], ['Fajar Nugroho', '08:18'], ['Gita Permatasari', '08:21'], ['Hendra Wijaya', '08:25'], ['Indah Kusuma', '08:28'], ['Joko Susanto', '08:31'], ['Kartika Sari', '08:35'], ['Lukman Hakim', '08:42']] as [$name, $time])
                            <div @class([
                                'flex items-center gap-3.5 py-3',
                                'border-b border-gray-100' => !$loop->last,
                            ])>

                                <div
                                    class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[0.65rem] font-medium text-blue-900 shrink-0 tracking-wide">
                                    {{ strtoupper(substr($name, 0, 2)) }}
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-normal text-gray-800 truncate">{{ $name }}</p>
                                </div>

                                <div class="flex items-center gap-2 shrink-0">
                                    <span class="text-[0.7rem] font-light text-gray-400">{{ $time }}</span>
                                    <div class="w-1.5 h-1.5 rounded-full bg-green-400 shrink-0"></div>
                                </div>

                            </div>
                        @endforeach

                    </div>

                    {{-- Empty state (show when list is empty) --}}
                    {{--
                    <div class="flex flex-col items-center justify-center gap-3 py-16 px-6 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="text-gray-300">
                                <circle cx="10" cy="8" r="3.5" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M3 17c0-3.314 3.134-6 7-6s7 2.686 7 6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-normal text-gray-500">Belum ada yang absen</p>
                            <p class="text-[0.72rem] font-light text-gray-400 mt-1">Peserta akan muncul setelah scan QR</p>
                        </div>
                    </div>
                    --}}

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
