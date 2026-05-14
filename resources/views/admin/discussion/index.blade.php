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
                <a href="{{ route('admin.attendance.detail', $session['id']) }}"
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
                        Diskusi <span class="font-medium">{{ $session->nama_sesi }}</span>
                    </h1>
                    <p class="text-sm font-light text-gray-400 mt-1">
                        Moderasi dan kelola forum diskusi sesi ini
                    </p>
                </div>
                <a href="{{ route('admin.attendance.detail', $session['id']) }}"
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

            {{-- ════════════════ LEFT — Thread list (2/3) ════════════════ --}}
            <div class="lg:col-span-2 flex flex-col gap-4">

                {{-- Post announcement form --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-2 mb-1">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-semibold text-white shrink-0">
                                {{ strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name ?? '', 0, 1)) }}
                            </div>
                            <div>
                                <span class="text-xs font-normal text-gray-700">{{ auth()->user()->first_name }}</span>
                                <span
                                    class="ml-1.5 text-[0.6rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5">Dosen
                                    / Admin</span>
                            </div>
                        </div>

                        <form id="admin-post-form" method="POST"
                            action="{{ route('admin.attendance.discussions.store', $session->id) }}"
                            class="flex flex-col gap-3">
                            @csrf
                            <input type="text" name="title" placeholder="Judul pengumuman atau topik diskusi..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                            <textarea name="body" rows="3" placeholder="Tulis pengumuman atau diskusi di sini..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 resize-none leading-relaxed"></textarea>

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
                                <button type="submit" id="post-btn"
                                    class="flex items-center gap-2 px-5 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px disabled:opacity-60 disabled:cursor-not-allowed">
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
                    <form method="GET" class="flex-1 relative"
                        action="{{ route('admin.attendance.discussions.index', $session->id) }}">
                        <input type="hidden" name="tab" value="{{ request('tab', 'all') }}">
                        <svg width="13" height="13" viewBox="0 0 14 14" fill="none"
                            class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none">
                            <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                stroke-width="1.3" />
                            <path d="M10 10l2.5 2.5" stroke="currentColor" stroke-width="1.3"
                                stroke-linecap="round" />
                        </svg>
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="Cari diskusi..."
                            class="w-full pl-9 pr-4 py-2 text-xs font-light text-gray-700 bg-white border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                    </form>
                </div>

                {{-- Thread list --}}
                <div class="flex flex-col gap-2.5" id="thread-list">
                    @forelse ($threads as $thread)
                        @include('admin.discussion._thread-card', [
                            'thread' => $thread,
                            'session' => $session,
                        ])
                    @empty
                        <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center">
                            <p class="text-sm font-light text-gray-400">Belum ada diskusi di sesi ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="flex items-center justify-between flex-wrap gap-4 pt-1">
                    <p class="text-[0.72rem] font-light text-gray-400">
                        Menampilkan <span class="font-medium text-gray-600">{{ $threads->count() }}</span>
                        dari <span class="font-medium text-gray-600">{{ $threads->total() }}</span> diskusi
                    </p>
                    <div class="flex items-center gap-1">
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
                                class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 transition-colors no-underline">
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
                                'border border-gray-200 text-gray-500 hover:bg-gray-50' =>
                                    $page !== $threads->currentPage(),
                            ])>{{ $page }}</a>
                        @endforeach

                        @if ($threads->hasMorePages())
                            <a href="{{ $threads->nextPageUrl() }}"
                                class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 transition-colors no-underline">
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

            {{-- ════════════════ RIGHT — Sidebar (1/3) ════════════════ --}}
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
                                    {{ $session->tanggal->translatedFormat('l, d F Y') }}
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
                                    {{ $session->jam_mulai }} – {{ $session->jam_selesai }} WITA
                                </span>
                            </div>
                        </div>
                        @php $status = $session->status ?? 'pending'; @endphp
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

                {{-- Stats --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Statistik Forum</h2>
                    <div class="grid grid-cols-2 gap-2">
                        <div
                            class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-100 rounded-xl">
                            <p class="text-base font-light text-gray-900" data-stat="total_threads">
                                {{ $stats['total_threads'] }}</p>
                            <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">Total thread
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-100 rounded-xl">
                            <p class="text-base font-light text-gray-900" data-stat="total_replies">
                                {{ $stats['total_replies'] }}</p>
                            <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">Total balasan
                            </p>
                        </div>
                        <div
                            class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-100 rounded-xl">
                            <p class="text-base font-light {{ $stats['reported'] > 0 ? 'text-red-500' : 'text-gray-900' }}"
                                data-stat="reported">{{ $stats['reported'] }}</p>
                            <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">Dilaporkan</p>
                        </div>
                        <div
                            class="flex flex-col items-center gap-0.5 px-3 py-3 bg-gray-50 border border-gray-100 rounded-xl">
                            <p class="text-base font-light {{ $stats['unanswered'] > 0 ? 'text-orange-500' : 'text-gray-900' }}"
                                data-stat="unanswered">{{ $stats['unanswered'] }}</p>
                            <p class="text-[0.62rem] font-light text-gray-400 text-center leading-tight">Belum dijawab
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Online count --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-900">Peserta Online</h2>
                        <span class="flex items-center gap-1 text-[0.65rem] font-light text-green-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            <span data-online-count>0 online</span>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2" id="online-participants">
                        <p class="text-xs font-light text-gray-400">Memuat...</p>
                    </div>
                </div>

                {{-- Kontributor aktif --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-4">
                    <h2 class="text-sm font-medium text-gray-900">Kontributor Aktif</h2>
                    <div class="flex flex-col gap-2.5">
                        @forelse ($contributors as $contributor)
                            <div class="flex items-center gap-2.5">
                                <div @class([
                                    'w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $contributor['role'] === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' =>
                                        $contributor['role'] !== 'admin',
                                ])>{{ $contributor['initials'] }}</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-normal text-gray-700 truncate">{{ $contributor['name'] }}
                                    </p>
                                    <p class="text-[0.62rem] font-light text-gray-400">
                                        {{ $contributor['post_count'] }} post</p>
                                </div>
                                <div class="w-12 h-1 bg-gray-100 rounded-full overflow-hidden shrink-0">
                                    @php $maxPost = $contributors->max('post_count') ?: 1; @endphp
                                    <div class="h-full bg-blue-200 rounded-full"
                                        style="width: {{ min(100, ($contributor['post_count'] / $maxPost) * 100) }}%">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs font-light text-gray-400">Belum ada kontributor.</p>
                        @endforelse
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
        const SESSION_ID = {{ $session->id }};
        const CURRENT_UID = {{ auth()->id() }};
        const ALL_PARTICIPANTS = @json($allParticipants);

        let onlineUserIds = new Set();

        // ── Init Echo (tunggu sampai ready) ──────────────────────
        function initEcho() {
            if (!window.Echo) {
                setTimeout(initEcho, 100);
                return;
            }

            window.Echo.join(`session.${SESSION_ID}`)
                .here(users => {
                    onlineUserIds = new Set(users.map(u => u.id));
                    renderOnlineCount();
                    renderOnlineParticipants(users);
                })
                .joining(user => {
                    onlineUserIds.add(user.id);
                    renderOnlineCount();
                    updateParticipantBadge(user, true);
                })
                .leaving(user => {
                    onlineUserIds.delete(user.id);
                    renderOnlineCount();
                    updateParticipantBadge(user, false);
                })
                // Thread baru dari peserta
                .listen('.thread.posted', e => {
                    prependThread(e.thread);
                    bumpStat('total_threads');
                    bumpStat('unanswered');
                })
                // Reply baru
                .listen('.reply.posted', e => {
                    incrementReplyBadge(e.reply.thread_id);
                    bumpStat('total_replies');
                })
                // Thread dihapus (dari tab lain / peserta)
                .listen('.thread.deleted', e => {
                    removeThreadCard(e.thread_id);
                    bumpStat('total_threads', -1);
                });
        }
        initEcho();

        // ── Form post AJAX ────────────────────────────────────────
        document.getElementById('admin-post-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('post-btn');
            const form = e.target;

            btn.disabled = true;
            btn.textContent = 'Memposting...';

            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: new URLSearchParams(new FormData(form)),
            });

            if (res.ok) {
                form.reset();
                // Thread milik sendiri (admin) langsung prepend tanpa nunggu broadcast
                const data = await res.json();
                showToast('Thread berhasil diposting.');
            } else {
                showToast('Gagal memposting thread.', true);
            }

            btn.disabled = false;
            btn.innerHTML =
                `<svg width="12" height="12" viewBox="0 0 14 14" fill="none"><path d="M2 7h8M7 4l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg> Posting`;
        });

        // ── Pin toggle AJAX ───────────────────────────────────────
        async function togglePin(threadId, btn) {
            const res = await fetch(`/admin/attendance/${SESSION_ID}/discussions/${threadId}/pin`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });

            if (!res.ok) return;
            const data = await res.json();

            // Update tampilan tombol pin
            const isPinned = data.is_pinned;
            btn.classList.toggle('text-blue-700', isPinned);
            btn.classList.toggle('bg-blue-50', isPinned);
            btn.classList.toggle('border-blue-200', isPinned);
            btn.classList.toggle('text-gray-400', !isPinned);
            btn.classList.toggle('bg-white', !isPinned);
            btn.classList.toggle('border-gray-200', !isPinned);
            btn.title = isPinned ? 'Lepas sematkan' : 'Sematkan';

            // Update accent bar & badge di kartu
            const card = btn.closest('[data-thread-id]');
            if (card) {
                const accent = card.querySelector('[data-accent]');
                if (accent) {
                    accent.classList.toggle('bg-blue-900', isPinned);
                    accent.classList.toggle('bg-gray-100', !isPinned);
                }
                const pinnedBadge = card.querySelector('[data-pinned-badge]');
                if (pinnedBadge) pinnedBadge.classList.toggle('hidden', !isPinned);
            }
        }

        // ── Delete thread AJAX ────────────────────────────────────
        async function deleteThread(threadId, btn) {
            if (!confirm('Hapus thread ini? Tindakan tidak bisa dibatalkan.')) return;
            btn.disabled = true;

            const res = await fetch(`/admin/attendance/${SESSION_ID}/discussions/${threadId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });

            if (res.ok) {
                removeThreadCard(threadId);
                bumpStat('total_threads', -1);
            } else {
                btn.disabled = false;
                showToast('Gagal menghapus thread.', true);
            }
        }

        // ── Helpers ───────────────────────────────────────────────
        function removeThreadCard(threadId) {
            const card = document.querySelector(`[data-thread-id="${threadId}"]`);
            if (!card) return;
            card.style.transition = 'opacity 0.3s, transform 0.3s';
            card.style.opacity = '0';
            card.style.transform = 'translateX(8px)';
            setTimeout(() => card.remove(), 300);
        }

        function prependThread(thread) {
            const list = document.getElementById('thread-list');
            if (!list) return;

            const isAdmin = thread.user.role === 'admin';
            const accentCls = isAdmin ? 'bg-blue-900' : 'bg-gray-100';
            const avatarCls = isAdmin ? 'bg-blue-900 text-white' : 'bg-blue-50 border border-blue-100 text-blue-900';

            const el = document.createElement('div');
            el.className =
                'bg-white border border-blue-200 hover:border-gray-300 rounded-2xl overflow-hidden transition-all duration-200 realtime-new';
            el.setAttribute('data-thread-id', thread.id);
            el.innerHTML = `
                <div class="flex">
                    <div class="w-[3px] shrink-0 ${accentCls}" data-accent></div>
                    <div class="flex-1 px-5 py-4 flex flex-col gap-2.5 min-w-0">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="inline-flex items-center gap-1 text-[0.62rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5">Baru</span>
                            ${isAdmin ? '<span class="text-[0.62rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Dosen / Admin</span>' : ''}
                        </div>
                        <a href="/admin/attendance/${SESSION_ID}/discussions/${thread.id}" class="text-sm font-medium text-gray-900 leading-snug hover:text-blue-900 no-underline">${thread.title}</a>
                        <p class="text-xs font-light text-gray-500 leading-relaxed line-clamp-2">${thread.body}</p>
                        <div class="flex items-center justify-between gap-3 pt-0.5 flex-wrap">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-md flex items-center justify-center text-[0.5rem] font-semibold shrink-0 ${avatarCls}">${thread.user.initials}</div>
                                <span class="text-[0.7rem] font-light text-gray-600">${thread.user.name}</span>
                                <span class="text-gray-200">·</span>
                                <span class="text-[0.7rem] font-light text-gray-400">${thread.created_at}</span>
                                <span class="text-gray-200">·</span>
                                <span class="text-[0.7rem] font-light text-gray-400" id="reply-count-${thread.id}">0 balasan</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <button onclick="togglePin(${thread.id}, this)" title="Sematkan"
                                    class="flex items-center justify-center w-7 h-7 border border-gray-200 bg-white text-gray-400 rounded-lg hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700 transition-colors">
                                    <svg width="11" height="11" viewBox="0 0 12 16" fill="none"><path d="M6 1v8M3 9h6M6 9v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                                </button>
                                <button onclick="deleteThread(${thread.id}, this)" title="Hapus thread"
                                    class="flex items-center justify-center w-7 h-7 border border-gray-200 bg-white text-gray-400 rounded-lg hover:bg-red-50 hover:border-red-200 hover:text-red-500 transition-colors">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none"><path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                                <a href="/admin/attendance/${SESSION_ID}/discussions/${thread.id}"
                                    class="flex items-center gap-1 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-lg transition-colors no-underline">
                                    Buka
                                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;

            list.prepend(el);
            showToast(`Thread baru: "${thread.title.substring(0, 40)}..."`);
            setTimeout(() => el.classList.remove('border-blue-200'), 5000);
        }

        function incrementReplyBadge(threadId) {
            const el = document.getElementById(`reply-count-${threadId}`);
            if (!el) return;
            const n = parseInt(el.textContent) || 0;
            el.textContent = (n + 1) + ' balasan';
            el.classList.add('text-blue-700');
            setTimeout(() => el.classList.remove('text-blue-700'), 2000);
        }

        function bumpStat(key, delta = 1) {
            const el = document.querySelector(`[data-stat="${key}"]`);
            if (!el) return;
            el.textContent = Math.max(0, parseInt(el.textContent || '0') + delta);
        }

        function renderOnlineCount() {
            document.querySelectorAll('[data-online-count]').forEach(el => {
                el.textContent = onlineUserIds.size + ' online';
            });
        }

        function renderOnlineParticipants(users) {
            const container = document.getElementById('online-participants');
            if (!container) return;
            if (!users.length) {
                container.innerHTML = '<p class="text-xs font-light text-gray-400">Tidak ada peserta online.</p>';
                return;
            }
            container.innerHTML = users.map(u => {
                const isAdmin = u.role === 'admin';
                const avatarCls = isAdmin ? 'bg-blue-900 text-white' :
                    'bg-blue-50 border border-blue-100 text-blue-900';
                return `
                    <div class="flex items-center gap-2.5">
                        <div class="relative shrink-0">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-medium ${avatarCls}">${u.initials}</div>
                            <span class="absolute -bottom-0.5 -right-0.5 w-2 h-2 rounded-full bg-green-500 border border-white"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-normal text-gray-700 truncate">${u.name}</p>
                            <p class="text-[0.62rem] font-light text-green-500">Online</p>
                        </div>
                    </div>`;
            }).join('');
        }

        function updateParticipantBadge(user, isOnline) {
            // Re-render sederhana: cukup update count saja
            // Full re-render bisa dilakukan jika diperlukan
            renderOnlineCount();
        }

        function showToast(msg, isError = false) {
            const existing = document.getElementById('rt-toast');
            if (existing) existing.remove();
            const toast = document.createElement('div');
            toast.id = 'rt-toast';
            toast.className =
                `fixed bottom-5 right-5 z-50 flex items-center gap-2.5 px-4 py-3 bg-white border ${isError ? 'border-red-200' : 'border-gray-200'} rounded-2xl shadow-sm text-xs font-light text-gray-700`;
            toast.innerHTML =
                `<span class="w-2 h-2 rounded-full ${isError ? 'bg-red-400' : 'bg-blue-500 animate-pulse'} shrink-0"></span>${msg}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        }
    </script>

</x-layout-main>
