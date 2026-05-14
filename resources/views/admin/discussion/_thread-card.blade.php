{{--
    Partial: admin/discussion/_thread-card.blade.php
    Props: $thread (DiscussionThread), $session (ClassSession)
--}}
@php
    // is_reported ada di discussion_replies, bukan di discussion_threads
    $hasReport = $thread->replies()->where('is_reported', true)->exists();
@endphp

<div data-thread-id="{{ $thread->id }}"
    class="bg-white border {{ $hasReport ? 'border-red-200' : 'border-gray-200' }} hover:border-gray-300 rounded-2xl overflow-hidden transition-all duration-200">
    <div class="flex">
        <div @class([
            'w-[3px] shrink-0',
            'bg-blue-900' => $thread->is_pinned,
            'bg-red-400' => $hasReport && !$thread->is_pinned,
            'bg-gray-100' => !$thread->is_pinned && !$hasReport,
        ]) data-accent></div>

        <div class="flex-1 px-5 py-4 flex flex-col gap-2.5 min-w-0">

            {{-- Badges --}}
            <div class="flex items-center gap-1.5 flex-wrap">
                <span @class([
                    'inline-flex items-center gap-1 text-[0.62rem] font-normal text-blue-700 bg-blue-50 border border-blue-200 rounded-full px-2 py-0.5',
                    'hidden' => !$thread->is_pinned,
                ]) data-pinned-badge>Disematkan</span>

                @if ($thread->is_answered)
                    <span
                        class="inline-flex items-center gap-1 text-[0.62rem] font-normal text-green-700 bg-green-50 border border-green-200 rounded-full px-2 py-0.5">
                        <svg width="8" height="8" viewBox="0 0 10 10" fill="none">
                            <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Terjawab
                    </span>
                @endif

                @if ($hasReport)
                    <span
                        class="inline-flex items-center gap-1 text-[0.62rem] font-normal text-red-600 bg-red-50 border border-red-200 rounded-full px-2 py-0.5">
                        <svg width="8" height="8" viewBox="0 0 10 10" fill="none">
                            <circle cx="5" cy="5" r="4" stroke="currentColor" stroke-width="1.2" />
                            <path d="M5 3v2.5M5 7v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
                        </svg>
                        Dilaporkan
                    </span>
                @endif

                @if ($thread->user->role === 'admin')
                    <span
                        class="text-[0.62rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">
                        Dosen / Admin
                    </span>
                @endif

                @if ($thread->is_announcement ?? false)
                    <span
                        class="text-[0.62rem] font-normal text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-full px-2 py-0.5">
                        Pengumuman
                    </span>
                @endif
            </div>

            {{-- Title --}}
            <a href="{{ route('admin.attendance.discussions.show', ['id' => $session->id, 'thread' => $thread->id]) }}"
                class="text-sm font-medium text-gray-900 leading-snug hover:text-blue-900 no-underline transition-colors">
                {{ $thread->title }}
            </a>

            {{-- Body preview --}}
            <p class="text-xs font-light text-gray-500 leading-relaxed line-clamp-2">
                {{ $thread->body }}
            </p>

            {{-- Footer --}}
            <div class="flex items-center justify-between gap-3 pt-0.5 flex-wrap">
                <div class="flex items-center gap-2">
                    <div @class([
                        'w-5 h-5 rounded-md flex items-center justify-center text-[0.5rem] font-semibold shrink-0',
                        'bg-blue-900 text-white' => $thread->user->role === 'admin',
                        'bg-blue-50 border border-blue-100 text-blue-900' =>
                            $thread->user->role !== 'admin',
                    ])>
                        {{ strtoupper(substr($thread->user->first_name, 0, 1) . substr($thread->user->last_name ?? '', 0, 1)) }}
                    </div>
                    <span class="text-[0.7rem] font-light text-gray-600">{{ $thread->user->first_name }}
                        {{ $thread->user->last_name }}</span>
                    <span class="text-gray-200">·</span>
                    <span
                        class="text-[0.7rem] font-light text-gray-400">{{ $thread->created_at->diffForHumans() }}</span>
                    <span class="text-gray-200">·</span>
                    <span class="text-[0.7rem] font-light text-gray-400" id="reply-count-{{ $thread->id }}">
                        {{ $thread->replies_count }} balasan
                    </span>
                </div>

                {{-- Admin quick actions --}}
                <div class="flex items-center gap-1.5">
                    {{-- Pin toggle --}}
                    <button onclick="togglePin({{ $thread->id }}, this)"
                        title="{{ $thread->is_pinned ? 'Lepas sematkan' : 'Sematkan' }}" @class([
                            'flex items-center justify-center w-7 h-7 border rounded-lg transition-colors',
                            'text-blue-700 bg-blue-50 border-blue-200' => $thread->is_pinned,
                            'text-gray-400 bg-white border-gray-200 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700' => !$thread->is_pinned,
                        ])>
                        <svg width="11" height="11" viewBox="0 0 12 16" fill="none">
                            <path d="M6 1v8M3 9h6M6 9v6" stroke="currentColor" stroke-width="1.4"
                                stroke-linecap="round" />
                        </svg>
                    </button>

                    {{-- Delete --}}
                    <button onclick="deleteThread({{ $thread->id }}, this)" title="Hapus thread"
                        class="flex items-center justify-center w-7 h-7 border border-gray-200 bg-white rounded-lg text-gray-400 hover:bg-red-50 hover:border-red-200 hover:text-red-500 transition-colors">
                        <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                            <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor"
                                stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    {{-- Buka --}}
                    <a href="{{ route('admin.attendance.discussions.show', ['id' => $session->id, 'thread' => $thread->id]) }}"
                        class="flex items-center gap-1 px-3 py-1.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-lg transition-colors no-underline">
                        Buka
                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                            <path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
