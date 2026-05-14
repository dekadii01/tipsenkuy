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
                        Diskusi <span class="font-medium">Kelas {{ $session->nama_sesi }}</span>
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
                <div class="flex flex-col gap-3" id="thread-list">

                    @foreach ($threads as $thread)
                        <a href="{{ route('session.discussion.show', ['session' => $session->id, 'thread' => $thread->id]) }}"
                            class="bg-white border border-gray-200 hover:border-gray-300 rounded-2xl overflow-hidden transition-colors no-underline group">

                            <div class="flex">
                                {{-- Left accent --}}
                                <div @class([
                                    'w-[3px] shrink-0',
                                    'bg-blue-900' => $thread->user->role === 'admin',
                                    'bg-gray-200' => $thread->user->role !== 'admin',
                                ])></div>

                                <div class="flex-1 px-5 py-4 flex flex-col gap-2.5">

                                    {{-- Top row --}}
                                    <div class="flex items-start gap-2 flex-wrap">

                                        @if ($thread->is_pinned)
                                            <span
                                                class="flex items-center gap-1 text-[0.62rem] font-light text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5 shrink-0">
                                                <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                                    <path d="M5 1v4M3 5h4M5 5v4" stroke="currentColor"
                                                        stroke-width="1.2" stroke-linecap="round" />
                                                    <circle cx="5" cy="2" r="1"
                                                        fill="currentColor" />
                                                </svg>
                                                Disematkan
                                            </span>
                                        @endif

                                        @if ($thread->is_answered)
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

                                        @if ($thread->user->role === 'admin')
                                            <span
                                                class="text-[0.62rem] font-light text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5 shrink-0">
                                                Dosen / Admin
                                            </span>
                                        @endif

                                    </div>

                                    {{-- Title --}}
                                    <p
                                        class="text-sm font-medium text-gray-900 group-hover:text-blue-900 transition-colors leading-snug">
                                        {{ $thread->title }}
                                    </p>

                                    {{-- Body preview --}}
                                    <p class="text-xs font-light text-gray-500 leading-relaxed line-clamp-2">
                                        {{ $thread->body }}
                                    </p>

                                    {{-- Footer --}}
                                    <div class="flex items-center justify-between gap-3 pt-1">

                                        <div class="flex items-center gap-2.5">
                                            <div @class([
                                                'w-5 h-5 rounded-md flex items-center justify-center text-[0.5rem] font-medium shrink-0',
                                                'bg-blue-900 text-white' => $thread->user->role === 'admin',
                                                'bg-blue-50 border border-blue-100 text-blue-900' =>
                                                    $thread->user->role !== 'admin',
                                            ])>
                                                {{ strtoupper(substr($thread->user->first_name, 0, 1) . substr($thread->user->last_name ?? '', 0, 1)) }}
                                            </div>
                                            <span class="text-[0.7rem] font-light text-gray-500">
                                                {{ $thread->user->first_name }} {{ $thread->user->last_name }}
                                            </span>
                                            <span class="text-gray-300 text-xs">·</span>
                                            <span class="text-[0.7rem] font-light text-gray-400">
                                                {{ $thread->created_at->diffForHumans() }}
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-3 shrink-0">
                                            <div class="flex items-center gap-1.5">
                                                <svg width="12" height="12" viewBox="0 0 14 14"
                                                    fill="none" class="text-gray-400">
                                                    <path
                                                        d="M12 8a2 2 0 0 1-2 2H4l-2 2V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z"
                                                        stroke="currentColor" stroke-width="1.2"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <span class="text-[0.7rem] font-light text-gray-400"
                                                    id="reply-count-{{ $thread->id }}">
                                                    {{ $thread->replies_count }} balasan
                                                </span>
                                            </div>

                                            {{-- Tombol hapus: tampil hanya untuk pemilik thread (jika belum ada reply orang lain) --}}
                                            @if (auth()->id() === $thread->user_id && $thread->replies_count === 0)
                                                <button
                                                    onclick="event.preventDefault(); deleteThread({{ $thread->id }}, this)"
                                                    class="flex items-center gap-1 text-[0.65rem] font-light text-gray-300 hover:text-red-500 transition-colors"
                                                    title="Hapus thread">
                                                    <svg width="11" height="11" viewBox="0 0 12 12"
                                                        fill="none">
                                                        <path d="M2 3h8M5 3V2h2v1M4.5 3v6.5h3V3" stroke="currentColor"
                                                            stroke-width="1.2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            @endif
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
                        Halaman <span class="font-medium text-gray-600">{{ $threads->currentPage() }}</span>
                        dari <span class="font-medium text-gray-600">{{ $threads->lastPage() }}</span>
                    </p>
                    <div class="flex items-center gap-1.5">
                        @if ($threads->onFirstPage())
                            <span
                                class="flex items-center justify-center w-8 h-8 border border-gray-100 rounded-lg text-gray-300 cursor-not-allowed">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M8 3L5 6l3 3" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $threads->previousPageUrl() }}"
                                class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M8 3L5 6l3 3" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @endif

                        @foreach ($threads->getUrlRange(1, $threads->lastPage()) as $page => $url)
                            <a href="{{ $url }}" @class([
                                'flex items-center justify-center w-8 h-8 rounded-lg text-xs font-normal transition-colors no-underline',
                                'bg-blue-900 text-white border border-blue-900' =>
                                    $page === $threads->currentPage(),
                                'border border-gray-200 text-gray-500 hover:bg-gray-50 hover:border-gray-300' =>
                                    $page !== $threads->currentPage(),
                            ])>{{ $page }}</a>
                        @endforeach

                        @if ($threads->hasMorePages())
                            <a href="{{ $threads->nextPageUrl() }}"
                                class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @else
                            <span
                                class="flex items-center justify-center w-8 h-8 border border-gray-100 rounded-lg text-gray-300 cursor-not-allowed">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        @endif
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
                                <span
                                    class="text-xs font-light text-gray-500">{{ $detailSession->tanggal->format('l, j F Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">{{ $detailSession->jam_mulai }}
                                    – {{ $detailSession->jam_selesai }} WITA</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="4" r="2" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M2 10c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                        stroke-width="1.2" stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500">22
                                    peserta</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 mt-1">
                            @if ($detailSession->status == 'ended')
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                <span class="text-xs font-light text-gray-400">Sesi berakhir</span>
                            @else
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                <span class="text-xs font-light text-green-600">Sedang berlangsung</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Discussion stats --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Statistik Forum</h2>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ([['total_threads', $stats['total_threads'], 'Total thread'], ['total_replies', $stats['total_replies'], 'Total balasan'], ['unanswered', $stats['unanswered'], 'Belum dijawab'], ['from_admin', $stats['from_admin'], 'Dari dosen']] as [$key, $num, $label])
                            <div
                                class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <p class="text-base font-light text-gray-900" data-stat="{{ $key }}">
                                    {{ $num }}</p>
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
                            <span data-online-count>0 online</span>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2.5" id="active-participants">
                        <p class="text-xs font-light text-gray-400">Memuat peserta...</p>
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

    <script>
        // ── Realtime discussion index ──────────────────────────────
        const ALL_PARTICIPANTS = @json($allParticipants);
        const SESSION_ID = {{ $session->id }};
        const CURRENT_UID = {{ auth()->id() }};

        let onlineUsers = []; // simpan list user online
        let onlineUserIds = new Set();

        function initEcho() {
            if (!window.Echo) {
                setTimeout(initEcho, 100);
                return;
            }

            window.Echo.join(`session.${SESSION_ID}`)
                .here((users) => {
                    onlineUsers = users;
                    onlineUserIds = new Set(users.map(u => u.id));
                    renderOnline();
                    renderParticipants();
                })
                .joining((user) => {
                    if (!onlineUsers.find(u => u.id === user.id)) {
                        onlineUsers.push(user);
                    }
                    onlineUserIds.add(user.id);
                    renderOnline();
                    renderParticipants();
                })
                .leaving((user) => {
                    onlineUsers = onlineUsers.filter(u => u.id !== user.id);
                    onlineUserIds.delete(user.id);
                    renderOnline();
                    renderParticipants();
                })
                .listen('.thread.posted', (e) => {
                    prependThread(e.thread);
                    bumpStat('total_threads');
                })
                .listen('.reply.posted', (e) => {
                    incrementReplyBadge(e.reply.thread_id);
                    bumpStat('total_replies');
                })
                .listen('.thread.deleted', (e) => {
                    const card = document.getElementById(`thread-card-${e.thread_id}`) ??
                        document.querySelector(`a[href*="/discussion/${e.thread_id}"]`);
                    if (!card) return;
                    card.style.transition = 'opacity 0.3s, transform 0.3s';
                    card.style.opacity = '0';
                    card.style.transform = 'translateX(8px)';
                    setTimeout(() => card.remove(), 300);
                    bumpStat('total_threads', -1);
                });;
        }
        initEcho();

        document.querySelector('form').addEventListener('submit', async function(e) {
            e.preventDefault(); // cegah redirect

            const form = e.target;
            const data = new FormData(form);

            const res = await fetch(form.action || window.location.href, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: new URLSearchParams(data),
            });

            if (res.ok) {
                form.reset(); // kosongkan form
            }
        });

        function renderParticipants() {
            const container = document.getElementById('active-participants');
            if (!container) return;

            // Urutkan: current user → admin → online → offline
            const sorted = [...ALL_PARTICIPANTS].sort((a, b) => {
                if (a.id === CURRENT_UID) return -1;
                if (b.id === CURRENT_UID) return 1;
                const aOnline = onlineUserIds.has(a.id);
                const bOnline = onlineUserIds.has(b.id);
                if (a.role === 'admin' && b.role !== 'admin') return -1;
                if (b.role === 'admin' && a.role !== 'admin') return 1;
                if (aOnline && !bOnline) return -1;
                if (!aOnline && bOnline) return 1;
                return 0;
            });

            container.innerHTML = sorted.map(user => {
                const isAdmin = user.role === 'admin';
                const isMe = user.id === CURRENT_UID;
                const isOnline = onlineUserIds.has(user.id);

                const avatarClass = isAdmin ?
                    'bg-blue-900 text-white' :
                    'bg-blue-50 border border-blue-100 text-blue-900';

                const roleLabel = isAdmin ? 'Dosen / Admin' : (isMe ? 'Kamu' : 'Peserta');

                // Badge online/offline
                const badge = isOnline ?
                    `<span class="absolute -bottom-0.5 -right-0.5 w-2 h-2 rounded-full bg-green-500 border border-white"></span>` :
                    `<span class="absolute -bottom-0.5 -right-0.5 w-2 h-2 rounded-full bg-gray-300 border border-white"></span>`;

                // Nama sedikit redup kalau offline
                const nameClass = isOnline ? 'text-gray-700' : 'text-gray-400';

                return `
            <div class="flex items-center gap-2.5">
                <div class="relative shrink-0">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-medium ${avatarClass} ${!isOnline ? 'opacity-50' : ''}">
                        ${user.initials}
                    </div>
                    ${badge}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-normal ${nameClass} truncate">
                        ${user.name}${isMe ? ' <span class="text-gray-400 font-light">(kamu)</span>' : ''}
                    </p>
                    <p class="text-[0.62rem] font-light ${isOnline ? 'text-green-500' : 'text-gray-300'}">
                        ${isOnline ? 'Online · ' + roleLabel : 'Offline'}
                    </p>
                </div>
            </div>`;
            }).join('');
        }

        // ── Render online count ──
        function renderOnline() {
            document.querySelectorAll('[data-online-count]').forEach(el => {
                el.textContent = onlineUserIds.size + ' online';
            });
        }

        // ── Prepend thread card baru ──
        function prependThread(thread) {
            const list = document.getElementById('thread-list');
            if (!list) return;

            // Jika sedang di tab "mine", jangan tampilkan thread orang lain
            const tab = new URLSearchParams(location.search).get('tab') || 'all';
            if (tab === 'mine') return;

            const isAdmin = thread.user.role === 'admin';
            const accentClass = isAdmin ? 'bg-blue-900' : 'bg-gray-200';
            const avatarClass = isAdmin ?
                'bg-blue-900 text-white' :
                'bg-blue-50 border border-blue-100 text-blue-900';

            const el = document.createElement('a');
            el.href = `/sessions/${SESSION_ID}/discussion/${thread.id}`;
            el.className =
                'bg-white border border-blue-200 hover:border-gray-300 rounded-2xl overflow-hidden transition-colors no-underline group realtime-new';
            el.id = `thread-card-${thread.id}`;
            el.innerHTML = `
        <div class="flex">
            <div class="w-[3px] shrink-0 ${accentClass}"></div>
            <div class="flex-1 px-5 py-4 flex flex-col gap-2.5">
                <div class="flex items-start gap-2 flex-wrap">
                    <span class="flex items-center gap-1 text-[0.62rem] font-light text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5 shrink-0">
                        Baru
                    </span>
                    ${isAdmin ? '<span class="text-[0.62rem] font-light text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5 shrink-0">Dosen / Admin</span>' : ''}
                </div>
                <p class="text-sm font-medium text-gray-900 group-hover:text-blue-900 transition-colors leading-snug">
                    ${thread.title}
                </p>
                <p class="text-xs font-light text-gray-500 leading-relaxed line-clamp-2">
                    ${thread.body}
                </p>
                <div class="flex items-center justify-between gap-3 pt-1">
                    <div class="flex items-center gap-2.5">
                        <div class="w-5 h-5 rounded-md flex items-center justify-center text-[0.5rem] font-medium shrink-0 ${avatarClass}">
                            ${thread.user.initials}
                        </div>
                        <span class="text-[0.7rem] font-light text-gray-500">${thread.user.name}</span>
                        <span class="text-gray-300 text-xs">·</span>
                        <span class="text-[0.7rem] font-light text-gray-400">${thread.created_at}</span>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0">
                        <svg width="12" height="12" viewBox="0 0 14 14" fill="none" class="text-gray-400">
                            <path d="M12 8a2 2 0 0 1-2 2H4l-2 2V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                        </svg>
                        <span class="text-[0.7rem] font-light text-gray-400" id="reply-count-${thread.id}">0 balasan</span>
                    </div>
                </div>
            </div>
        </div>`;

            list.prepend(el);
            showToast(`Thread baru: "${thread.title.substring(0, 40)}..."`);

            // Fade border biru setelah 5 detik
            setTimeout(() => el.classList.remove('border-blue-200'), 5000);
        }

        // ── Increment reply badge di kartu thread ──
        function incrementReplyBadge(threadId) {
            const el = document.getElementById(`reply-count-${threadId}`);
            if (!el) return;
            const current = parseInt(el.textContent) || 0;
            el.textContent = (current + 1) + ' balasan';
            el.classList.add('text-blue-700');
            setTimeout(() => el.classList.remove('text-blue-700'), 2000);
        }

        // ── Hapus thread ──
        async function deleteThread(threadId, btn) {
            if (!confirm('Hapus thread ini? Tindakan tidak bisa dibatalkan.')) return;

            btn.disabled = true;
            btn.textContent = 'Menghapus...';

            try {
                const res = await fetch(`/sessions/${SESSION_ID}/discussion/${threadId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });

                const data = await res.json();

                if (data.success) {
                    const card = document.getElementById(`thread-card-${threadId}`) ??
                        btn.closest('a');
                    if (card) {
                        card.style.transition = 'opacity 0.3s, transform 0.3s';
                        card.style.opacity = '0';
                        card.style.transform = 'translateX(8px)';
                        setTimeout(() => card.remove(), 300);
                    }
                    bumpStat('total_threads', -1);
                } else {
                    alert(data.message ?? 'Gagal menghapus thread.');
                    btn.disabled = false;
                    btn.textContent = 'Hapus';
                }
            } catch (err) {
                console.error(err);
                btn.disabled = false;
                btn.textContent = 'Hapus';
            }
        }

        // ── Bump stat counter di sidebar ──
        function bumpStat(key, delta = 1) {
            const el = document.querySelector(`[data-stat="${key}"]`);
            if (!el) return;
            el.textContent = Math.max(0, parseInt(el.textContent || '0') + delta);
        }

        // ── Toast notification ──
        function showToast(msg) {
            const existing = document.getElementById('rt-toast');
            if (existing) existing.remove();

            const toast = document.createElement('div');
            toast.id = 'rt-toast';
            toast.className =
                'fixed bottom-5 right-5 z-50 flex items-center gap-2.5 px-4 py-3 bg-white border border-gray-200 rounded-2xl shadow-sm text-xs font-light text-gray-700';
            toast.innerHTML = `
        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse shrink-0"></span>
        ${msg}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 5000);
        }
    </script>

</x-layout-main>
