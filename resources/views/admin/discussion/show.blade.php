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
                <a href="{{ route('admin.attendance.detail', $session->id) }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Detail
                    Sesi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('admin.attendance.discussions.index', $session->id) }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Diskusi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-xs font-light text-gray-500">Detail Thread</span>
            </nav>

            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-light tracking-tight text-gray-900 leading-snug" id="thread-title">
                        {{ $thread->title }}
                    </h1>
                    <p class="text-sm font-light text-gray-400 mt-1">{{ $session->nama_sesi }}</p>
                </div>
                <a href="{{ route('admin.attendance.discussions.index', $session->id) }}"
                    class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-xl transition-colors no-underline shrink-0">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                        <path d="M8 3L4 6l4 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>
        </section>

        {{-- Flash --}}
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ════ LEFT — Thread + Replies (2/3) ════ --}}
            <div class="lg:col-span-2 flex flex-col gap-4">

                {{-- ── ORIGINAL POST ── --}}
                @php
                    $hasReportedReply = $thread->replies->contains('is_reported', true);
                @endphp
                <div id="thread-card"
                    class="bg-white border {{ $hasReportedReply ? 'border-red-200' : 'border-gray-200' }} rounded-2xl overflow-hidden">
                    <div id="thread-accent" class="h-[3px] {{ $thread->is_pinned ? 'bg-blue-900' : 'bg-gray-200' }}">
                    </div>
                    <div class="p-6 flex flex-col gap-4">

                        {{-- Author + badges --}}
                        <div class="flex items-start justify-between gap-3 flex-wrap">
                            <div class="flex items-center gap-2.5">
                                <div @class([
                                    'w-9 h-9 rounded-xl flex items-center justify-center text-[0.65rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $thread->user->role === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' =>
                                        $thread->user->role !== 'admin',
                                ])>
                                    {{ strtoupper(substr($thread->user->first_name, 0, 1) . substr($thread->user->last_name ?? '', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <p class="text-sm font-normal text-gray-800">{{ $thread->user->first_name }}
                                            {{ $thread->user->last_name }}</p>
                                        @if ($thread->user->role === 'admin')
                                            <span
                                                class="text-[0.6rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Admin</span>
                                        @endif
                                    </div>
                                    <p class="text-[0.65rem] font-light text-gray-400">
                                        {{ $thread->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 flex-wrap" id="thread-badges">
                                @if ($thread->is_pinned)
                                    <span id="badge-pinned"
                                        class="inline-flex items-center gap-1 text-[0.65rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-1">Disematkan</span>
                                @else
                                    <span id="badge-pinned"
                                        class="hidden inline-flex items-center gap-1 text-[0.65rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-1">Disematkan</span>
                                @endif
                                @if ($thread->is_answered)
                                    <span id="badge-answered"
                                        class="inline-flex items-center gap-1 text-[0.65rem] font-normal text-green-700 bg-green-50 border border-green-200 rounded-full px-2.5 py-1">
                                        <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                            <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.3"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Terjawab
                                    </span>
                                @else
                                    <span id="badge-answered"
                                        class="hidden inline-flex items-center gap-1 text-[0.65rem] font-normal text-green-700 bg-green-50 border border-green-200 rounded-full px-2.5 py-1">
                                        <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                            <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.3"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Terjawab
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="border-t border-gray-100"></div>
                        <div class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $thread->body }}</div>

                        {{-- Action bar --}}
                        <div class="flex items-center gap-2 pt-1 border-t border-gray-100 flex-wrap">
                            <button id="btn-pin" onclick="togglePin()" @class([
                                'flex items-center gap-1.5 px-3 py-1.5 border rounded-lg text-xs font-light transition-colors',
                                'text-blue-700 bg-blue-50 border-blue-200' => $thread->is_pinned,
                                'text-gray-500 bg-white border-gray-200 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700' => !$thread->is_pinned,
                            ])>
                                <svg width="11" height="11" viewBox="0 0 12 16" fill="none">
                                    <path d="M6 1v8M3 9h6M6 9v6" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" />
                                </svg>
                                <span
                                    id="btn-pin-label">{{ $thread->is_pinned ? 'Lepas Sematkan' : 'Sematkan' }}</span>
                            </button>

                            <button id="btn-answered" onclick="toggleAnswered()" @class([
                                'flex items-center gap-1.5 px-3 py-1.5 border rounded-lg text-xs font-light transition-colors',
                                'text-green-700 bg-green-50 border-green-200' => $thread->is_answered,
                                'text-gray-500 bg-white border-gray-200 hover:bg-green-50 hover:border-green-200 hover:text-green-700' => !$thread->is_answered,
                            ])>
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                    <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span
                                    id="btn-answered-label">{{ $thread->is_answered ? 'Batalkan Terjawab' : 'Tandai Terjawab' }}</span>
                            </button>

                            <button onclick="deleteThread()"
                                class="ml-auto flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-xs font-light text-gray-500 rounded-lg transition-colors">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                    <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor"
                                        stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Hapus Thread
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ── REPLIES ── --}}
                <div class="flex flex-col gap-1">
                    <p class="text-xs font-normal text-gray-500 px-1 mb-2">
                        <span id="reply-count-label">{{ $thread->replies->count() }}</span> Balasan
                    </p>

                    <div id="replies-container" class="flex flex-col gap-1">
                        @foreach ($thread->replies as $reply)
                            @include('admin.discussion._reply-card', [
                                'reply' => $reply,
                                'thread' => $thread,
                                'session' => $session,
                                'loop' => $loop,
                            ])
                        @endforeach
                    </div>
                </div>

                {{-- ── REPLY FORM (Admin) ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden" id="reply-form-card">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-2.5">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-semibold text-white shrink-0">
                                {{ strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name ?? '', 0, 1)) }}
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span
                                    class="text-xs font-normal text-gray-700">{{ auth()->user()->first_name }}</span>
                                <span
                                    class="text-[0.6rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Dosen
                                    / Admin</span>
                            </div>
                        </div>

                        <form id="reply-form" class="flex flex-col gap-3">
                            @csrf
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

                            <div class="flex items-center gap-4 px-1">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="mark_as_answer" value="1" id="mark-as-answer"
                                        class="w-3.5 h-3.5 rounded border-gray-300 text-blue-900 focus:ring-blue-200">
                                    <span class="text-xs font-light text-gray-600">Tandai sebagai jawaban</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-between gap-3">
                                <p class="text-[0.68rem] font-light text-gray-400">Balasan admin akan ditampilkan
                                    dengan label khusus</p>
                                <button type="submit" id="reply-submit-btn"
                                    class="flex items-center gap-2 px-5 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px shrink-0 disabled:opacity-60 disabled:cursor-not-allowed">
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

            {{-- ════ RIGHT — Sidebar (1/3) ════ --}}
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
                                        class="text-gray-700 font-normal">{{ $thread->user->first_name }}
                                        {{ $thread->user->last_name }}</span></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" />
                                </svg>
                                <span
                                    class="text-xs font-light text-gray-500">{{ $thread->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <path d="M11 7a2 2 0 0 1-2 2H3l-2 2V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z"
                                        stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500"
                                    id="sidebar-reply-count">{{ $thread->replies->count() }} balasan</span>
                            </div>
                        </div>

                        <div id="sidebar-status-answered">
                            @if ($thread->is_answered)
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
                        </div>
                    </div>
                </div>

                {{-- Moderasi tools --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Moderasi</h2>
                    <div class="flex flex-col gap-2">
                        <button id="sidebar-btn-pin" onclick="togglePin()" @class([
                            'w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-xl text-xs font-light transition-colors',
                            'bg-blue-50 border-blue-200 text-blue-700' => $thread->is_pinned,
                            'bg-white border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700' => !$thread->is_pinned,
                        ])>
                            <svg width="12" height="12" viewBox="0 0 12 16" fill="none">
                                <path d="M6 1v8M3 9h6M6 9v6" stroke="currentColor" stroke-width="1.4"
                                    stroke-linecap="round" />
                            </svg>
                            <span
                                id="sidebar-btn-pin-label">{{ $thread->is_pinned ? 'Lepas Sematkan Thread' : 'Sematkan Thread' }}</span>
                        </button>

                        <button id="sidebar-btn-answered" onclick="toggleAnswered()" @class([
                            'w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-xl text-xs font-light transition-colors',
                            'bg-green-50 border-green-200 text-green-700' => $thread->is_answered,
                            'bg-white border-gray-200 text-gray-600 hover:bg-green-50 hover:border-green-200 hover:text-green-700' => !$thread->is_answered,
                        ])>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span
                                id="sidebar-btn-answered-label">{{ $thread->is_answered ? 'Batalkan Status Terjawab' : 'Tandai Thread Terjawab' }}</span>
                        </button>

                        <div class="border-t border-gray-100 my-1"></div>

                        <button onclick="deleteThread()"
                            class="w-full flex items-center gap-2.5 px-3 py-2.5 border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-xs font-light text-gray-500 rounded-xl transition-colors">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor"
                                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Hapus Thread
                        </button>
                    </div>
                </div>

                {{-- Partisipan --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-4">
                    <h2 class="text-sm font-medium text-gray-900">Partisipan</h2>
                    <div class="flex flex-col gap-2.5">
                        @php
                            $participantsSeen = collect();
                            $participantsSeen->push($thread->user);
                            foreach ($thread->replies as $r) {
                                if (!$participantsSeen->contains('id', $r->user->id)) {
                                    $participantsSeen->push($r->user);
                                }
                            }
                        @endphp
                        @foreach ($participantsSeen as $i => $p)
                            <div class="flex items-center gap-2.5">
                                <div @class([
                                    'w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $p->role === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' => $p->role !== 'admin',
                                ])>
                                    {{ strtoupper(substr($p->first_name, 0, 1) . substr($p->last_name ?? '', 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-normal text-gray-700 truncate">{{ $p->first_name }}
                                        {{ $p->last_name }}</p>
                                    <p class="text-[0.62rem] font-light text-gray-400">
                                        @if ($i === 0)
                                            Pembuat thread
                                        @elseif ($p->role === 'admin')
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
                        @forelse ($otherThreads as $ot)
                            @php $otReported = $ot->replies()->where('is_reported', true)->exists(); @endphp
                            <a href="{{ route('admin.attendance.discussions.show', ['id' => $session->id, 'thread' => $ot->id]) }}"
                                class="flex items-start gap-2.5 px-3 py-2.5 bg-gray-50 border {{ $otReported ? 'border-red-100' : 'border-gray-100' }} hover:border-gray-200 rounded-xl transition-colors no-underline group">
                                <div @class([
                                    'w-1.5 h-1.5 rounded-full mt-1.5 shrink-0',
                                    'bg-green-400' => $ot->is_answered,
                                    'bg-red-400' => $otReported,
                                    'bg-orange-300' => !$ot->is_answered && !$otReported,
                                ])></div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-xs font-normal text-gray-700 group-hover:text-blue-900 transition-colors line-clamp-2 leading-snug">
                                        {{ $ot->title }}</p>
                                    <p class="text-[0.62rem] font-light text-gray-400 mt-0.5">{{ $ot->replies_count }}
                                        balasan</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs font-light text-gray-400">Tidak ada thread lain.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('admin.attendance.discussions.index', $session->id) }}"
                        class="text-[0.7rem] font-light text-blue-700 hover:text-blue-900 transition-colors no-underline text-center">
                        Lihat semua diskusi →
                    </a>
                </div>

            </div>
        </div>

        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">&copy; {{ date('Y') }} TipsenKuy ·
                Built with Laravel &amp; Tailwind CSS</p>
        </footer>

    </main>

    <script>
        const SESSION_ID = {{ $session->id }};
        const THREAD_ID = {{ $thread->id }};
        const CURRENT_UID = {{ auth()->id() }};
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        // ── Init Echo ─────────────────────────────────────────────
        function initEcho() {
            if (!window.Echo) {
                setTimeout(initEcho, 100);
                return;
            }

            // Presence channel sesi (untuk tau ada user lain)
            window.Echo.join(`session.${SESSION_ID}`)
                // Thread-level events (pin, answered, delete dari index)
                .listen('.thread.deleted', e => {
                    if (e.thread_id == THREAD_ID) {
                        showToast('Thread ini telah dihapus.', true);
                        setTimeout(() => {
                            window.location.href = `/admin/attendance/${SESSION_ID}/discussions`;
                        }, 1500);
                    }
                });

            // Thread channel (reply events)
            window.Echo.join(`thread.${THREAD_ID}`)
                .listen('.reply.posted', e => {
                    const r = e.reply;
                    if (r.user.id !== CURRENT_UID) {
                        appendReply(r);
                        incrementReplyCount();
                        showToast(`Balasan baru dari ${r.user.name}`);
                    }
                })
                .listen('.reply.deleted', e => {
                    removeReplyCard(e.reply_id);
                    decrementReplyCount();
                });
        }
        initEcho();

        // ── Toggle Pin ────────────────────────────────────────────
        async function togglePin() {
            const res = await apiFetch(`/admin/attendance/${SESSION_ID}/discussions/${THREAD_ID}/pin`, 'PATCH');
            if (!res) return;
            const {
                is_pinned
            } = res;

            // Accent bar
            document.getElementById('thread-accent').className = `h-[3px] ${is_pinned ? 'bg-blue-900' : 'bg-gray-200'}`;
            // Badge
            document.getElementById('badge-pinned').classList.toggle('hidden', !is_pinned);
            // Btn inline
            setPinBtn(is_pinned);
            // Sidebar btn
            setSidebarPinBtn(is_pinned);

            showToast(is_pinned ? 'Thread disematkan.' : 'Pin dilepas.');
        }

        function setPinBtn(isPinned) {
            const btn = document.getElementById('btn-pin');
            btn.className =
                `flex items-center gap-1.5 px-3 py-1.5 border rounded-lg text-xs font-light transition-colors ${isPinned ? 'text-blue-700 bg-blue-50 border-blue-200' : 'text-gray-500 bg-white border-gray-200 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700'}`;
            document.getElementById('btn-pin-label').textContent = isPinned ? 'Lepas Sematkan' : 'Sematkan';
        }

        function setSidebarPinBtn(isPinned) {
            const btn = document.getElementById('sidebar-btn-pin');
            btn.className =
                `w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-xl text-xs font-light transition-colors ${isPinned ? 'bg-blue-50 border-blue-200 text-blue-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700'}`;
            document.getElementById('sidebar-btn-pin-label').textContent = isPinned ? 'Lepas Sematkan Thread' :
                'Sematkan Thread';
        }

        // ── Toggle Answered ───────────────────────────────────────
        async function toggleAnswered() {
            const res = await apiFetch(`/admin/attendance/${SESSION_ID}/discussions/${THREAD_ID}/answered`, 'PATCH');
            if (!res) return;
            updateAnsweredUI(res.is_answered);
            showToast(res.is_answered ? 'Thread ditandai terjawab.' : 'Status terjawab dibatalkan.');
        }

        function updateAnsweredUI(isAnswered) {
            // Badge
            document.getElementById('badge-answered').classList.toggle('hidden', !isAnswered);
            // Btn inline
            const btn = document.getElementById('btn-answered');
            btn.className =
                `flex items-center gap-1.5 px-3 py-1.5 border rounded-lg text-xs font-light transition-colors ${isAnswered ? 'text-green-700 bg-green-50 border-green-200' : 'text-gray-500 bg-white border-gray-200 hover:bg-green-50 hover:border-green-200 hover:text-green-700'}`;
            document.getElementById('btn-answered-label').textContent = isAnswered ? 'Batalkan Terjawab' :
            'Tandai Terjawab';
            // Sidebar btn
            const sbtn = document.getElementById('sidebar-btn-answered');
            sbtn.className =
                `w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-xl text-xs font-light transition-colors ${isAnswered ? 'bg-green-50 border-green-200 text-green-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-green-50 hover:border-green-200 hover:text-green-700'}`;
            document.getElementById('sidebar-btn-answered-label').textContent = isAnswered ? 'Batalkan Status Terjawab' :
                'Tandai Thread Terjawab';
            // Sidebar status
            document.getElementById('sidebar-status-answered').innerHTML = isAnswered ?
                `<div class="flex items-center gap-2 px-3 py-2 bg-green-50 border border-green-200 rounded-xl"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="text-green-600 shrink-0"><path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" /></svg><span class="text-[0.7rem] font-light text-green-700">Thread sudah terjawab</span></div>` :
                `<div class="flex items-center gap-2 px-3 py-2 bg-orange-50 border border-orange-200 rounded-xl"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="text-orange-500 shrink-0"><circle cx="6" cy="6" r="4.5" stroke="currentColor" stroke-width="1.2" /><path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" /></svg><span class="text-[0.7rem] font-light text-orange-600">Menunggu jawaban</span></div>`;
        }

        // ── Delete Thread ─────────────────────────────────────────
        async function deleteThread() {
            if (!confirm('Hapus thread ini beserta semua balasannya?')) return;
            const res = await apiFetch(`/admin/attendance/${SESSION_ID}/discussions/${THREAD_ID}`, 'DELETE');
            if (!res) return;
            showToast('Thread dihapus. Mengalihkan...');
            setTimeout(() => {
                window.location.href = `/admin/attendance/${SESSION_ID}/discussions`;
            }, 1000);
        }

        // ── Reply Form Submit ─────────────────────────────────────
        document.getElementById('reply-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('reply-submit-btn');
            const body = document.getElementById('reply-textarea').value.trim();
            if (!body) return;

            btn.disabled = true;
            btn.textContent = 'Mengirim...';

            const formData = new URLSearchParams();
            formData.append('body', body);
            formData.append('mark_as_answer', document.getElementById('mark-as-answer').checked ? '1' : '0');
            const qid = document.getElementById('quote-reply-id').value;
            if (qid) formData.append('quote_reply_id', qid);

            const res = await apiFetch(`/admin/attendance/${SESSION_ID}/discussions/${THREAD_ID}/replies`,
                'POST', formData);

            if (res) {
                appendReply(res.reply);
                incrementReplyCount();
                this.reset();
                clearQuote();
                if (res.reply.is_answer) updateAnsweredUI(true);
                showToast('Balasan terkirim.');
            }

            btn.disabled = false;
            btn.innerHTML =
                `<svg width="12" height="12" viewBox="0 0 14 14" fill="none"><path d="M2 7h8M7 4l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg> Kirim Balasan`;
        });

        // ── Toggle Mark Answer ────────────────────────────────────
        async function toggleMarkAnswer(replyId, btn) {
            const res = await apiFetch(
                `/admin/attendance/${SESSION_ID}/discussions/${THREAD_ID}/replies/${replyId}/answer`, 'PATCH');
            if (!res) return;

            const card = document.getElementById(`reply-${replyId}`);
            if (card) updateReplyAnswerUI(card, res.is_answer);
            updateAnsweredUI(res.is_answered);

            btn.className =
                `flex items-center gap-1.5 px-2.5 py-1 border rounded-lg text-[0.7rem] font-light transition-colors ${res.is_answer ? 'text-green-700 bg-green-50 border-green-200' : 'text-gray-500 bg-white border-gray-200 hover:bg-green-50 hover:border-green-200 hover:text-green-700'}`;
            btn.querySelector('span').textContent = res.is_answer ? 'Batalkan Jawaban' : 'Jadikan Jawaban';

            showToast(res.is_answer ? 'Dijadikan jawaban.' : 'Jawaban dibatalkan.');
        }

        function updateReplyAnswerUI(card, isAnswer) {
            card.className = card.className
                .replace(/border-green-200|border-red-200|border-gray-200/g, '')
                .replace(/bg-green-50\/40|bg-red-50\/30|bg-white/g, '');
            if (isAnswer) {
                card.classList.add('border-green-200', 'bg-green-50/40');
            } else {
                card.classList.add('border-gray-200', 'bg-white');
            }
            const badge = card.querySelector('[data-answer-badge]');
            if (badge) badge.classList.toggle('hidden', !isAnswer);
            const accentBar = card.querySelector('[data-reply-accent]');
            if (accentBar) {
                accentBar.className = `h-[2px] ${isAnswer ? 'bg-green-500' : 'hidden'}`;
            }
        }

        // ── Dismiss Report ────────────────────────────────────────
        async function dismissReport(replyId, btn) {
            const res = await apiFetch(
                `/admin/attendance/${SESSION_ID}/discussions/${THREAD_ID}/replies/${replyId}/dismiss-report`,
                'PATCH');
            if (!res) return;

            const card = document.getElementById(`reply-${replyId}`);
            if (card) {
                card.classList.remove('border-red-200', 'bg-red-50/30');
                card.classList.add('border-gray-200', 'bg-white');
                const reportBadge = card.querySelector('[data-report-badge]');
                if (reportBadge) reportBadge.remove();
                const accentBar = card.querySelector('[data-reply-accent]');
                if (accentBar) accentBar.className = 'h-[2px] hidden';
                btn.closest('form')?.remove() || btn.remove();
            }
            showToast('Laporan diabaikan.');
        }

        // ── Delete Reply ──────────────────────────────────────────
        async function deleteReply(replyId, btn) {
            if (!confirm('Hapus balasan ini?')) return;
            btn.disabled = true;
            const res = await apiFetch(`/admin/attendance/${SESSION_ID}/discussions/${THREAD_ID}/replies/${replyId}`,
                'DELETE');
            if (res) {
                removeReplyCard(replyId);
                decrementReplyCount();
                showToast('Balasan dihapus.');
            } else {
                btn.disabled = false;
            }
        }

        // ── Quote Reply ───────────────────────────────────────────
        function quoteReply(replyId, author, body) {
            document.getElementById('quote-preview').classList.remove('hidden');
            document.getElementById('quote-author').textContent = author;
            document.getElementById('quote-body').textContent = body;
            document.getElementById('quote-reply-id').value = replyId;
            document.getElementById('reply-textarea').focus();
            document.getElementById('reply-form-card').scrollIntoView({
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

        // ── Append Reply (realtime / own) ─────────────────────────
        function appendReply(r) {
            const container = document.getElementById('replies-container');
            const isAdmin = r.user.role === 'admin';
            const avatarCls = isAdmin ? 'bg-blue-900 text-white' : 'bg-blue-50 border border-blue-100 text-blue-900';
            const cardCls = r.is_answer ?
                'border-green-200 bg-green-50/40' :
                (r.is_reported ? 'border-red-200 bg-red-50/30' : 'border-gray-200 bg-white');
            const accentColor = r.is_reported ? 'bg-red-400' : (r.is_answer ? 'bg-green-500' : 'hidden');

            const quotedHtml = r.quoted_reply ?
                `<div class="px-3 py-2 bg-gray-50 border-l-2 border-blue-200 rounded-r-lg mb-1">
                    <p class="text-[0.65rem] font-normal text-blue-600 mb-0.5">${r.quoted_reply.author}</p>
                    <p class="text-xs font-light text-gray-500 line-clamp-2">${r.quoted_reply.body}</p>
                   </div>` : '';

            const el = document.createElement('div');
            el.className = 'flex gap-3 group';
            el.id = `reply-wrapper-${r.id}`;
            el.innerHTML = `
                <div class="flex flex-col items-center pt-1 shrink-0">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-[0.65rem] font-semibold shrink-0 ${avatarCls}">${r.user.initials}</div>
                </div>
                <div id="reply-${r.id}" class="flex-1 mb-3 rounded-2xl overflow-hidden border transition-all duration-200 ${cardCls}">
                    <div class="h-[2px] ${accentColor}" data-reply-accent></div>
                    <div class="p-4 flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-2 flex-wrap">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-normal text-gray-800">${r.user.name}</p>
                                ${isAdmin ? '<span class="text-[0.6rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Admin</span>' : ''}
                                <span data-answer-badge class="${r.is_answer ? '' : 'hidden'} inline-flex items-center gap-1 text-[0.6rem] font-normal text-green-700 bg-green-100 border border-green-200 rounded-full px-2 py-0.5">
                                    <svg width="8" height="8" viewBox="0 0 10 10" fill="none"><path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                    Jawaban terpilih
                                </span>
                                ${r.is_reported ? '<span data-report-badge class="inline-flex items-center gap-1 text-[0.6rem] font-normal text-red-600 bg-red-50 border border-red-200 rounded-full px-2 py-0.5">Dilaporkan</span>' : ''}
                            </div>
                            <span class="text-[0.65rem] font-light text-gray-400">${r.created_at}</span>
                        </div>
                        ${quotedHtml}
                        <p class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">${r.body}</p>
                        <div class="flex items-center gap-2 pt-1 border-t border-gray-100 flex-wrap">
                            <div class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400">
                                <svg width="12" height="12" viewBox="0 0 14 14" fill="none"><path d="M2 7.5C2 6.7 2.7 6 3.5 6H5V3.5C5 2.7 5.7 2 6.5 2S8 2.7 8 3.5V6h1.5C10.3 6 11 6.7 11 7.5v3c0 .8-.7 1.5-1.5 1.5h-6C2.7 12 2 11.3 2 10.5v-3z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" /></svg>
                                <span id="likes-${r.id}">${r.likes}</span> suka
                            </div>
                            <button onclick="toggleMarkAnswer(${r.id}, this)"
                                class="flex items-center gap-1.5 px-2.5 py-1 border rounded-lg text-[0.7rem] font-light transition-colors ${r.is_answer ? 'text-green-700 bg-green-50 border-green-200' : 'text-gray-500 bg-white border-gray-200 hover:bg-green-50 hover:border-green-200 hover:text-green-700'}">
                                <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <span>${r.is_answer ? 'Batalkan Jawaban' : 'Jadikan Jawaban'}</span>
                            </button>
                            <button onclick="quoteReply(${r.id}, '${r.user.name.replace(/'/g, "\\'")}', '${r.body.substring(0,80).replace(/'/g, "\\'").replace(/\n/g, ' ')}')"
                                class="flex items-center gap-1.5 px-2.5 py-1 border border-gray-200 bg-white hover:bg-gray-50 text-[0.7rem] font-light text-gray-500 rounded-lg transition-colors">
                                <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M11 7a2 2 0 0 1-2 2H3l-2 2V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" /></svg>
                                Kutip
                            </button>
                            ${r.is_reported ? `<button onclick="dismissReport(${r.id}, this)" class="flex items-center gap-1.5 px-2.5 py-1 border border-orange-200 bg-orange-50 text-orange-600 hover:bg-orange-100 rounded-lg text-[0.7rem] font-light transition-colors"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 2l8 8M10 2l-8 8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" /></svg>Abaikan Laporan</button>` : ''}
                            <button onclick="deleteReply(${r.id}, this)" class="ml-auto flex items-center gap-1.5 px-2.5 py-1 border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-[0.7rem] font-light text-gray-500 rounded-lg transition-colors">
                                <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>`;

            container.appendChild(el);
        }

        function removeReplyCard(replyId) {
            const el = document.getElementById(`reply-wrapper-${replyId}`) || document.getElementById(`reply-${replyId}`)
                ?.closest('.flex.gap-3');
            if (!el) return;
            el.style.transition = 'opacity 0.3s, transform 0.3s';
            el.style.opacity = '0';
            el.style.transform = 'translateX(8px)';
            setTimeout(() => el.remove(), 300);
        }

        function incrementReplyCount() {
            const lbl = document.getElementById('reply-count-label');
            const sb = document.getElementById('sidebar-reply-count');
            if (lbl) lbl.textContent = parseInt(lbl.textContent || 0) + 1;
            if (sb) sb.textContent = (parseInt(sb.textContent) + 1) + ' balasan';
        }

        function decrementReplyCount() {
            const lbl = document.getElementById('reply-count-label');
            const sb = document.getElementById('sidebar-reply-count');
            if (lbl) lbl.textContent = Math.max(0, parseInt(lbl.textContent || 0) - 1);
            if (sb) sb.textContent = Math.max(0, parseInt(sb.textContent) - 1) + ' balasan';
        }

        // ── Shared API fetch helper ───────────────────────────────
        async function apiFetch(url, method, body = null) {
            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        ...(body ? {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        } : {}),
                    },
                    ...(body ? {
                        body
                    } : {}),
                });
                if (!res.ok) {
                    showToast('Terjadi kesalahan.', true);
                    return null;
                }
                return await res.json();
            } catch (err) {
                console.error(err);
                showToast('Terjadi kesalahan.', true);
                return null;
            }
        }

        // ── Toast ─────────────────────────────────────────────────
        function showToast(msg, isError = false) {
            const existing = document.getElementById('rt-toast');
            if (existing) existing.remove();
            const t = document.createElement('div');
            t.id = 'rt-toast';
            t.className =
                `fixed bottom-5 right-5 z-50 flex items-center gap-2.5 px-4 py-3 bg-white border ${isError ? 'border-red-200' : 'border-gray-200'} rounded-2xl shadow-sm text-xs font-light text-gray-700`;
            t.innerHTML =
                `<span class="w-2 h-2 rounded-full ${isError ? 'bg-red-400' : 'bg-blue-500 animate-pulse'} shrink-0"></span>${msg}`;
            document.body.appendChild(t);
            setTimeout(() => t.remove(), 4000);
        }

        // ── Flash auto-hide ───────────────────────────────────────
        const flash = document.getElementById('flash-success');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = 'opacity 0.4s';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 400);
            }, 3000);
        }
    </script>

</x-layout-main>
