<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Sesi Saya">

    <x-navbar-auth-user />

    <main class="max-w-5xl mx-auto px-6 py-10 flex flex-col gap-10">

        <section class="flex flex-col gap-1">
            <h1 class="text-2xl font-light tracking-tight text-gray-900">
                Sesi <span class="font-medium">Saya</span>
            </h1>
            <p class="text-sm font-light text-gray-400">
                Lihat sesi yang tersedia dan jadwal kamu
            </p>
        </section>


        <section class="flex flex-col gap-4">

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                    <h2 class="text-sm font-medium text-gray-900">Sedang Berlangsung</h2>
                </div>
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-[0.7rem] font-light text-gray-400 shrink-0">{{ $activeSessions->count() }} sesi</span>
            </div>

            <div class="flex flex-col gap-3">

                @if ($activeSessions->isNotEmpty())
                    @foreach ($activeSessions as $session)
                        <div @class([
                            'bg-white border rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center gap-4 transition-colors',
                            'border-green-200 hover:border-green-300' => isset($attended[$session->id]),
                            'border-gray-200  hover:border-gray-300' => !isset($attended[$session->id]),
                        ])>

                            <div class="shrink-0 self-start sm:self-center">
                                <div @class([
                                    'w-2 h-2 rounded-full mt-1.5',
                                    'bg-green-500 animate-pulse' => !isset($attended[$session->id]),
                                    'bg-gray-300' => isset($attended[$session->id]),
                                ])></div>
                            </div>

                            <div class="flex-1 min-w-0 flex flex-col gap-1">
                                <p class="text-sm font-medium text-gray-900">{{ $session->nama_sesi }}</p>
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
                                            class="text-[0.7rem] font-light text-gray-400">{{ $session->tanggal->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                                stroke-width="1.2" />
                                            <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span class="text-[0.7rem] font-light text-gray-400">{{ $session->jam_mulai }} –
                                            {{ $session->jam_selesai }} WITA</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex sm:flex-col items-center sm:items-end gap-3 shrink-0">

                                @if (isset($attended[$session->id]))
                                    <span
                                        class="text-[0.65rem] font-light tracking-widest uppercase px-2.5 py-1 rounded-full bg-green-50 border border-green-200 text-green-700">
                                        Sudah hadir
                                    </span>
                                @else
                                    <span
                                        class="text-[0.65rem] font-light tracking-widest uppercase px-2.5 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700">
                                        Aktif
                                    </span>
                                    <a href="{{ route('attendance.scan') }}"
                                        class="flex items-center gap-1.5 px-4 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline shrink-0">
                                        <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                            <rect x="2" y="2" width="4.5" height="4.5" rx="1"
                                                stroke="currentColor" stroke-width="1.3" />
                                            <rect x="7.5" y="2" width="4.5" height="4.5" rx="1"
                                                stroke="currentColor" stroke-width="1.3" />
                                            <rect x="2" y="7.5" width="4.5" height="4.5" rx="1"
                                                stroke="currentColor" stroke-width="1.3" />
                                            <path d="M8.5 9.5h1M10 8v1M10 9.5V11M11.5 9.5h-1" stroke="currentColor"
                                                stroke-width="1.3" stroke-linecap="round" />
                                        </svg>
                                        Scan sekarang
                                    </a>
                                @endif

                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm font-light text-gray-400 text-center py-5">
                        Tidak ada sesi yang sedang berlangsung
                    </p>
                @endif

            </div>
        </section>


        <section class="flex flex-col gap-4">

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span>
                    <h2 class="text-sm font-medium text-gray-900">Akan Datang</h2>
                </div>
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-[0.7rem] font-light text-gray-400 shrink-0">{{ $pendingSessions->count() }}
                    sesi</span>
            </div>

            <div class="flex flex-col gap-3">

                @foreach ($pendingSessions as $session)
                    <div
                        class="bg-white border border-gray-200 hover:border-gray-300 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center gap-4 transition-colors">

                        <div class="shrink-0 self-start sm:self-center">
                            <div class="w-2 h-2 rounded-full bg-yellow-300 mt-1.5"></div>
                        </div>

                        <div class="flex-1 min-w-0 flex flex-col gap-1">
                            <p class="text-sm font-medium text-gray-700">{{ $session->nama_sesi }}</p>
                            <div class="flex flex-wrap items-center gap-3">
                                <div class="flex items-center gap-1">
                                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-400">
                                        <rect x="1.5" y="2.5" width="9" height="8" rx="1.5"
                                            stroke="currentColor" stroke-width="1.2" />
                                        <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                    <span
                                        class="text-[0.7rem] font-light text-gray-400">{{ $session->tanggal->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-400">
                                        <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                            stroke-width="1.2" />
                                        <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                    <span class="text-[0.7rem] font-light text-gray-400">{{ $session->jam_mulai }} –
                                        {{ $session->jam_selesai }}
                                        WITA</span>
                                </div>
                            </div>
                        </div>

                        <div class="shrink-0">
                            <span
                                class="text-[0.65rem] font-light tracking-widest uppercase px-2.5 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-600">
                                Akan datang
                            </span>
                        </div>

                    </div>
                @endforeach

            </div>
        </section>


        <section class="flex flex-col gap-4">

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                    <h2 class="text-sm font-medium text-gray-500">Selesai</h2>
                </div>
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-[0.7rem] font-light text-gray-400 shrink-0">{{ $completedSessions->count() }}
                    sesi</span>
            </div>

            <div class="flex flex-col gap-3">

                @foreach ($completedSessions as $session)
                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center gap-4 opacity-75 hover:opacity-100 hover:border-gray-300 transition-all duration-200">

                        <div class="shrink-0 self-start sm:self-center">
                            <div class="w-2 h-2 rounded-full bg-gray-300 mt-1.5"></div>
                        </div>

                        <div class="flex-1 min-w-0 flex flex-col gap-1">
                            <p class="text-sm font-medium text-gray-500">{{ $session->nama_sesi }}</p>
                            <div class="flex flex-wrap items-center gap-3">
                                <div class="flex items-center gap-1">
                                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-300">
                                        <rect x="1.5" y="2.5" width="9" height="8" rx="1.5"
                                            stroke="currentColor" stroke-width="1.2" />
                                        <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                    <span
                                        class="text-[0.7rem] font-light text-gray-400">{{ $session->tanggal }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-300">
                                        <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                            stroke-width="1.2" />
                                        <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                    <span class="text-[0.7rem] font-light text-gray-400">{{ $session->jam_mulai }} –
                                        {{ $session->jam_selesai }}
                                        WITA</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2.5 shrink-0">
                            @if (isset($attended[$session->id]))
                                <span
                                    class="text-[0.65rem] font-light tracking-widest uppercase px-2.5 py-1 rounded-full bg-green-50 border border-green-200 text-green-600">
                                    Hadir
                                </span>
                            @else
                                <span
                                    class="text-[0.65rem] font-light tracking-widest uppercase px-2.5 py-1 rounded-full bg-red-50 border border-red-200 text-red-500">
                                    Tidak hadir
                                </span>
                            @endif
                            <span
                                class="text-[0.65rem] font-light tracking-widest uppercase px-2.5 py-1 rounded-full bg-gray-100 border border-gray-200 text-gray-400">
                                Selesai
                            </span>
                        </div>

                    </div>
                @endforeach

            </div>
        </section>


        {{-- ── EMPTY STATE — uncomment when no sessions at all ── --}}
        {{--
        <section class="flex flex-col items-center justify-center gap-5 py-24 text-center">
            <div class="w-16 h-16 rounded-2xl bg-white border border-gray-200 flex items-center justify-center">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" class="text-gray-300">
                    <rect x="3" y="4" width="18" height="18" rx="2.5" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M3 9h18" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    <path d="M8 2v4M16 2v4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Belum ada sesi tersedia</p>
                <p class="text-[0.75rem] font-light text-gray-400 mt-1 leading-relaxed">
                    Sesi akan muncul di sini ketika tersedia
                </p>
            </div>
        </section>
        --}}


        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>


    </main>

</x-layout-main>
