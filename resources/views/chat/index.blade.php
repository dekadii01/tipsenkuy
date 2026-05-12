<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased" title="Pesan">

    {{-- NAVBAR --}}
    <x-navbar-auth-user />

    {{--
        ══════════════════════════════════════════════
        FULL-HEIGHT CHAT LAYOUT
        Uses flex column to fill remaining viewport
        height after navbar (~64px)
        ══════════════════════════════════════════════
    --}}
    <div class="max-w-6xl mx-auto px-6 py-6 flex flex-col gap-0" style="height: calc(100vh - 65px);">


        {{-- ── PAGE HEADER ── --}}
        <div class="flex items-center justify-between mb-5 shrink-0">
            <div>
                <h1 class="text-2xl font-light tracking-tight text-gray-900">
                    Pesan <span class="font-medium">& Chat</span>
                </h1>
                <p class="text-sm font-light text-gray-400 mt-0.5">Komunikasi langsung dengan admin atau peserta</p>
            </div>
        </div>


        {{-- ── CHAT SHELL ── --}}
        <div class="flex flex-1 gap-0 bg-white border border-gray-200 rounded-2xl overflow-hidden min-h-0">


            {{-- ════════════════════════════════════
                 SIDEBAR — Conversation List
                 Hidden on mobile, shown as overlay
            ════════════════════════════════════ --}}
            <aside class="hidden md:flex flex-col w-72 lg:w-80 border-r border-gray-100 shrink-0">

                {{-- Sidebar header --}}
                <div class="px-5 py-4 border-b border-gray-100 shrink-0">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg width="13" height="13" viewBox="0 0 14 14" fill="none" class="text-gray-400">
                                <circle cx="6" cy="6" r="4" stroke="currentColor" stroke-width="1.3" />
                                <path d="M10 10l2 2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Cari percakapan..."
                            class="w-full pl-8 pr-3 py-2 text-xs font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                    </div>
                </div>

                {{-- Conversation list --}}
                <div class="flex-1 overflow-y-auto">

                    {{-- Active conversation --}}
                    @foreach ([['Admin TipsenKuy', 'QR sesi sudah bisa digunakan', '08:42', true, true, 0], ['Budi Santoso', 'Terima kasih, pak!', 'Kemarin', false, false, 2], ['Citra Dewi', 'Saya tidak bisa scan QR nya', 'Kemarin', false, false, 1], ['Dimas Rahardjo', 'Kapan sesi berikutnya, pak?', 'Senin', false, false, 0], ['Eka Fitriani', 'Baik, saya sudah absen', 'Senin', false, false, 0], ['Fajar Nugroho', 'Izin tidak hadir hari ini', 'Minggu', false, false, 0], ['Gita Permata', 'Notifikasi belum saya terima', 'Minggu', false, false, 3]] as [$name, $preview, $time, $active, $online, $unread])
                        <a href="#" @class([
                            'flex items-center gap-3 px-5 py-3.5 transition-colors no-underline border-b border-gray-50',
                            'bg-blue-50' => $active,
                            'hover:bg-gray-50' => !$active,
                        ])>

                            {{-- Avatar with online dot --}}
                            <div class="relative shrink-0">
                                <div @class([
                                    'w-9 h-9 rounded-xl flex items-center justify-center text-[0.65rem] font-medium tracking-wide',
                                    'bg-blue-900 text-white' => $active,
                                    'bg-blue-50 border border-blue-100 text-blue-900' => !$active,
                                ])>
                                    {{ strtoupper(substr($name, 0, 2)) }}
                                </div>
                                @if ($online)
                                    <span
                                        class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-green-500 border-2 border-white"></span>
                                @endif
                            </div>

                            {{-- Conversation info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-1">
                                    <p @class([
                                        'text-xs truncate',
                                        'font-medium text-blue-900' => $active,
                                        'font-normal text-gray-800' => !$active && $unread > 0,
                                        'font-light text-gray-600' => !$active && $unread === 0,
                                    ])>{{ $name }}</p>
                                    <span
                                        class="text-[0.6rem] font-light text-gray-400 shrink-0">{{ $time }}</span>
                                </div>
                                <p @class([
                                    'text-[0.68rem] truncate mt-0.5',
                                    'text-blue-700 font-light' => $active,
                                    'text-gray-700 font-normal' => !$active && $unread > 0,
                                    'text-gray-400 font-light' => !$active && $unread === 0,
                                ])>{{ $preview }}</p>
                            </div>

                            {{-- Unread badge --}}
                            @if ($unread > 0 && !$active)
                                <span
                                    class="w-4 h-4 rounded-full bg-blue-900 text-white text-[0.55rem] font-medium flex items-center justify-center shrink-0">
                                    {{ $unread }}
                                </span>
                            @endif

                        </a>
                    @endforeach

                </div>

            </aside>


            {{-- ════════════════════════════════════
                 MAIN — Chat Window
            ════════════════════════════════════ --}}
            <div class="flex-1 flex flex-col min-w-0 min-h-0">


                {{-- Chat header --}}
                <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3 shrink-0">

                    {{-- Mobile back --}}
                    <a href="#"
                        class="md:hidden flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors text-gray-400 no-underline">
                        <svg width="13" height="13" viewBox="0 0 12 12" fill="none">
                            <path d="M8 3L5 6l3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>

                    {{-- Recipient info --}}
                    <div class="relative shrink-0">
                        <div
                            class="w-9 h-9 rounded-xl bg-blue-900 flex items-center justify-center text-[0.65rem] font-medium text-white tracking-wide">
                            AD
                        </div>
                        <span
                            class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-green-500 border-2 border-white"></span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Admin TipsenKuy</p>
                        <p class="text-[0.7rem] font-light text-green-600">Online</p>
                    </div>

                    {{-- Chat actions --}}
                    <div class="flex items-center gap-2 shrink-0">
                        <button
                            class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-gray-600 transition-colors">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <circle cx="7" cy="7" r="1" fill="currentColor" />
                                <circle cx="2.5" cy="7" r="1" fill="currentColor" />
                                <circle cx="11.5" cy="7" r="1" fill="currentColor" />
                            </svg>
                        </button>
                    </div>

                </div>


                {{-- ── MESSAGE THREAD ── --}}
                <div class="flex-1 overflow-y-auto px-5 py-5 flex flex-col gap-4 min-h-0">

                    {{-- Date separator --}}
                    <div class="flex items-center gap-3 py-1">
                        <div class="flex-1 h-px bg-gray-100"></div>
                        <span class="text-[0.65rem] font-light text-gray-400 shrink-0">Senin, 5 April 2026</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>

                    {{-- Received: Admin --}}
                    <div class="flex items-end gap-2.5 max-w-sm">
                        <div
                            class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-medium text-white shrink-0 mb-1">
                            AD
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-2xl rounded-bl-sm">
                                <p class="text-sm font-light text-gray-800 leading-relaxed">
                                    Selamat pagi! Ada yang bisa saya bantu terkait absensi hari ini?
                                </p>
                            </div>
                            <span class="text-[0.6rem] font-light text-gray-400 ml-1">08:30</span>
                        </div>
                    </div>

                    {{-- Sent: User --}}
                    <div class="flex items-end gap-2.5 max-w-sm self-end flex-row-reverse">
                        <div
                            class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-[0.6rem] font-medium text-blue-900 shrink-0 mb-1">
                            AN
                        </div>
                        <div class="flex flex-col items-end gap-1">
                            <div class="px-4 py-2.5 bg-blue-900 rounded-2xl rounded-br-sm">
                                <p class="text-sm font-light text-white leading-relaxed">
                                    Selamat pagi, pak! Saya ingin tanya, QR code untuk sesi Basis Data sudah aktif
                                    belum?
                                </p>
                            </div>
                            <div class="flex items-center gap-1 mr-1">
                                <span class="text-[0.6rem] font-light text-gray-400">08:41</span>
                                <svg width="12" height="12" viewBox="0 0 14 14" fill="none"
                                    class="text-blue-400">
                                    <path d="M2 7l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6 7l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Received: Admin --}}
                    <div class="flex items-end gap-2.5 max-w-sm">
                        <div
                            class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-medium text-white shrink-0 mb-1">
                            AD
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-2xl rounded-bl-sm">
                                <p class="text-sm font-light text-gray-800 leading-relaxed">
                                    Sudah aktif! QR sesi sudah bisa digunakan. Silakan scan sekarang sebelum waktu habis
                                    ya.
                                </p>
                            </div>
                            <span class="text-[0.6rem] font-light text-gray-400 ml-1">08:42</span>
                        </div>
                    </div>

                    {{-- Sent: User --}}
                    <div class="flex items-end gap-2.5 max-w-sm self-end flex-row-reverse">
                        <div
                            class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-[0.6rem] font-medium text-blue-900 shrink-0 mb-1">
                            AN
                        </div>
                        <div class="flex flex-col items-end gap-1">
                            <div class="px-4 py-2.5 bg-blue-900 rounded-2xl rounded-br-sm">
                                <p class="text-sm font-light text-white leading-relaxed">
                                    Siap, terima kasih banyak pak! 🙏
                                </p>
                            </div>
                            <div class="flex items-center gap-1 mr-1">
                                <span class="text-[0.6rem] font-light text-gray-400">08:43</span>
                                <svg width="12" height="12" viewBox="0 0 14 14" fill="none"
                                    class="text-blue-400">
                                    <path d="M2 7l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6 7l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Date separator --}}
                    <div class="flex items-center gap-3 py-1 mt-2">
                        <div class="flex-1 h-px bg-gray-100"></div>
                        <span class="text-[0.65rem] font-light text-gray-400 shrink-0">Hari ini</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>

                    {{-- Received: Admin --}}
                    <div class="flex items-end gap-2.5 max-w-sm">
                        <div
                            class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-medium text-white shrink-0 mb-1">
                            AD
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-2xl rounded-bl-sm">
                                <p class="text-sm font-light text-gray-800 leading-relaxed">
                                    Selamat pagi! Sesi hari ini dimulai pukul 08:00. Jangan lupa absen ya 😊
                                </p>
                            </div>
                            <span class="text-[0.6rem] font-light text-gray-400 ml-1">07:55</span>
                        </div>
                    </div>

                    {{-- Typing indicator --}}
                    <div class="flex items-end gap-2.5 max-w-xs">
                        <div
                            class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-medium text-white shrink-0 mb-1">
                            AD
                        </div>
                        <div class="px-4 py-3 bg-gray-100 border border-gray-200 rounded-2xl rounded-bl-sm">
                            <div class="flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce"
                                    style="animation-delay: 0ms"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce"
                                    style="animation-delay: 150ms"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce"
                                    style="animation-delay: 300ms"></span>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- ── MESSAGE INPUT ── --}}
                <div class="px-5 py-4 border-t border-gray-100 shrink-0">
                    <form method="POST" action="" class="flex items-end gap-3">
                        @csrf

                        {{-- Attachment button --}}
                        <button type="button"
                            class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors shrink-0">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                <path
                                    d="M14 8.5l-6 6a4 4 0 0 1-5.66-5.66l6.5-6.5a2.5 2.5 0 0 1 3.54 3.54L6 12.34a1 1 0 0 1-1.41-1.41L11 5"
                                    stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>

                        {{-- Text input --}}
                        <div class="flex-1 relative">
                            <textarea name="message" rows="1" placeholder="Tulis pesan..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 resize-none leading-relaxed"></textarea>
                        </div>

                        {{-- Emoji button --}}
                        <button type="button"
                            class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors shrink-0">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="6.5" stroke="currentColor"
                                    stroke-width="1.3" />
                                <path d="M5.5 9.5s.8 1.5 2.5 1.5 2.5-1.5 2.5-1.5" stroke="currentColor"
                                    stroke-width="1.3" stroke-linecap="round" />
                                <circle cx="6" cy="6.5" r=".8" fill="currentColor" />
                                <circle cx="10" cy="6.5" r=".8" fill="currentColor" />
                            </svg>
                        </button>

                        {{-- Send button --}}
                        <button type="submit"
                            class="w-9 h-9 rounded-xl bg-blue-900 hover:bg-blue-950 flex items-center justify-center text-white transition-all duration-200 hover:-translate-y-px shrink-0">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                <path d="M14 2L2 7.5l5 1.5 1.5 5L14 2z" stroke="currentColor" stroke-width="1.3"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                    </form>
                </div>


            </div>


            {{-- ════════════════════════════════════
                 RIGHT PANEL — Session context
                 (Optional, shown on large screens)
            ════════════════════════════════════ --}}
            <aside class="hidden xl:flex flex-col w-64 border-l border-gray-100 shrink-0">

                <div class="px-5 py-4 border-b border-gray-100 shrink-0">
                    <p class="text-xs font-medium text-gray-700">Info Kontak</p>
                </div>

                <div class="flex-1 overflow-y-auto px-5 py-5 flex flex-col gap-5">

                    {{-- Contact avatar --}}
                    <div class="flex flex-col items-center gap-3 text-center">
                        <div class="relative">
                            <div
                                class="w-14 h-14 rounded-2xl bg-blue-900 flex items-center justify-center text-base font-medium text-white tracking-wide">
                                AD
                            </div>
                            <span
                                class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full bg-green-500 border-2 border-white"></span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Admin TipsenKuy</p>
                            <p class="text-[0.7rem] font-light text-green-600 mt-0.5">Online</p>
                            <span
                                class="text-[0.62rem] font-light tracking-widest uppercase text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-0.5 mt-1.5 inline-block">
                                Administrator
                            </span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100"></div>

                    {{-- Shared session context --}}
                    <div class="flex flex-col gap-2">
                        <p class="text-[0.65rem] font-normal text-gray-400 uppercase tracking-widest">Sesi Aktif</p>
                        <div class="flex flex-col gap-2">

                            @foreach (['Kelas Basis Data', 'Prak. Jaringan'] as $sesi)
                                <a href="#"
                                    class="flex items-center gap-2.5 px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl hover:border-gray-300 hover:bg-white transition-colors no-underline">
                                    <div
                                        class="w-6 h-6 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-blue-900">
                                            <rect x="1" y="1" width="4" height="4" rx="0.8"
                                                stroke="currentColor" stroke-width="1.1" />
                                            <rect x="7" y="1" width="4" height="4" rx="0.8"
                                                stroke="currentColor" stroke-width="1.1" />
                                            <rect x="1" y="7" width="4" height="4" rx="0.8"
                                                stroke="currentColor" stroke-width="1.1" />
                                            <path d="M8 9h1M9.5 7.5v1M9.5 9V10M11 9h-1" stroke="currentColor"
                                                stroke-width="1.1" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <span class="text-xs font-light text-gray-700 truncate">{{ $sesi }}</span>
                                </a>
                            @endforeach

                        </div>
                    </div>

                    <div class="border-t border-gray-100"></div>

                    {{-- Message stats --}}
                    <div class="flex flex-col gap-2">
                        <p class="text-[0.65rem] font-normal text-gray-400 uppercase tracking-widest">Percakapan</p>
                        <div class="grid grid-cols-2 gap-2">
                            <div
                                class="flex flex-col items-center gap-0.5 px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl">
                                <p class="text-base font-light text-gray-900">24</p>
                                <p class="text-[0.6rem] font-light text-gray-400 text-center leading-tight">
                                    Pesan<br>terkirim</p>
                            </div>
                            <div
                                class="flex flex-col items-center gap-0.5 px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl">
                                <p class="text-base font-light text-gray-900">3</p>
                                <p class="text-[0.6rem] font-light text-gray-400 text-center leading-tight">
                                    Belum<br>dibaca</p>
                            </div>
                        </div>
                    </div>

                </div>

            </aside>


        </div>
    </div>

</x-layout-main>
