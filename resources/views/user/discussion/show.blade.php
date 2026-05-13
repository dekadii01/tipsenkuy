<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Detail Diskusi">

    <x-navbar-auth-user />

    <main class="max-w-5xl mx-auto px-6 py-10 flex flex-col gap-6">

        {{-- ── BREADCRUMB & HEADER ── --}}
        <section class="flex flex-col gap-2">
            <nav class="flex items-center gap-1.5 flex-wrap">
                <a href="{{ route('dashboard-user') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Dashboard</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('my-sessions') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Sesi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('session.detail', $session->id) }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">Detail
                    Sesi</a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('session.discussion.index', $session->id) }}"
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
                        {{ $thread->title }}
                    </h1>
                </div>
                <a href="{{ route('session.discussion.index', $session->id) }}"
                    class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-xl transition-colors no-underline shrink-0">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                        <path d="M8 3L4 6l4 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>
        </section>

        {{-- ── MAIN GRID ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ════════════════════════════════
                 LEFT — Thread + Replies (2/3)
            ════════════════════════════════ --}}
            <div class="lg:col-span-2 flex flex-col gap-4">

                {{-- ── ORIGINAL POST ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-6 flex flex-col gap-4">

                        {{-- Author row --}}
                        <div class="flex items-center justify-between gap-3 flex-wrap">
                            <div class="flex items-center gap-2.5">
                                <div @class([
                                    'w-8 h-8 rounded-lg flex items-center justify-center text-[0.65rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $thread->user->role === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' =>
                                        $thread->user->role !== 'admin',
                                ])>
                                    {{ strtoupper(substr($thread->user->first_name, 0, 1) . substr($thread->user->last_name ?? '', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-normal text-gray-800">
                                        {{ $thread->user->first_name }} {{ $thread->user->last_name }}
                                    </p>
                                    <p class="text-[0.65rem] font-light text-gray-400">
                                        {{ $thread->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            {{-- Badges --}}
                            <div class="flex items-center gap-1.5 flex-wrap">
                                @if ($thread->is_answered)
                                    <span
                                        class="inline-flex items-center gap-1 text-[0.65rem] font-normal text-green-700 bg-green-50 border border-green-200 rounded-full px-2.5 py-1">
                                        <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                            <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.3"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Terjawab
                                    </span>
                                @endif
                                @if ($thread->is_pinned)
                                    <span
                                        class="inline-flex items-center gap-1 text-[0.65rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-1">
                                        Disematkan
                                    </span>
                                @endif
                                @if ($thread->user->role === 'admin')
                                    <span
                                        class="text-[0.65rem] font-normal text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-1">
                                        Dosen / Admin
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        {{-- Body --}}
                        <div class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $thread->body }}
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-3 pt-1">
                            <button onclick="document.getElementById('reply-textarea').focus()"
                                class="flex items-center gap-1.5 text-[0.72rem] font-light text-gray-400 hover:text-blue-700 transition-colors">
                                <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                                    <path
                                        d="M2 10V5a1 1 0 0 1 1-1h1l2-2h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H8l-2 2H3a1 1 0 0 1-1-1z"
                                        stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" />
                                </svg>
                                Balas
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ── REPLIES ── --}}
                <div class="flex flex-col gap-1" id="replies-container">
                    <p class="text-xs font-normal text-gray-500 px-1 mb-2" id="reply-count">
                        {{ $thread->replies->count() }} Balasan
                    </p>

                    @foreach ($thread->replies as $reply)
                        <div class="flex gap-3 group" id="reply-{{ $reply->id }}">

                            {{-- Avatar + thread line --}}
                            <div class="flex flex-col items-center pt-1 shrink-0">
                                <div @class([
                                    'w-8 h-8 rounded-lg flex items-center justify-center text-[0.65rem] font-semibold shrink-0',
                                    'bg-blue-900 text-white' => $reply->user->role === 'admin',
                                    'bg-blue-50 border border-blue-100 text-blue-900' =>
                                        $reply->user->role !== 'admin',
                                ])>
                                    {{ strtoupper(substr($reply->user->first_name, 0, 1) . substr($reply->user->last_name ?? '', 0, 1)) }}
                                </div>
                                @if (!$loop->last)
                                    <div class="w-px flex-1 bg-gray-100 mt-2 mb-1 min-h-4"></div>
                                @endif
                            </div>

                            {{-- Reply card --}}
                            <div @class([
                                'flex-1 mb-3 rounded-2xl overflow-hidden border transition-all duration-200',
                                'border-green-200 bg-green-50/50' => $reply->is_answer,
                                'border-gray-200 bg-white' => !$reply->is_answer,
                            ])>
                                @if ($reply->is_answer)
                                    <div class="h-[2px] bg-green-500"></div>
                                @endif

                                <div class="p-4 flex flex-col gap-3">
                                    {{-- Reply header --}}
                                    <div class="flex items-center justify-between gap-2 flex-wrap">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-normal text-gray-800">
                                                {{ $reply->user->first_name }} {{ $reply->user->last_name }}
                                            </p>
                                            @if ($reply->user->role === 'admin')
                                                <span
                                                    class="text-[0.6rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5">Admin</span>
                                            @endif
                                            @if ($reply->is_answer)
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
                                        </div>
                                        <span class="text-[0.65rem] font-light text-gray-400">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    {{-- Quoted reply preview --}}
                                    @if ($reply->quotedReply)
                                        <div class="px-3 py-2 bg-gray-50 border-l-2 border-blue-200 rounded-r-xl">
                                            <p class="text-[0.65rem] font-normal text-blue-600">
                                                {{ $reply->quotedReply->user->first_name }}
                                            </p>
                                            <p class="text-[0.7rem] font-light text-gray-500 line-clamp-2">
                                                {{ Str::limit($reply->quotedReply->body, 80) }}
                                            </p>
                                        </div>
                                    @endif

                                    {{-- Body --}}
                                    <p class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">
                                        {{ $reply->body }}
                                    </p>

                                    {{-- Reply footer --}}
                                    <div class="flex items-center gap-3 pt-1 border-t border-gray-100">
                                        {{-- Like --}}
                                        <button
                                            class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400 hover:text-blue-700 transition-colors">
                                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                                <path
                                                    d="M2 7.5C2 6.7 2.7 6 3.5 6H5V3.5C5 2.7 5.7 2 6.5 2S8 2.7 8 3.5V6h1.5C10.3 6 11 6.7 11 7.5v3c0 .8-.7 1.5-1.5 1.5h-6C2.7 12 2 11.3 2 10.5v-3z"
                                                    stroke="currentColor" stroke-width="1.2"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            {{ $reply->likes ?? 0 }}
                                        </button>

                                        {{-- Quote reply --}}
                                        <button
                                            onclick="quoteReply({{ $reply->id }}, '{{ addslashes($reply->user->first_name) }}', '{{ addslashes(Str::limit($reply->body, 60)) }}')"
                                            class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400 hover:text-blue-700 transition-colors">
                                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                                <path
                                                    d="M2 10V5a1 1 0 0 1 1-1h1l2-2h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H8l-2 2H3a1 1 0 0 1-1-1z"
                                                    stroke="currentColor" stroke-width="1.2"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Balas
                                        </button>

                                        {{-- Mark answer --}}
                                        @if (!$reply->is_answer && (auth()->id() === $thread->user_id || auth()->user()->role === 'admin'))
                                            <button
                                                class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400 hover:text-green-600 transition-colors ml-auto">
                                                <svg width="12" height="12" viewBox="0 0 12 12"
                                                    fill="none">
                                                    <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Tandai jawaban
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- ── REPLY FORM ── --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden" id="reply-form">
                    <div class="h-[3px] bg-blue-900"></div>
                    <div class="p-5 flex flex-col gap-3">

                        {{-- Author info --}}
                        <div class="flex items-center gap-2.5">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center text-[0.6rem] font-semibold text-white shrink-0">
                                {{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                            </div>
                            <span class="text-xs font-light text-gray-500">
                                Balas sebagai <span
                                    class="font-normal text-gray-700">{{ auth()->user()->first_name ?? 'Kamu' }}</span>
                            </span>
                        </div>

                        <form method="POST"
                            action="{{ route('session.discussion.reply', [$session->id, $thread->id]) }}"
                            id="form-reply" class="flex flex-col gap-3">
                            @csrf

                            {{-- Quote preview --}}
                            <div id="quote-preview"
                                class="hidden px-3 py-2.5 bg-gray-50 border-l-2 border-blue-300 rounded-r-xl">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span id="quote-author" class="text-[0.65rem] font-normal text-blue-700"></span>
                                    <button type="button" onclick="clearQuote()"
                                        class="text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <path d="M2 2l6 6M8 2l-6 6" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                                <p id="quote-body" class="text-[0.7rem] font-light text-gray-500 line-clamp-2">
                                </p>
                                <input type="hidden" name="quote_reply_id" id="quote-reply-id">
                            </div>

                            <textarea name="body" id="reply-textarea" rows="3" placeholder="Tulis balasanmu di sini..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 resize-none leading-relaxed"></textarea>

                            <div class="flex items-center justify-between gap-3">
                                <p class="text-[0.68rem] font-light text-gray-400">
                                    Gunakan bahasa yang sopan dan relevan dengan topik diskusi
                                </p>
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
                                        class="text-gray-700 font-normal">
                                        {{ $thread->user->first_name }} {{ $thread->user->last_name }}
                                    </span></span>
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
                                    {{ $thread->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-400 shrink-0">
                                    <path d="M11 7a2 2 0 0 1-2 2H3l-2 2V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z"
                                        stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" />
                                </svg>
                                <span class="text-xs font-light text-gray-500" id="sidebar-reply-count">
                                    {{ $thread->replies->count() }} balasan
                                </span>
                            </div>
                        </div>

                        {{-- Answered status --}}
                        @if ($thread->is_answered)
                            <div
                                class="flex items-center gap-2 px-3 py-2 bg-green-50 border border-green-200 rounded-xl mt-1">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    class="text-green-600 shrink-0">
                                    <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="text-[0.7rem] font-light text-green-700">Thread ini sudah
                                    terjawab</span>
                            </div>
                        @else
                            <div
                                class="flex items-center gap-2 px-3 py-2 bg-orange-50 border border-orange-200 rounded-xl mt-1">
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

                        {{-- Online indicator --}}
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-xs font-light text-green-600" id="online-count">... online</span>
                        </div>
                    </div>
                </div>

                {{-- Partisipan thread --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-4">
                    <h2 class="text-sm font-medium text-gray-900">Partisipan</h2>
                    <div class="flex flex-col gap-2.5">
                        {{-- Thread owner --}}
                        <div class="flex items-center gap-2.5">
                            <div @class([
                                'w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-semibold shrink-0',
                                'bg-blue-900 text-white' => $thread->user->role === 'admin',
                                'bg-blue-50 border border-blue-100 text-blue-900' =>
                                    $thread->user->role !== 'admin',
                            ])>
                                {{ strtoupper(substr($thread->user->first_name, 0, 1) . substr($thread->user->last_name ?? '', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-normal text-gray-700 truncate">
                                    {{ $thread->user->first_name }} {{ $thread->user->last_name }}
                                </p>
                                <p class="text-[0.62rem] font-light text-gray-400">Pembuat thread</p>
                            </div>
                        </div>

                        {{-- Reply participants (unique, exclude thread owner) --}}
                        @foreach ($thread->replies->unique('user_id') as $reply)
                            @if ($reply->user_id !== $thread->user_id)
                                <div class="flex items-center gap-2.5">
                                    <div @class([
                                        'w-7 h-7 rounded-lg flex items-center justify-center text-[0.6rem] font-semibold shrink-0',
                                        'bg-blue-900 text-white' => $reply->user->role === 'admin',
                                        'bg-blue-50 border border-blue-100 text-blue-900' =>
                                            $reply->user->role !== 'admin',
                                    ])>
                                        {{ strtoupper(substr($reply->user->first_name, 0, 1) . substr($reply->user->last_name ?? '', 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-normal text-gray-700 truncate">
                                            {{ $reply->user->first_name }} {{ $reply->user->last_name }}
                                        </p>
                                        <p class="text-[0.62rem] font-light text-gray-400">
                                            {{ $reply->user->role === 'admin' ? 'Admin / Dosen' : 'Peserta' }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- Thread lainnya --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                    <h2 class="text-sm font-medium text-gray-900">Thread Lainnya</h2>
                    <div class="flex flex-col gap-2">
                        @forelse ($otherThreads as $other)
                            <a href="{{ route('session.discussion.show', [$session->id, $other->id]) }}"
                                class="flex items-start gap-2.5 px-3 py-2.5 bg-gray-50 border border-gray-100 hover:border-gray-200 rounded-xl transition-colors no-underline group">
                                <div @class([
                                    'w-1.5 h-1.5 rounded-full mt-1.5 shrink-0',
                                    'bg-green-400' => $other->is_answered,
                                    'bg-orange-300' => !$other->is_answered,
                                ])></div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-xs font-normal text-gray-700 group-hover:text-blue-900 transition-colors line-clamp-2 leading-snug">
                                        {{ $other->title }}
                                    </p>
                                    <p class="text-[0.62rem] font-light text-gray-400 mt-0.5">
                                        {{ $other->replies_count }} balasan
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs font-light text-gray-400">Belum ada thread lain.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('session.discussion.index', $session->id) }}"
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
        // ── Quote reply ──
        function quoteReply(replyId, author, body) {
            document.getElementById('quote-preview').classList.remove('hidden');
            document.getElementById('quote-author').textContent = author;
            document.getElementById('quote-body').textContent = body;
            document.getElementById('quote-reply-id').value = replyId;
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

        // ── Submit reply via AJAX ──
        document.getElementById('form-reply').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            const btn = form.querySelector('button[type=submit]');
            const body = form.querySelector('textarea[name=body]').value.trim();

            if (!body) return;

            btn.disabled = true;
            btn.textContent = 'Mengirim...';

            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                        'X-Socket-ID': window.Echo?.socketId() ?? '', // ← tambah ini
                    },
                    body: JSON.stringify({
                        body: body,
                        quote_reply_id: document.getElementById('quote-reply-id').value || null,
                    }),
                });

                const data = await res.json();

                if (data.success) {
                    appendReply(data.reply, true);
                    form.reset();
                    clearQuote();
                }
            } catch (err) {
                console.error(err);
            } finally {
                btn.disabled = false;
                btn.innerHTML = `<svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                    <path d="M2 7h8M7 4l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg> Kirim Balasan`;
            }
        });



        // ── Render reply card ──
        function appendReply(reply, isOwn = false) {
            const container = document.getElementById('replies-container');
            const isAdmin = reply.user.role === 'admin';

            const quoteHtml = reply.quoted_reply ? `
                <div class="px-3 py-2 bg-gray-50 border-l-2 border-blue-200 rounded-r-xl">
                    <p class="text-[0.65rem] font-normal text-blue-600">${reply.quoted_reply.author}</p>
                    <p class="text-[0.7rem] font-light text-gray-500 line-clamp-2">${reply.quoted_reply.body}</p>
                </div>` : '';

            const adminBadge = isAdmin ?
                `<span class="text-[0.6rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5">Admin</span>` :
                '';

            const ownBadge = isOwn ?
                `<span class="text-[0.6rem] font-light text-gray-400 bg-gray-100 rounded-full px-2 py-0.5">Kamu</span>` :
                '';

            const avatarClass = isAdmin ?
                'bg-blue-900 text-white' :
                'bg-blue-50 border border-blue-100 text-blue-900';

            const el = document.createElement('div');
            el.className = 'flex gap-3 group';
            el.id = `reply-${reply.id}`;
            el.innerHTML = `
                <div class="flex flex-col items-center pt-1 shrink-0">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-[0.65rem] font-semibold shrink-0 ${avatarClass}">
                        ${reply.user.initials}
                    </div>
                </div>
                <div class="flex-1 mb-3 rounded-2xl overflow-hidden border border-gray-200 bg-white">
                    <div class="p-4 flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-2 flex-wrap">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-normal text-gray-800">${reply.user.name}</p>
                                ${adminBadge}
                                ${ownBadge}
                            </div>
                            <span class="text-[0.65rem] font-light text-gray-400">${reply.created_at}</span>
                        </div>
                        ${quoteHtml}
                        <p class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">${reply.body}</p>
                        <div class="flex items-center gap-3 pt-1 border-t border-gray-100">
                            <button class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400 hover:text-blue-700 transition-colors">
                                <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                    <path d="M2 7.5C2 6.7 2.7 6 3.5 6H5V3.5C5 2.7 5.7 2 6.5 2S8 2.7 8 3.5V6h1.5C10.3 6 11 6.7 11 7.5v3c0 .8-.7 1.5-1.5 1.5h-6C2.7 12 2 11.3 2 10.5v-3z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                                </svg>
                                ${reply.likes ?? 0}
                            </button>
                            <button onclick="quoteReply(${reply.id}, '${reply.user.name.replace(/'/g, "\\'")}', '${reply.body.replace(/'/g, "\\'").replace(/\n/g, ' ').substring(0, 60)}')"
                                class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400 hover:text-blue-700 transition-colors">
                                Balas
                            </button>
                        </div>
                    </div>
                </div>`;

            container.appendChild(el);
            el.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });

            // Update reply count di dua tempat
            const countEl = document.getElementById('reply-count');
            const sidebarEl = document.getElementById('sidebar-reply-count');
            const currentCount = parseInt(countEl?.textContent) || 0;
            if (countEl) countEl.textContent = (currentCount + 1) + ' Balasan';
            if (sidebarEl) sidebarEl.textContent = (currentCount + 1) + ' balasan';
        }

        // ── Laravel Echo — presence channel per thread ──
        let onlineCount = 0;

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof window.Echo === 'undefined') {
                console.error('Laravel Echo not initialized');
                return;
            }

            let onlineCount = 0;

            window.Echo.join(`thread.{{ $thread->id }}`)
                .here((users) => {
                    onlineCount = users.length;
                    renderOnline();
                })
                .joining(() => {
                    onlineCount++;
                    renderOnline();
                })
                .leaving(() => {
                    onlineCount = Math.max(1, onlineCount - 1);
                    renderOnline();
                })
                .listen('.reply.posted', (e) => {
                    if (document.getElementById(`reply-${e.reply.id}`)) return;
                    appendReply(e.reply, false);
                });

            function renderOnline() {
                const el = document.getElementById('online-count');
                if (el) el.textContent = onlineCount + ' online';
            }
        });

        function renderOnline() {
            const el = document.getElementById('online-count');
            if (el) el.textContent = onlineCount + ' online';
        }
    </script>

</x-layout-main>
