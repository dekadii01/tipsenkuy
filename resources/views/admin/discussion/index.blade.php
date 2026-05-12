<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Diskusi Sesi — Admin">

    <x-navbar-admin />

    <main class="max-w-6xl mx-auto px-6 py-10 flex flex-col gap-8">

        {{-- ── BREADCRUMB & HEADER ── --}}
        <section class="flex flex-col gap-3">
            <nav class="flex items-center gap-1.5 flex-wrap">
                <a href="{{ route('admin.dashboard') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Dashboard</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('admin.attendance.index') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Sesi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('admin.attendance.detail', 1) }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Detail
                    Sesi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-xs font-light text-gray-500">Diskusi</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-light tracking-tight text-gray-900">
                        Diskusi <span class="font-medium">{{ $session->nama_sesi ?? 'Kelas Basis Data' }}</span>
                    </h1>
                    <p class="text-sm font-light text-gray-400 mt-1">
                        Moderasi dan kelola forum diskusi sesi ini
                    </p>
                </div>
                <a href="{{ route('admin.attendance.detail', 1) }}"
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ════════════════════════════════
                 LEFT — Thread list (2/3)
            ════════════════════════════════ --}}
            <div class="lg:col-span-2 flex flex-col gap-4">

                {{-- Post announcement form --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-2 mb-1">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-semibold text-white shrink-0">
                                AD
                            </div>
                            <div>
                                <span class="text-xs font-normal text-gray-700">Admin</span>
                                <span
                                    class="ml-1.5 text-[0.6rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5">Dosen
                                    / Admin</span>
                            </div>
                        </div>

                        <form method="POST" action="" class="flex flex-col gap-3">
                            @csrf
                            <input type="text" name="title" placeholder="Judul pengumuman atau topik diskusi..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                            <textarea name="body" rows="3" placeholder="Tulis pengumuman atau diskusi di sini..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 resize-none leading-relaxed"></textarea>

                            {{-- Admin extras --}}
                            <div class="flex items-center gap-4 px-1">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_pinned" value="1"
                                        class="w-3.5 h-3.5 rounded border-gray-300 text-blue-900 focus:ring-blue-200">
                                    <span class="text-xs font-light text-gray-600">Sematkan thread ini</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_announcement" value="1"
                                        class="w-3.5 h-3.5 rounded border-gray-300 text-blue-900 focus:ring-blue-200">
                                    <span class="text-xs font-light text-gray-600">Tandai sebagai pengumuman</span>
                                </label>
                            </div>

                            <div class="flex justify-end">
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

                {{-- Filter + search --}}
                <div class="flex flex-col sm:flex-row gap-2.5">
                    <div
                        class="flex items-center gap-1 p-1 bg-white border border-gray-200 rounded-xl self-start shrink-0">
                        @foreach ([['all', 'Semua'], ['unanswered', 'Belum dijawab'], ['pinned', 'Disematkan']] as [$val, $label])
                            @php $active = (request('tab', 'all') === $val); @endphp
                            <a href="{{ request()->fullUrlWithQuery(['tab' => $val]) }}"
                                @class([
                                    'px-3 py-1.5 rounded-lg text-xs font-normal transition-all duration-150 no-underline whitespace-nowrap',
                                    'bg-blue-900 text-white shadow-sm' => $active,
                                    'text-gray-500 hover:text-gray-800 hover:bg-gray-50' => !$active,
                                ])>{{ $label }}</a>
                        @endforeach
                    </div>
                    <div class="flex-1 relative">
                        <svg width="13" height="13" viewBox="0 0 14 14" fill="none"
                            class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none">
                            <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                stroke-width="1.3" />
                            <path d="M10 10l2.5 2.5" stroke="currentColor" stroke-width="1.3"
                                stroke-linecap="round" />
                        </svg>
                        <input type="text" placeholder="Cari diskusi..."
                            class="w-full pl-9 pr-4 py-2 text-xs font-light text-gray-700 bg-white border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                    </div>
                </div>

                {{-- Thread list --}}
                @php
                    $threads = [
                        [
                            'id' => 1,
                            'title' => 'Kapan tugas pemrograman SQL dikumpulkan?',
                            'body' => 'Saya ingin tahu deadline pengumpulan tugas SQL yang diberikan kemarin.',
                            'author' => 'Budi Santoso',
                            'initials' => 'BS',
                            'role' => 'participant',
                            'time' => '10 menit lalu',
                            'replies' => 3,
                            'pinned' => false,
                            'answered' => true,
                            'reported' => false,
                        ],
                        [
                            'id' => 2,
                            'title' => 'Pengumuman: Materi pertemuan ke-4 sudah diunggah',
                            'body' => 'Slide dan modul untuk pertemuan ke-4 sudah tersedia di portal.',
                            'author' => 'Admin',
                            'initials' => 'AD',
                            'role' => 'admin',
                            'time' => '1 jam lalu',
                            'replies' => 5,
                            'pinned' => true,
                            'answered' => false,
                            'reported' => false,
                        ],
                        [
                            'id' => 3,
                            'title' => 'Cara membuat foreign key yang benar di MySQL?',
                            'body' => 'Saya mencoba membuat relasi antar tabel tapi selalu muncul error.',
                            'author' => 'Citra Dewi',
                            'initials' => 'CD',
                            'role' => 'participant',
                            'time' => '3 jam lalu',
                            'replies' => 7,
                            'pinned' => false,
                            'answered' => true,
                            'reported' => true,
                        ],
                        [
                            'id' => 4,
                            'title' => 'Perbedaan antara INNER JOIN dan LEFT JOIN',
                            'body' => 'Saya masih bingung dengan perbedaan keduanya.',
                            'author' => 'Dimas Rahardjo',
                            'initials' => 'DR',
                            'role' => 'participant',
                            'time' => 'Kemarin',
                            'replies' => 2,
                            'pinned' => false,
                            'answered' => false,
                            'reported' => false,
                        ],
                    ];
                @endphp

                <div class="flex flex-col gap-2.5">
                    @foreach ($threads as $thread)
                        <div
                            class="bg-white border {{ $thread['reported'] ? 'border-red-200' : 'border-gray-200' }} hover:border-gray-300 rounded-2xl overflow-hidden transition-all duration-200">
                            <div class="flex">
                                <div @class([
                                    'w-[3px] shrink-0',
                                    'bg-blue-900' => $thread['pinned'],
                                    'bg-red-400' => $thread['reported'] && !$thread['pinned'],
                                    'bg-gray-100' => !$thread['pinned'] && !$thread['reported'],
                                ])></div>

                                <div class="flex-1 px-5 py-4 flex flex-col gap-2.5 min-w-0">

                                    {{-- Badges --}}
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        @if ($thread['pinned'])
                                            <span
                                                class="inline-flex items-center gap-1 text-[0.62rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5">
                                                Disematkan
                                            </span>
                                        @endif
                                        @if ($thread['answered'])
                                            <span
                                                class="inline-flex items-center gap-1 text-[0.62rem] font-normal text-green-700 bg-green-50 border border-green-200 rounded-full px-2 py-0.5">
                                                <svg width="8" height="8" viewBox="0 0 10 10"
                                                    fill="none">
                                                    <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor"
                                                        stroke-width="1.3" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                Terjawab
                                            </span>
                                        @endif
                                        @if ($thread['reported'])
                                            <span
                                                class="inline-flex items-center gap-1 text-[0.62rem] font-normal text-red-600 bg-red-50 border border-red-200 rounded-full px-2 py-0.5">
                                                <svg width="8" height="8" viewBox="0 0 10 10"
                                                    fill="none">
                                                    <circle cx="5" cy="5" r="4" stroke="currentColor"
                                                        stroke-width="1.2" />
                                                    <path d="M5 3v2.5M5 7v.5" stroke="currentColor" stroke-width="1.2"
                                                        stroke-linecap="round" />
                                                </svg>
                                                Dilaporkan
                                            </span>
                                        @endif
                                        @if ($thread['role'] === 'admin')
                                            <span
                                                class="text-[0.62rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">
                                                Dosen / Admin
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-sm font-medium text-gray-900 leading-snug">{{ $thread['title'] }}
                                    </p>
                                    <p class="text-xs font-light text-gray-500 leading-relaxed line-clamp-2">
                                        {{ $thread['body'] }}</p>

                                    {{-- Footer --}}
                                    <div class="flex items-center justify-between gap-3 pt-0.5 flex-wrap">
                                        <div class="flex items-center gap-2">
                                            <div @class([
                                                'w-5 h-5 rounded-md flex items-center justify-center text-[0.5rem] font-semibold shrink-0',
                                                'bg-blue-900 text-white' => $thread['role'] === 'admin',
                                                'bg-blue-50 border border-blue-100 text-blue-900' =>
                                                    $thread['role'] !== 'admin',
                                            ])>{{ $thread['initials'] }}</div>
                                            <span
                                                class="text-[0.7rem] font-light text-gray-600">{{ $thread['author'] }}</span>
                                            <span class="text-gray-200">·</span>
                                            <span
                                                class="text-[0.7rem] font-light text-gray-400">{{ $thread['time'] }}</span>
                                            <span class="text-gray-200">·</span>
                                            <span
                                                class="text-[0.7rem] font-light text-gray-400">{{ $thread['replies'] }}
                                                balasan</span>
                                        </div>

                                        {{-- Admin quick actions --}}
                                        <div class="flex items-center gap-1.5">
                                            {{-- Pin toggle --}}
                                            <form method="POST" action="">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                    title="{{ $thread['pinned'] ? 'Lepas sematkan' : 'Sematkan' }}"
                                                    class="{{ $thread['pinned'] ? 'text-blue-700 bg-blue-50 border-blue-200' : 'text-gray-400 bg-white border-gray-200' }} flex items-center justify-center w-7 h-7 border rounded-lg hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700 transition-colors">
                                                    <svg width="11" height="11" viewBox="0 0 12 16"
                                                        fill="none">
                                                        <path d="M6 1v8M3 9h6M6 9v6" stroke="currentColor"
                                                            stroke-width="1.4" stroke-linecap="round" />
                                                    </svg>
                                                </button>
                                            </form>

                                            {{-- Delete --}}
                                            <form method="POST" action=""
                                                onsubmit="return confirm('Hapus thread ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" title="Hapus thread"
                                                    class="flex items-center justify-center w-7 h-7 border border-gray-200 bg-white rounded-lg text-gray-400 hover:bg-red-50 hover:border-red-200 hover:text-red-500 transition-colors">
                                                    <svg width="11" height="11" viewBox="0 0 12 12"
                                                        fill="none">
                                                        <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3"
                                                            stroke="currentColor" stroke-width="1.2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </form>

                                            {{-- Detail --}}
                                            <a href=""
                                                class="flex items-center gap-1 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-lg transition-colors no-underline">
                                                Buka
                                                <svg width="10" height="10" viewBox="0 0 12 12"
                                                    fill="none">
                                                    <path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor"
                                                        stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex items-center justify-between flex-wrap gap-4 pt-1">
                    <p class="text-[0.72rem] font-light text-gray-400">
                        Menampilkan <span class="font-medium text-gray-600">4</span> dari <span
                            class="font-medium text-gray-600">14</span> diskusi
                    </p>
                    <div class="flex items-center gap-1">
                        <a href="#"
                            class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 transition-colors no-underline">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M8 3L5 6l3 3" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        @foreach ([1, 2, 3] as $page)
                            <a href="#" @class([
                                'flex items-center justify-center w-8 h-8 rounded-lg text-xs font-normal transition-colors no-underline',
                                'bg-blue-900 text-white border border-blue-900' => $page === 1,
                                'border border-gray-200 text-gray-500 hover:bg-gray-50' => $page !== 1,
                            ])>{{ $page }}</a>
                        @endforeach
                        <a href="#"
                            class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 transition-colors no-underline">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            {{-- ════════════════════════════════
                 RIGHT — Sidebar (1/3)
            ════════════════════════════════ --}}
            <div class="flex flex-col gap-4 lg:sticky lg:top-6">

                {{-- Info sesi --}}
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
                                <span class="text-xs font-light text-gray-500">
                                    {{ isset($session) ? $session->tanggal->translatedFormat('l, d F Y') : 'Senin, 5 April 2026' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">
                                    {{ isset($session) ? $session->jam_mulai . ' – ' . $session->jam_selesai . ' WITA' : '08:00 – 10:00 WITA' }}
                                </span>
                            </div>
                        </div>
                        @php $status = $session->status ?? 'active'; @endphp
                        <div class="flex items-center gap-1.5 mt-1">
                            <span @class([
                                'w-1.5 h-1.5 rounded-full',
                                'bg-green-500 animate-pulse' => $status === 'active',
                                'bg-yellow-400' => $status === 'pending',
                                'bg-gray-400' => $status === 'ended',
                            ])></span>
                            <span @class([
                                'text-xs font-light',
                                'text-green-600' => $status === 'active',
                                'text-yellow-600' => $status === 'pending',
                                'text-gray-500' => $status === 'ended',
                            ])>
                                @if ($status === 'active')
                                    Sedang berlangsung
                                @elseif ($status === 'pending')
                                    Menunggu dimulai
                                @else
                                    Sesi berakhir
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Moderasi stats --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Statistik Forum</h2>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ([['14', 'Total thread', 'text-gray-900'], ['38', 'Total balasan', 'text-gray-900'], ['1', 'Dilaporkan', 'text-red-500'], ['3', 'Belum dijawab', 'text-orange-500']] as [$num, $label, $color])
                            <div
                                class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-100 rounded-xl">
                                <p class="text-base font-light {{ $color }}">{{ $num }}</p>
                                <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">
                                    {{ $label }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Kontributor aktif --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-4">
                    <h2 class="text-sm font-medium text-gray-900">Kontributor Aktif</h2>
                    <div class="flex flex-col gap-2.5">
                        @foreach ([['Budi Santoso', 'BS', 'participant', 4], ['Citra Dewi', 'CD', 'participant', 3], ['Dimas Rahardjo', 'DR', 'participant', 2], ['Eka Putri', 'EP', 'participant', 1]] as [$name, $initials, $role, $posts])
                            <div class="flex items-center gap-2.5">
                                <div
                                    class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[0.6rem] font-semibold text-blue-900 shrink-0">
                                    {{ $initials }}</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-normal text-gray-700 truncate">{{ $name }}</p>
                                    <p class="text-[0.62rem] font-light text-gray-400">{{ $posts }} post</p>
                                </div>
                                <div class="w-12 h-1 bg-gray-100 rounded-full overflow-hidden shrink-0">
                                    <div class="h-full bg-blue-200 rounded-full"
                                        style="width: {{ min(100, $posts * 25) }}%"></div>
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
