{{--
    Partial: admin/discussion/_reply-card.blade.php
    Props: $reply (DiscussionReply), $thread, $session, $loop
--}}
<div class="flex gap-3 group" id="reply-wrapper-{{ $reply->id }}">

    {{-- Avatar + connector line --}}
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
    <div id="reply-{{ $reply->id }}" @class([
        'flex-1 mb-3 rounded-2xl overflow-hidden border transition-all duration-200',
        'border-red-200 bg-red-50/30' => $reply->is_reported,
        'border-green-200 bg-green-50/40' =>
            $reply->is_answer && !$reply->is_reported,
        'border-gray-200 bg-white' => !$reply->is_answer && !$reply->is_reported,
    ])>

        @if ($reply->is_reported)
            <div class="h-[2px] bg-red-400" data-reply-accent></div>
        @elseif ($reply->is_answer)
            <div class="h-[2px] bg-green-500" data-reply-accent></div>
        @else
            <div class="h-[2px] hidden" data-reply-accent></div>
        @endif

        <div class="p-4 flex flex-col gap-3">

            {{-- Header --}}
            <div class="flex items-center justify-between gap-2 flex-wrap">
                <div class="flex items-center gap-2">
                    <p class="text-sm font-normal text-gray-800">{{ $reply->user->first_name }}
                        {{ $reply->user->last_name }}</p>
                    @if ($reply->user->role === 'admin')
                        <span
                            class="text-[0.6rem] font-normal text-purple-700 bg-purple-50 border border-purple-200 rounded-full px-2 py-0.5">Admin</span>
                    @endif
                    <span data-answer-badge @class([
                        'inline-flex items-center gap-1 text-[0.6rem] font-normal text-green-700 bg-green-100 border border-green-200 rounded-full px-2 py-0.5',
                        'hidden' => !$reply->is_answer,
                    ])>
                        <svg width="8" height="8" viewBox="0 0 10 10" fill="none">
                            <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Jawaban terpilih
                    </span>
                    @if ($reply->is_reported)
                        <span data-report-badge
                            class="inline-flex items-center gap-1 text-[0.6rem] font-normal text-red-600 bg-red-50 border border-red-200 rounded-full px-2 py-0.5">
                            <svg width="8" height="8" viewBox="0 0 10 10" fill="none">
                                <circle cx="5" cy="5" r="4" stroke="currentColor" stroke-width="1.2" />
                                <path d="M5 3v2.5M5 7v.5" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" />
                            </svg>
                            Dilaporkan
                        </span>
                    @endif
                </div>
                <span class="text-[0.65rem] font-light text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
            </div>

            {{-- Quoted reply --}}
            @if ($reply->quotedReply)
                <div class="px-3 py-2 bg-gray-50 border-l-2 border-blue-200 rounded-r-lg">
                    <p class="text-[0.65rem] font-normal text-blue-600 mb-0.5">
                        {{ $reply->quotedReply->user->first_name }}</p>
                    <p class="text-xs font-light text-gray-500 line-clamp-2">
                        {{ \Str::limit($reply->quotedReply->body, 100) }}</p>
                </div>
            @endif

            {{-- Body --}}
            <p class="text-sm font-light text-gray-700 leading-relaxed whitespace-pre-line">{{ $reply->body }}</p>

            {{-- Action footer --}}
            <div class="flex items-center gap-2 pt-1 border-t border-gray-100 flex-wrap">

                {{-- Likes --}}
                <div class="flex items-center gap-1.5 text-[0.7rem] font-light text-gray-400">
                    <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                        <path
                            d="M2 7.5C2 6.7 2.7 6 3.5 6H5V3.5C5 2.7 5.7 2 6.5 2S8 2.7 8 3.5V6h1.5C10.3 6 11 6.7 11 7.5v3c0 .8-.7 1.5-1.5 1.5h-6C2.7 12 2 11.3 2 10.5v-3z"
                            stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" />
                    </svg>
                    <span id="likes-{{ $reply->id }}">{{ $reply->likes }}</span> suka
                </div>

                {{-- Mark as answer --}}
                <button onclick="toggleMarkAnswer({{ $reply->id }}, this)" @class([
                    'flex items-center gap-1.5 px-2.5 py-1 border rounded-lg text-[0.7rem] font-light transition-colors',
                    'text-green-700 bg-green-50 border-green-200' => $reply->is_answer,
                    'text-gray-500 bg-white border-gray-200 hover:bg-green-50 hover:border-green-200 hover:text-green-700' => !$reply->is_answer,
                ])>
                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                        <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>{{ $reply->is_answer ? 'Batalkan Jawaban' : 'Jadikan Jawaban' }}</span>
                </button>

                {{-- Quote --}}
                <button
                    onclick="quoteReply({{ $reply->id }}, '{{ addslashes($reply->user->first_name . ' ' . $reply->user->last_name) }}', '{{ addslashes(\Str::limit($reply->body, 80)) }}')"
                    class="flex items-center gap-1.5 px-2.5 py-1 border border-gray-200 bg-white hover:bg-gray-50 text-[0.7rem] font-light text-gray-500 rounded-lg transition-colors">
                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                        <path d="M11 7a2 2 0 0 1-2 2H3l-2 2V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4z" stroke="currentColor"
                            stroke-width="1.2" stroke-linejoin="round" />
                    </svg>
                    Kutip
                </button>

                {{-- Dismiss report --}}
                @if ($reply->is_reported)
                    <button onclick="dismissReport({{ $reply->id }}, this)"
                        class="flex items-center gap-1.5 px-2.5 py-1 border border-orange-200 bg-orange-50 text-orange-600 hover:bg-orange-100 rounded-lg text-[0.7rem] font-light transition-colors">
                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                            <path d="M2 2l8 8M10 2l-8 8" stroke="currentColor" stroke-width="1.3"
                                stroke-linecap="round" />
                        </svg>
                        Abaikan Laporan
                    </button>
                @endif

                {{-- Delete --}}
                <button onclick="deleteReply({{ $reply->id }}, this)"
                    class="ml-auto flex items-center gap-1.5 px-2.5 py-1 border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-[0.7rem] font-light text-gray-500 rounded-lg transition-colors">
                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                        <path d="M2 3h8M4 3V2h4v1M5 5.5v3M7 5.5v3M3 3l.5 7h5L9 3" stroke="currentColor"
                            stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>
