<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Detail Sesi">

    <x-navbar-auth-user />

    <main class="max-w-5xl mx-auto px-6 py-10 flex flex-col gap-6">


        {{-- ── PAGE HEADER ── --}}
        <section class="flex flex-col gap-2">

            <nav class="flex items-center gap-1.5 flex-wrap">
                <a href="{{ route('dashboard-user') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                    Dashboard
                </a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('my-sessions') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                    Sesi
                </a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-xs font-light text-gray-500">Detail</span>
            </nav>

            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-light tracking-tight text-gray-900">
                        Kelas <span class="font-medium">{{ $session->nama_sesi }}</span>
                    </h1>
                    <p class="text-sm font-light text-gray-400 mt-1">
                        Informasi sesi dan status kehadiran kamu
                    </p>
                </div>
                <a href="{{ route('my-sessions') }}"
                    class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-xl transition-colors no-underline shrink-0">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                        <path d="M8 3L4 6l4 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>

        </section>


        {{-- ── MAIN GRID — 2 col on large, stacked on mobile ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- ════════════════════
                 LEFT — Main content (2/3)
            ════════════════════ --}}
            <div class="lg:col-span-2 flex flex-col gap-6">


                {{-- ── SESSION INFO CARD ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="h-[3px] bg-blue-900"></div>

                    <div class="p-6 flex flex-col gap-4">

                        <div>
                            <p class="text-lg font-medium text-gray-900">Kelas {{ $session->nama_sesi }}</p>
                            <p class="text-sm font-light text-gray-400 mt-1 leading-relaxed">
                                {{ $session->deskripsi ?? 'Tidak ada deskripsi untuk sesi ini.' }}
                            </p>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                            <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-500">
                                        <rect x="1.5" y="2.5" width="9" height="8" rx="1.5"
                                            stroke="currentColor" stroke-width="1.2" />
                                        <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[0.65rem] font-light text-gray-400 uppercase tracking-wider">Tanggal
                                    </p>
                                    <p class="text-sm font-normal text-gray-800 mt-0.5">
                                        {{ $session->tanggal->translatedFormat('l, d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-500">
                                        <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                            stroke-width="1.2" />
                                        <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[0.65rem] font-light text-gray-400 uppercase tracking-wider">Waktu
                                    </p>
                                    <p class="text-sm font-normal text-gray-800 mt-0.5">
                                        {{ $session->jam_mulai }} – {{ $session->jam_selesai }} WITA
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-500">
                                        <circle cx="6" cy="4" r="2" stroke="currentColor"
                                            stroke-width="1.2" />
                                        <path d="M2 10c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                            stroke-width="1.2" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[0.65rem] font-light text-gray-400 uppercase tracking-wider">Peserta
                                    </p>
                                    <p class="text-sm font-normal text-gray-800 mt-0.5">{{ $totalPeserta }} peserta
                                        terdaftar</p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-3 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-500">
                                        <rect x="2" y="5" width="8" height="6" rx="1.5"
                                            stroke="currentColor" stroke-width="1.2" />
                                        <path d="M4 5V3.5a2 2 0 1 1 4 0V5" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[0.65rem] font-light text-gray-400 uppercase tracking-wider">Token
                                    </p>
                                    <p class="text-sm font-normal text-gray-800 mt-0.5 tracking-wider">TKN-8F3A</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- ── STATUS SECTION ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col gap-4">

                    <h2 class="text-sm font-medium text-gray-900">Status</h2>

                    <div class="flex flex-col gap-3">

                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    class="text-gray-400">
                                    <circle cx="7" cy="7" r="5.5" stroke="currentColor"
                                        stroke-width="1.3" />
                                    <path d="M7 4.5v3l1.5 1.5" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-sm font-light text-gray-700">Status Sesi</span>
                            </div>
                            <div @class([
                                'flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-light',
                                'bg-green-50  border-green-200  text-green-700' =>
                                    $sessionStatus === 'active',
                                'bg-yellow-50 border-yellow-200 text-yellow-700' =>
                                    $sessionStatus === 'upcoming',
                                'bg-gray-100  border-gray-200   text-gray-500' =>
                                    $sessionStatus === 'ended',
                            ])>
                                <span @class([
                                    'w-1.5 h-1.5 rounded-full',
                                    'bg-green-500 animate-pulse' => $sessionStatus === 'active',
                                    'bg-yellow-400' => $sessionStatus === 'upcoming',
                                    'bg-gray-400' => $sessionStatus === 'ended',
                                ])></span>
                                @if ($sessionStatus === 'active')
                                    Sedang berlangsung
                                @elseif ($sessionStatus === 'upcoming')
                                    Akan datang
                                @else
                                    Telah berakhir
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center gap-2.5">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    class="text-gray-400">
                                    <circle cx="7" cy="5" r="2.5" stroke="currentColor"
                                        stroke-width="1.3" />
                                    <path d="M2 12c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="currentColor"
                                        stroke-width="1.3" stroke-linecap="round" />
                                </svg>
                                <span class="text-sm font-light text-gray-700">Kehadiran Kamu</span>
                            </div>

                            @if ($userAttended)
                                <div
                                    class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 border border-green-200 text-xs font-light text-green-700">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                        <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Sudah absen
                                </div>
                            @elseif ($sessionStatus === 'ended')
                                <div
                                    class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-xs font-light text-red-500">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                        <path d="M3 3l6 6M9 3l-6 6" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" />
                                    </svg>
                                    Tidak hadir
                                </div>
                            @else
                                <div
                                    class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 text-xs font-light text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Belum absen
                                </div>
                            @endif
                        </div>

                    </div>
                </div>


                {{-- ── MAIN CTA ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col items-center gap-5">

                    @if ($sessionStatus === 'active' && !$userAttended)
                        <div class="flex flex-col items-center gap-2 text-center">
                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    class="text-blue-900">
                                    <rect x="2" y="2" width="8" height="8" rx="1.5"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <rect x="12" y="2" width="8" height="8" rx="1.5"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <rect x="2" y="12" width="8" height="8" rx="1.5"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path d="M13 16h2M16 13v2M16 16v2M19 16h-2" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                            <p class="text-sm font-normal text-gray-800">Sesi sedang berlangsung</p>
                            <p class="text-xs font-light text-gray-400">Scan QR untuk mencatat kehadiranmu sekarang</p>
                        </div>

                        <a href="{{ route('attendance.scan') }}"
                            class="w-full flex items-center justify-center gap-2 py-3 px-6 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                            <svg width="16" height="16" viewBox="0 0 22 22" fill="none">
                                <rect x="2" y="2" width="8" height="8" rx="1.5" stroke="currentColor"
                                    stroke-width="1.5" />
                                <rect x="12" y="2" width="8" height="8" rx="1.5"
                                    stroke="currentColor" stroke-width="1.5" />
                                <rect x="2" y="12" width="8" height="8" rx="1.5"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M13 16h2M16 13v2M16 16v2M19 16h-2" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            Scan Sekarang
                        </a>
                    @elseif ($sessionStatus === 'active' && $userAttended)
                        <div class="flex flex-col items-center gap-2 text-center">
                            <div
                                class="w-12 h-12 rounded-2xl bg-green-50 border border-green-200 flex items-center justify-center">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    class="text-green-600">
                                    <path d="M5 13l5 5L19 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p class="text-sm font-normal text-gray-800">Kehadiran tercatat</p>
                            <p class="text-xs font-light text-gray-400">Kamu sudah berhasil absen pada sesi ini</p>
                        </div>

                        <div
                            class="flex items-center gap-2 px-4 py-2.5 bg-green-50 border border-green-200 rounded-xl w-full justify-center">
                            <svg width="13" height="13" viewBox="0 0 14 14" fill="none"
                                class="text-green-600 shrink-0">
                                <path d="M2.5 7l3.5 3.5 5.5-7" stroke="currentColor" stroke-width="1.4"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="text-xs font-light text-green-700">Tercatat pukul
                                {{ $attendance->scanned_at }} WIB</span>
                        </div>
                    @elseif ($sessionStatus === 'upcoming')
                        <div class="flex flex-col items-center gap-2 text-center">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    class="text-gray-400">
                                    <circle cx="12" cy="12" r="9" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <p class="text-sm font-normal text-gray-600">Sesi belum dimulai</p>
                            <p class="text-xs font-light text-gray-400">Kamu bisa absen saat sesi sudah aktif</p>
                        </div>

                        <button disabled
                            class="w-full flex items-center justify-center gap-2 py-3 px-6 bg-gray-100 text-gray-400 text-sm font-normal rounded-xl cursor-not-allowed">
                            Belum Tersedia
                        </button>
                    @else
                        <div class="flex flex-col items-center gap-2 text-center">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    class="text-gray-400">
                                    <rect x="5" y="5" width="14" height="14" rx="2"
                                        stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </div>
                            <p class="text-sm font-normal text-gray-600">Sesi telah berakhir</p>
                            <p class="text-xs font-light text-gray-400">Absensi tidak lagi tersedia untuk sesi ini</p>
                        </div>

                        <button disabled
                            class="w-full flex items-center justify-center gap-2 py-3 px-6 bg-gray-100 text-gray-400 text-sm font-normal rounded-xl cursor-not-allowed">
                            Tidak Tersedia
                        </button>
                    @endif

                </div>


                {{-- ── INFO NOTE ── --}}
                @if ($sessionStatus !== 'ended')
                    <div class="flex items-start gap-3 px-5 py-4 bg-blue-50 border border-blue-100 rounded-xl">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                            class="text-blue-600 shrink-0 mt-0.5">
                            <circle cx="7" cy="7" r="5.5" stroke="currentColor"
                                stroke-width="1.3" />
                            <path d="M7 6v4M7 4.5v.5" stroke="currentColor" stroke-width="1.3"
                                stroke-linecap="round" />
                        </svg>
                        <p class="text-xs font-light text-blue-700 leading-relaxed">
                            Absensi hanya bisa dilakukan saat sesi aktif. Pastikan kamu berada di dalam area kelas saat
                            melakukan scan QR.
                        </p>
                    </div>
                @endif


            </div>


            {{-- ════════════════════
                 RIGHT — Quick actions (1/3)
            ════════════════════ --}}
            <div class="flex flex-col gap-4">

                {{-- ── DISCUSSION TRIGGER CARD ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="h-[3px] bg-blue-900"></div>

                    <div class="p-5 flex flex-col gap-4">

                        <div>
                            <h2 class="text-sm font-medium text-gray-900">Diskusi Kelas</h2>
                            <p class="text-[0.72rem] font-light text-gray-400 mt-0.5 leading-relaxed">
                                Forum tanya jawab dan diskusi antara peserta dan dosen
                            </p>
                        </div>

                        {{-- Discussion stats --}}
                        <div class="grid grid-cols-2 gap-2">
                            <div
                                class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <p class="text-base font-light text-gray-900">14</p>
                                <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">
                                    Total<br>diskusi</p>
                            </div>
                            <div
                                class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <p class="text-base font-light text-blue-900">3</p>
                                <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">
                                    Belum<br>dibaca</p>
                            </div>
                        </div>

                        {{-- Latest thread preview --}}
                        <div class="flex flex-col gap-2">
                            <p class="text-[0.65rem] font-normal text-gray-400 uppercase tracking-widest">Terbaru</p>
                            <div class="flex flex-col gap-2">
                                @foreach ([['Kapan tugas dikumpulkan?', 'Budi S.', '10m'], ['Materi pertemuan ke-4', 'Admin', '1j']] as [$title, $author, $time])
                                    <div
                                        class="flex items-start gap-2.5 px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl">
                                        <div
                                            class="w-6 h-6 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[0.55rem] font-medium text-blue-900 shrink-0 mt-0.5">
                                            {{ strtoupper(substr($author, 0, 2)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-normal text-gray-700 truncate">{{ $title }}
                                            </p>
                                            <div class="flex items-center gap-1.5 mt-0.5">
                                                <span
                                                    class="text-[0.62rem] font-light text-gray-400">{{ $author }}</span>
                                                <span class="text-gray-300 text-[0.6rem]">·</span>
                                                <span
                                                    class="text-[0.62rem] font-light text-gray-400">{{ $time }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- CTA button --}}
                        <a href="{{ route('session.chat.user', $session->id) }}"
                            class="w-full flex items-center justify-center gap-2 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                <path d="M14 10a2 2 0 0 1-2 2H5l-3 3V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v6z"
                                    stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" />
                            </svg>
                            Buka Diskusi
                        </a>

                    </div>
                </div>

                {{-- ── SESSION MEMBERS ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-4">

                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-900">Peserta</h2>
                        <span class="text-[0.65rem] font-light text-gray-400">{{ $totalPeserta ?? 32 }} orang</span>
                    </div>

                    <div class="flex flex-col gap-2">
                        @foreach ([['Andi Pratama', true], ['Budi Santoso', false], ['Citra Dewi', true], ['Dimas Rahardjo', true]] as [$name, $online])
                            <div class="flex items-center gap-2.5">
                                <div class="relative shrink-0">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[0.6rem] font-medium text-blue-900">
                                        {{ strtoupper(substr($name, 0, 2)) }}
                                    </div>
                                    @if ($online)
                                        <span
                                            class="absolute -bottom-0.5 -right-0.5 w-2 h-2 rounded-full bg-green-500 border border-white"></span>
                                    @endif
                                </div>
                                <span
                                    class="text-xs font-light text-gray-700 truncate flex-1">{{ $name }}</span>
                            </div>
                        @endforeach
                    </div>

                    <p class="text-[0.65rem] font-light text-gray-400 text-center">
                        +{{ ($totalPeserta ?? 32) - 4 }} peserta lainnya
                    </p>

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
