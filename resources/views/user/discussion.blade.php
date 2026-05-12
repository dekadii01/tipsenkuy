<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Diskusi Kelas">

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
                <a href="{{ route('session.detail', $session->id) }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                    Detail Sesi
                </a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-xs font-light text-gray-500">Diskusi</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-light tracking-tight text-gray-900">
                        Diskusi <span class="font-medium">Kelas Basis Data</span>
                    </h1>
                    <p class="text-sm font-light text-gray-400 mt-1">
                        Forum tanya jawab dan diskusi antara peserta dan dosen
                    </p>
                </div>
                <a href="{{ route('session.detail', $session->id) }}"
                    class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-xl transition-colors no-underline self-start shrink-0">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                        <path d="M8 3L4 6l4 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Kembali ke Sesi
                </a>
            </div>

        </section>


        {{-- ── MAIN GRID ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- ════════════════════════════════
                 LEFT — Thread list (2/3)
            ════════════════════════════════ --}}
            <div class="lg:col-span-2 flex flex-col gap-4">

                {{-- New post form --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5">
                        <form method="POST" action="" class="flex flex-col gap-3">
                            @csrf

                            <input type="text" name="title" placeholder="Judul pertanyaan atau topik diskusi..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">

                            <textarea name="body" rows="3" placeholder="Tulis pertanyaan atau diskusimu di sini..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 resize-none leading-relaxed"></textarea>

                            <div class="flex items-center justify-between gap-3">
                                <p class="text-[0.7rem] font-light text-gray-400">
                                    Posting sebagai <span
                                        class="text-gray-600 font-normal">{{ auth()->user()->first_name ?? 'Kamu' }}</span>
                                </p>
                                <button type="submit"
                                    class="flex items-center gap-2 px-5 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                    <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                        <path d="M2 7h8M7 4l3 3-3 3" stroke="currentColor" stroke-width="1.3"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Posting
                                </button>
                            </div>

                        </form>
                    </div>
                </div>


                {{-- Filter tabs --}}
                <div class="flex items-center gap-1.5 p-1 bg-white border border-gray-200 rounded-xl self-start">
                    @foreach ([['all', 'Semua', true], ['unanswered', 'Belum dijawab', false], ['mine', 'Milikku', false]] as [$val, $label, $active])
                        <a href="{{ request()->fullUrlWithQuery(['tab' => $val]) }}" @class([
                            'px-3 py-1.5 rounded-lg text-xs font-normal transition-all duration-150 no-underline whitespace-nowrap',
                            'bg-blue-900 text-white' => $active,
                            'text-gray-500 hover:text-gray-800' => !$active,
                        ])>
                            {{ $label }}
                        </a>
                    @endforeach
                </div>


                {{-- Thread list --}}
                <div class="flex flex-col gap-3">

                    @foreach ([
        [
            'id' => 1,
            'title' => 'Kapan tugas pemrograman SQL dikumpulkan?',
            'body' => 'Saya ingin tahu deadline pengumpulan tugas SQL yang diberikan kemarin. Apakah ada tenggat waktu tertentu yang harus diperhatikan?',
            'author' => 'Budi Santoso',
            'role' => 'participant',
            'time' => '10 menit lalu',
            'replies' => 3,
            'pinned' => false,
            'answered' => true,
        ],
        [
            'id' => 2,
            'title' => 'Pengumuman: Materi pertemuan ke-4 sudah diunggah',
            'body' => 'Slide dan modul untuk pertemuan ke-4 tentang normalisasi database sudah tersedia di portal. Silakan unduh sebelum kelas dimulai.',
            'author' => 'Admin',
            'role' => 'admin',
            'time' => '1 jam lalu',
            'replies' => 5,
            'pinned' => true,
            'answered' => false,
        ],
        [
            'id' => 3,
            'title' => 'Cara membuat foreign key yang benar di MySQL?',
            'body' => 'Saya mencoba membuat relasi antar tabel menggunakan foreign key tapi selalu muncul error. Apakah ada yang bisa membantu?',
            'author' => 'Citra Dewi',
            'role' => 'participant',
            'time' => '3 jam lalu',
            'replies' => 7,
            'pinned' => false,
            'answered' => true,
        ],
        [
            'id' => 4,
            'title' => 'Perbedaan antara INNER JOIN dan LEFT JOIN',
            'body' => 'Saya masih bingung dengan perbedaan INNER JOIN dan LEFT JOIN. Bisa dijelaskan dengan contoh sederhana?',
            'author' => 'Dimas Rahardjo',
            'role' => 'participant',
            'time' => 'Kemarin',
            'replies' => 2,
            'pinned' => false,
            'answered' => false,
        ],
        [
            'id' => 5,
            'title' => 'Reminder: Kuis minggu depan mencakup materi ERD',
            'body' => 'Mohon dipersiapkan materi tentang Entity Relationship Diagram karena akan menjadi salah satu topik utama kuis minggu depan.',
            'author' => 'Admin',
            'role' => 'admin',
            'time' => 'Kemarin',
            'replies' => 1,
            'pinned' => true,
            'answered' => false,
        ],
    ] as $thread)
                        <a href="{{ route('session.discussion.show', ['session' => $session->id, 'thread' => $thread['id']]) }}"
                            class="bg-white border border-gray-200 hover:border-gray-300 rounded-2xl overflow-hidden transition-colors no-underline group">

                            <div class="flex">
                                {{-- Left accent --}}
                                <div @class([
                                    'w-[3px] shrink-0',
                                    'bg-blue-900' => $thread['role'] === 'admin',
                                    'bg-gray-200' => $thread['role'] !== 'admin',
                                ])></div>

                                <div class="flex-1 px-5 py-4 flex flex-col gap-2.5">

                                    {{-- Top row --}}
                                    <div class="flex items-start gap-2 flex-wrap">

                                        {{-- Pinned badge --}}
                                        @if ($thread['pinned'])
                                            <span
                                                class="flex items-center gap-1 text-[0.62rem] font-light text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5 shrink-0">
                                                <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                                    <path d="M5 1v4M3 5h4M5 5v4" stroke="currentColor"
                                                        stroke-width="1.2" stroke-linecap="round" />
                                                    <circle cx="5" cy="2" r="1" fill="currentColor" />
                                                </svg>
                                                Disematkan
                                            </span>
                                        @endif

                                        {{-- Answered badge --}}
                                        @if ($thread['answered'])
                                            <span
                                                class="flex items-center gap-1 text-[0.62rem] font-light text-green-700 bg-green-50 border border-green-200 rounded-full px-2 py-0.5 shrink-0">
                                                <svg width="9" height="9" viewBox="0 0 10 10"
                                                    fill="none">
                                                    <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor"
                                                        stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                Terjawab
                                            </span>
                                        @endif

                                        @if ($thread['role'] === 'admin')
                                            <span
                                                class="text-[0.62rem] font-light text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5 shrink-0">
                                                Dosen / Admin
                                            </span>
                                        @endif

                                    </div>

                                    {{-- Title --}}
                                    <p
                                        class="text-sm font-medium text-gray-900 group-hover:text-blue-900 transition-colors leading-snug">
                                        {{ $thread['title'] }}
                                    </p>

                                    {{-- Body preview --}}
                                    <p class="text-xs font-light text-gray-500 leading-relaxed line-clamp-2">
                                        {{ $thread['body'] }}
                                    </p>

                                    {{-- Footer --}}
                                    <div class="flex items-center justify-between gap-3 pt-1">

                                        <div class="flex items-center gap-2.5">
                                            {{-- Author avatar --}}
                                            <div @class([
                                                'w-5 h-5 rounded-md flex items-center justify-center text-[0.5rem] font-medium shrink-0',
                                                'bg-blue-900 text-white' => $thread['role'] === 'admin',
                                                'bg-blue-50 border border-blue-100 text-blue-900' =>
                                                    $thread['role'] !== 'admin',
                                            ])>
                                                {{ strtoupper(substr($thread['author'], 0, 2)) }}
                                            </div>
                                            <span
                                                class="text-[0.7rem] font-light text-gray-500">{{ $thread['author'] }}</span>
                                            <span class="text-gray-300 text-xs">·</span>
                                            <span
                                                class="text-[0.7rem] font-light text-gray-400">{{ $thread['time'] }}</span>
                                        </div>

                                        <div class="flex items-center gap-1.5 shrink-0">
                                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none"
                                                class="text-gray-400">
                                                <path d="M12 8a2 2 0 0 1-2 2H4l-2 2V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z"
                                                    stroke="currentColor" stroke-width="1.2"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span
                                                class="text-[0.7rem] font-light text-gray-400">{{ $thread['replies'] }}
                                                balasan</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>


                {{-- Pagination --}}
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <p class="text-[0.72rem] font-light text-gray-400">
                        Halaman <span class="font-medium text-gray-600">1</span> dari <span
                            class="font-medium text-gray-600">3</span>
                    </p>
                    <div class="flex items-center gap-1.5">
                        <a href="#"
                            class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M8 3L5 6l3 3" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        @foreach ([1, 2, 3] as $page)
                            <a href="#" @class([
                                'flex items-center justify-center w-8 h-8 rounded-lg text-xs font-normal transition-colors no-underline',
                                'bg-blue-900 text-white border border-blue-900' => $page === 1,
                                'border border-gray-200 text-gray-500 hover:bg-gray-50 hover:border-gray-300' =>
                                    $page !== 1,
                            ])>{{ $page }}</a>
                        @endforeach
                        <a href="#"
                            class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>


            </div>


            {{-- ════════════════════════════════
                 RIGHT — Info panel (1/3)
            ════════════════════════════════ --}}
            <div class="flex flex-col gap-4">

                {{-- Session info summary --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">
                        <h2 class="text-sm font-medium text-gray-900">Info Sesi</h2>
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <rect x="1.5" y="2.5" width="9" height="8" rx="1.5"
                                        stroke="currentColor" stroke-width="1.2" />
                                    <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">Senin, 5 April 2026</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">08:00 – 10:00 WITA</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="4" r="2" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M2 10c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                        stroke-width="1.2" stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">32 peserta</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-xs font-light text-green-600">Sedang berlangsung</span>
                        </div>
                    </div>
                </div>

                {{-- Discussion stats --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Statistik Forum</h2>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ([['14', 'Total thread'], ['38', 'Total balasan'], ['3', 'Belum dijawab'], ['5', 'Dari dosen']] as [$num, $label])
                            <div
                                class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <p class="text-base font-light text-gray-900">{{ $num }}</p>
                                <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">
                                    {{ $label }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Active participants --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-900">Aktif di Forum</h2>
                        <span class="flex items-center gap-1 text-[0.65rem] font-light text-green-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            4 online
                        </span>
                    </div>
                    <div class="flex flex-col gap-2.5">
                        @foreach ([['Admin', 'admin', true, '3 post'], ['Budi Santoso', 'peserta', true, '2 post'], ['Citra Dewi', 'peserta', true, '1 post'], ['Dimas Rahardjo', 'peserta', false, '1 post']] as [$name, $role, $online, $posts])
                            <div class="flex items-center gap-2.5">
                                <div class="relative shrink-0">
                                    <div @class([
                                        'w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-medium',
                                        'bg-blue-900 text-white' => $role === 'admin',
                                        'bg-blue-50 border border-blue-100 text-blue-900' => $role !== 'admin',
                                    ])>
                                        {{ strtoupper(substr($name, 0, 2)) }}
                                    </div>
                                    @if ($online)
                                        <span
                                            class="absolute -bottom-0.5 -right-0.5 w-2 h-2 rounded-full bg-green-500 border border-white"></span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-normal text-gray-700 truncate">{{ $name }}</p>
                                    <p class="text-[0.62rem] font-light text-gray-400">{{ $posts }}</p>
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
