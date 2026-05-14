<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Detail Diskusi — Admin">

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
                <a href="{{ route('admin.attendance.detail', $session->id ?? 1) }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Detail
                    Sesi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('admin.attendance.discussions.index', $session->id ?? 1) }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Diskusi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-xs font-light text-gray-500">Detail Thread</span>
            </nav>

            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-light tracking-tight text-gray-900 leading-snug">
                        {{ $thread['title'] ?? 'Kapan tugas pemrograman SQL dikumpulkan?' }}
                    </h1>
                    <p class="text-sm font-light text-gray-400 mt-1">
                        {{ $session->nama_sesi ?? 'Kelas Basis Data' }}
                    </p>
                </div>
                <a href="{{ route('admin.attendance.discussions.index', $session->id ?? 1) }}"
                    class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-xl transition-colors no-underline shrink-0">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                        <path d="M8 3L4 6l4 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>
        </section>

        {{-- ── Flash ── --}}
        @if (session('success'))
            <div id="flash-success"
                class="flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-sm font-light text-green-700">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" class="shrink-0">
                    <circle cx="7" cy="7" r="6" stroke="currentColor" stroke-width="1.3" />
                    <path d="M4.5 7l2 2 3-3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- ── MAIN GRID ── --}}
        @php
            $thread = [
                'id' => 1,
                'title' => 'Kapan tugas pemrograman SQL dikumpulkan?',
                'body' =>
                    "Halo semuanya,\n\nSaya ingin menanyakan mengenai deadline pengumpulan tugas SQL yang diberikan pada pertemuan kemarin. Di slide tidak disebutkan tanggal pastinya.\n\nApakah ada yang tahu atau bisa admin konfirmasi? Terima kasih.",
                'author' => 'Budi Santoso',
                'initials' => 'BS',
                'role' => 'participant',
                'time' => '10 menit lalu',
                'answered' => true,
                'pinned' => false,
                'reported' => false,
            ];

            $replies = [
                [
                    'id' => 1,
                    'author' => 'Admin',
                    'initials' => 'AD',
                    'role' => 'admin',
                    'time' => '8 menit lalu',
                    'body' =>
                        "Halo Budi,\n\nDeadline pengumpulan tugas SQL adalah Jumat, 11 April 2026 pukul 23:59 WITA. Silakan kumpulkan melalui portal LMS.\n\nJika ada pertanyaan lain jangan ragu untuk bertanya.",
                    'is_answer' => true,
                    'likes' => 12,
                    'reported' => false,
                ],
                [
                    'id' => 2,
                    'author' => 'Citra Dewi',
                    'initials' => 'CD',
                    'role' => 'participant',
                    'time' => '5 menit lalu',
                    'body' => 'Wah makasih infonya! Saya hampir lupa. Berarti masih ada 3 hari lagi kan?',
                    'is_answer' => false,
                    'likes' => 3,
                    'reported' => false,
                ],
                [
                    'id' => 3,
                    'author' => 'Dimas Rahardjo',
                    'initials' => 'DR',
                    'role' => 'participant',
                    'time' => '2 menit lalu',
                    'body' => 'Sama, saya juga baru tahu. Terima kasih Admin!',
                    'is_answer' => false,
                    'likes' => 1,
                    'reported' => true,
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ════════════════════════════════
                 LEFT — Thread + Replies (2/3)
            ════════════════════════════════ --}}
            <div class="lg:col-span-2 flex flex-col gap-4">

                {{-- ── ORIGINAL POST ── --}}
                <div
                    class="bg-white border {{ $thread['reported'] ? 'border-red-200' : 'border-gray-200' }} rounded-2xl overflow-hidden">
                    <div class="h-[3px] {{ $thread['pinned'] ? 'bg-blue-900' : 'bg-gray-200' }}"></div>
                    <div class="p-6 flex flex-col gap-4">

                        {{-- Author + badges --}}
                        <div class="flex items-start justify-between gap-3 flex-wrap">
                            <div class="flex items-center gap-2.5">
                                <div @class([
                                    'w-9 h-9 rounded-xl flex items-center justify-center text-[0.65rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $thread['role'] === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' =>
                                        $thread['role'] !== 'admin',
                                ])>{{ $thread['initials'] }}</div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <p class="text-sm font-normal text-gray-800">{{ $thread['author'] }}</p>
                                        @if ($thread['role'] === 'admin')
                                            <span
                                                class="text-[0.6rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Admin</span>
                                        @endif
                                    </div>
                                    <p class="text-[0.65rem] font-light text-gray-400">{{ $thread['time'] }}</p>
                                </div>
                            </div>

                            {{-- Badges --}}
                            <div class="flex items-center gap-1.5 flex-wrap">
                                @if ($thread['pinned'])
                                    <span
                                        class="inline-flex items-center gap-1 text-[0.65rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-1">
                                        Disematkan
                                    </span>
                                @endif
                                @if ($thread['answered'])
                                    <span
                                        class="inline-flex items-center gap-1 text-[0.65rem] font-normal text-green-700 bg-green-50 border border-green-200 rounded-full px-2.5 py-1">
                                        <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                            <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.3"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Terjawab
                                    </span>
                                @endif
                                @if ($thread['reported'])
                                    <span
                                        class="inline-flex items-center gap-1 text-[0.65rem] font-normal text-red-600 bg-red-50 border border-red-200 rounded-full px-2.5 py-1">
                                        <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                            <circle cx="5" cy="5" r="4" stroke="currentColor"
                                                stroke-width="1.2" />
                                            <path d="M5 3v2.5M5 7v.5" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" />
                                        </svg>
                                        Dilaporkan
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        {{-- Body --}}
                        <div class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $thread['body'] }}</div>

                        {{-- Admin action bar untuk original post --}}
                        <div class="flex items-center gap-2 pt-1 border-t border-gray-100 flex-wrap">

                            {{-- Pin toggle --}}
                            <form method="POST" action="">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    class="{{ $thread['pinned'] ? 'text-blue-700 bg-blue-50 border-blue-200' : 'text-gray-500 bg-white border-gray-200 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700' }} flex items-center gap-1.5 px-3 py-1.5 border rounded-lg text-xs font-light transition-colors">
                                    <svg width="11" height="11" viewBox="0 0 12 16" fill="none">
                                        <path d="M6 1v8M3 9h6M6 9v6" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" />
                                    </svg>
                                    {{ $thread['pinned'] ? 'Lepas Sematkan' : 'Sematkan' }}
                                </button>
                            </form>

                            {{-- Mark answered --}}
                            <form method="POST" action="">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    class="{{ $thread['answered'] ? 'text-green-700 bg-green-50 border-green-200' : 'text-gray-500 bg-white border-gray-200 hover:bg-green-50 hover:border-green-200 hover:text-green-700' }} flex items-center gap-1.5 px-3 py-1.5 border rounded-lg text-xs font-light transition-colors">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                        <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    {{ $thread['answered'] ? 'Batalkan Terjawab' : 'Tandai Terjawab' }}
                                </button>
                            </form>

                            {{-- Delete thread --}}
                            <form method="POST" action=""
                                onsubmit="return confirm('Hapus thread ini beserta semua balasannya?')"
                                class="ml-auto">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-xs font-light text-gray-500 rounded-lg transition-colors">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                        <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor"
                                            stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Hapus Thread
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ── REPLIES ── --}}
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-normal text-gray-500 px-1 mb-2">{{ count($replies) }} Balasan</p>

                    @foreach ($replies as $reply)
                        <div class="flex gap-3 group" id="reply-{{ $reply['id'] }}">

                            {{-- Thread line + avatar --}}
                            <div class="flex flex-col items-center pt-1 shrink-0">
                                <div @class([
                                    'w-8 h-8 rounded-lg flex items-center justify-center text-[0.65rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $reply['role'] === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' =>
                                        $reply['role'] !== 'admin',
                                ])>{{ $reply['initials'] }}</div>
                                @if (!$loop->last)
                                    <div class="w-px flex-1 bg-gray-100 mt-2 mb-1 min-h-4"></div>
                                @endif
                            </div>

                            {{-- Reply card --}}
                            <div @class([
                                'flex-1 mb-3 rounded-2xl overflow-hidden border transition-all duration-200',
                                'border-red-200 bg-red-50/30' => $reply['reported'],
                                'border-green-200 bg-green-50/40' =>
                                    $reply['is_answer'] && !$reply['reported'],
                                'border-gray-200 bg-white' => !$reply['is_answer'] && !$reply['reported'],
                            ])>
                                @if ($reply['reported'])
                                    <div class="h-[2px] bg-red-400"></div>
                                @elseif ($reply['is_answer'])
                                    <div class="h-[2px] bg-green-500"></div>
                                @endif

                                <div class="p-4 flex flex-col gap-3">

                                    {{-- Reply header --}}
                                    <div class="flex items-center justify-between gap-2 flex-wrap">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-normal text-gray-800">{{ $reply['author'] }}</p>
                                            @if ($reply['role'] === 'admin')
                                                <span
                                                    class="text-[0.6rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Admin</span>
                                            @endif
                                            @if ($reply['is_answer'])
                                                <span
                                                    class="inline-flex items-center gap-1 text-[0.6rem] font-normal text-green-700 bg-green-100 border border-green-200 rounded-full px-2 py-0.5">
                                                    <svg width="8" height="8" viewBox="0 0 10 10"
                                                        fill="none">
                                                        <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor"
                                                            stroke-width="1.4" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Jawaban terpilih
                                                </span>
                                            @endif
                                            @if ($reply['reported'])
                                                <span
                                                    class="inline-flex items-center gap-1 text-[0.6rem] font-normal text-red-600 bg-red-50 border border-red-200 rounded-full px-2 py-0.5">
                                                    <svg width="8" height="8" viewBox="0 0 10 10"
                                                        fill="none">
                                                        <circle cx="5" cy="5" r="4"
                                                            stroke="currentColor" stroke-width="1.2" />
                                                        <path d="M5 3v2.5M5 7v.5" stroke="currentColor"
                                                            stroke-width="1.2" stroke-linecap="round" />
                                                    </svg>
                                                    Dilaporkan
                                                </span>
                                            @endif
                                        </div>
                                        <span
                                            class="text-[0.65rem] font-light text-gray-400">{{ $reply['time'] }}</span>
                                    </div>

                                    {{-- Body --}}
                                    <p class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">
                                        {{ $reply['body'] }}</p>

                                    {{-- Admin action footer --}}
                                    <div class="flex items-center gap-2 pt-1 border-t border-gray-100 flex-wrap">

                                        {{-- Like count (read-only untuk admin) --}}
                                        <div class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400">
                                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                                <path
                                                    d="M2 7.5C2 6.7 2.7 6 3.5 6H5V3.5C5 2.7 5.7 2 6.5 2S8 2.7 8 3.5V6h1.5C10.3 6 11 6.7 11 7.5v3c0 .8-.7 1.5-1.5 1.5h-6C2.7 12 2 11.3 2 10.5v-3z"
                                                    stroke="currentColor" stroke-width="1.2"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            {{ $reply['likes'] }} suka
                                        </div>

                                        {{-- Mark as answer --}}
                                        <form method="POST" action="">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="{{ $reply['is_answer'] ? 'text-green-700 bg-green-50 border-green-200' : 'text-gray-500 bg-white border-gray-200 hover:bg-green-50 hover:border-green-200 hover:text-green-700' }} flex items-center gap-1.5 px-2.5 py-1 border rounded-lg text-[0.7rem] font-light transition-colors">
                                                <svg width="10" height="10" viewBox="0 0 12 12"
                                                    fill="none">
                                                    <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                {{ $reply['is_answer'] ? 'Batalkan Jawaban' : 'Jadikan Jawaban' }}
                                            </button>
                                        </form>

                                        {{-- Dismiss report --}}
                                        @if ($reply['reported'])
                                            <form method="POST" action="">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                    class="flex items-center gap-1.5 px-2.5 py-1 border border-orange-200 bg-orange-50 text-orange-600 hover:bg-orange-100 rounded-lg text-[0.7rem] font-light transition-colors">
                                                    <svg width="10" height="10" viewBox="0 0 12 12"
                                                        fill="none">
                                                        <path d="M2 2l8 8M10 2l-8 8" stroke="currentColor"
                                                            stroke-width="1.3" stroke-linecap="round" />
                                                    </svg>
                                                    Abaikan Laporan
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Delete reply --}}
                                        <form method="POST" action=""
                                            onsubmit="return confirm('Hapus balasan ini?')" class="ml-auto">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center gap-1.5 px-2.5 py-1 border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-[0.7rem] font-light text-gray-500 rounded-lg transition-colors">
                                                <svg width="10" height="10" viewBox="0 0 12 12"
                                                    fill="none">
                                                    <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3"
                                                        stroke="currentColor" stroke-width="1.2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ── REPLY FORM (Admin) ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden" id="reply-form">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-2.5">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-semibold text-white shrink-0">
                                AD</div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs font-normal text-gray-700">Admin</span>
                                <span
                                    class="text-[0.6rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Dosen
                                    / Admin</span>
                            </div>
                        </div>

                        <form method="POST" action="" class="flex flex-col gap-3">
                            @csrf

                            {{-- Quote preview --}}
                            <div id="quote-preview"
                                class="hidden px-3 py-2.5 bg-gray-50 border-l-2 border-blue-300 rounded-r-xl">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span id="quote-author" class="text-[0.65rem] font-normal text-blue-700"></span>
                                    <button type="button" onclick="clearQuote()"
                                        class="text-gray-400 hover:text-gray-600">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <path d="M2 2l6 6M8 2l-6 6" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                                <p id="quote-body" class="text-[0.7rem] font-light text-gray-500 line-clamp-2"></p>
                                <input type="hidden" name="quote_reply_id" id="quote-reply-id">
                            </div>

                            <textarea name="body" id="reply-textarea" rows="3" placeholder="Tulis balasan sebagai admin..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 resize-none leading-relaxed"></textarea>

                            {{-- Admin reply extras --}}
                            <div class="flex items-center gap-4 px-1">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="mark_as_answer" value="1"
                                        class="w-3.5 h-3.5 rounded border-gray-300 text-blue-900 focus:ring-blue-200">
                                    <span class="text-xs font-light text-gray-600">Tandai sebagai jawaban</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-between gap-3">
                                <p class="text-[0.68rem] font-light text-gray-400">Balasan admin akan ditampilkan
                                    dengan label khusus</p>
                                <button type="submit"
                                    class="flex items-center gap-2 px-5 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px shrink-0">
                                    <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                        <path d="M2 7h8M7 4l3 3-3 3" stroke="currentColor" stroke-width="1.3"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Kirim Balasan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- ════════════════════════════════
                 RIGHT — Sidebar (1/3)
            ════════════════════════════════ --}}
            <div class="flex flex-col gap-4 lg:sticky lg:top-6">

                {{-- Thread info --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">
                        <h2 class="text-sm font-medium text-gray-900">Info Thread</h2>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="4" r="2" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M2 10c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                        stroke-width="1.2" stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">Dipost oleh <span
                                        class="text-gray-700 font-normal">{{ $thread['author'] }}</span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">{{ $thread['time'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <path d="M11 7a2 2 0 0 1-2 2H3l-2 2V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z"
                                        stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">{{ count($replies) }} balasan</span>
                            </div>
                        </div>

                        {{-- Status answered --}}
                        @if ($thread['answered'])
                            <div
                                class="flex items-center gap-2 px-3 py-2 bg-green-50 border border-green-200 rounded-xl">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    class="text-green-600 shrink-0">
                                    <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="text-[0.7rem] font-light text-green-700">Thread sudah terjawab</span>
                            </div>
                        @else
                            <div
                                class="flex items-center gap-2 px-3 py-2 bg-orange-50 border border-orange-200 rounded-xl">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    class="text-orange-500 shrink-0">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-[0.7rem] font-light text-orange-600">Menunggu jawaban</span>
                            </div>
                        @endif

                        {{-- Reported warning --}}
                        @if ($thread['reported'])
                            <div class="flex items-center gap-2 px-3 py-2 bg-red-50 border border-red-200 rounded-xl">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    class="text-red-500 shrink-0">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-[0.7rem] font-light text-red-600">Thread ini dilaporkan</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Admin moderasi tools --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Moderasi</h2>
                    <div class="flex flex-col gap-2">

                        {{-- Pin --}}
                        <form method="POST" action="">
                            @csrf @method('PATCH')
                            <button type="submit"
                                class="{{ $thread['pinned'] ? 'bg-blue-50 border-blue-200 text-blue-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700' }} w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-xl text-xs font-light transition-colors">
                                <svg width="12" height="12" viewBox="0 0 12 16" fill="none">
                                    <path d="M6 1v8M3 9h6M6 9v6" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" />
                                </svg>
                                {{ $thread['pinned'] ? 'Lepas Sematkan Thread' : 'Sematkan Thread' }}
                            </button>
                        </form>

                        {{-- Mark answered --}}
                        <form method="POST" action="">
                            @csrf @method('PATCH')
                            <button type="submit"
                                class="{{ $thread['answered'] ? 'bg-green-50 border-green-200 text-green-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-green-50 hover:border-green-200 hover:text-green-700' }} w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-xl text-xs font-light transition-colors">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ $thread['answered'] ? 'Batalkan Status Terjawab' : 'Tandai Thread Terjawab' }}
                            </button>
                        </form>

                        <div class="border-t border-gray-100 my-1"></div>

                        {{-- Delete thread --}}
                        <form method="POST" action=""
                            onsubmit="return confirm('Hapus thread ini beserta semua balasannya?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full flex items-center gap-2.5 px-3 py-2.5 border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-xs font-light text-gray-500 rounded-xl transition-colors">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor"
                                        stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Hapus Thread
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Partisipan --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-4">
                    <h2 class="text-sm font-medium text-gray-900">Partisipan</h2>
                    <div class="flex flex-col gap-2.5">
                        @php
                            $participants = array_merge([$thread], $replies);
                            $seen = [];
                        @endphp
                        @foreach ($participants as $p)
                            @php
                                if (in_array($p['author'], $seen)) {
                                    continue;
                                }
                                $seen[] = $p['author'];
                            @endphp
                            <div class="flex items-center gap-2.5">
                                <div @class([
                                    'w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $p['role'] === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' => $p['role'] !== 'admin',
                                ])>{{ $p['initials'] }}</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-normal text-gray-700 truncate">{{ $p['author'] }}</p>
                                    <p class="text-[0.62rem] font-light text-gray-400">
                                        @if ($loop->first)
                                            Pembuat thread
                                        @elseif ($p['role'] === 'admin')
                                            Admin / Dosen
                                        @else
                                            Peserta
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Thread lain --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Thread Lainnya</h2>
                    <div class="flex flex-col gap-2">
                        @foreach ([['Cara membuat foreign key?', 7, true, false], ['Perbedaan INNER JOIN dan LEFT JOIN', 2, false, false], ['Reminder: Kuis minggu depan', 1, false, true]] as [$title, $replyCount, $answered, $reported])
                            <a href="#"
                                class="flex items-start gap-2.5 px-3 py-2.5 bg-gray-50 border {{ $reported ? 'border-red-100' : 'border-gray-100' }} hover:border-gray-200 rounded-xl transition-colors no-underline group">
                                <div @class([
                                    'w-1.5 h-1.5 rounded-full mt-1.5 shrink-0',
                                    'bg-green-400' => $answered,
                                    'bg-red-400' => $reported,
                                    'bg-orange-300' => !$answered && !$reported,
                                ])></div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-xs font-normal text-gray-700 group-hover:text-blue-900 transition-colors line-clamp-2 leading-snug">
                                        {{ $title }}</p>
                                    <p class="text-[0.62rem] font-light text-gray-400 mt-0.5">{{ $replyCount }}
                                        balasan</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.attendance.discussions.index', $session->id ?? 1) }}"
                        class="text-[0.7rem] font-light text-blue-700 hover:text-blue-900 transition-colors no-underline text-center">
                        Lihat semua diskusi →
                    </a>
                </div>

            </div>
        </div>

        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>

    </main>

    <script>
        function quoteReply(author, body) {
            document.getElementById('quote-preview').classList.remove('hidden');
            document.getElementById('quote-author').textContent = author;
            document.getElementById('quote-body').textContent = body;
            document.getElementById('reply-textarea').focus();
            document.getElementById('reply-form').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function clearQuote() {
            document.getElementById('quote-preview').classList.add('hidden');
            document.getElementById('quote-author').textContent = '';
            document.getElementById('quote-body').textContent = '';
            document.getElementById('quote-reply-id').value = '';
        }

        const flash = document.getElementById('flash-success');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = 'opacity 0.4s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 400);
            }, 3000);
        }
    </script>

</x-layout-main>
