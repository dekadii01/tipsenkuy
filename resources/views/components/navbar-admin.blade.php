<header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">

        <a href="{{ url('/') }}" class="flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-lg bg-blue-900 flex items-center justify-center">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <rect x="1" y="1" width="5" height="5" rx="1" fill="white" />
                    <rect x="8" y="1" width="5" height="5" rx="1" fill="white" />
                    <rect x="1" y="8" width="5" height="5" rx="1" fill="white" />
                    <rect x="8" y="8" width="2" height="2" rx=".5" fill="white" />
                    <rect x="11" y="8" width="2" height="2" rx=".5" fill="white" />
                    <rect x="8" y="11" width="2" height="2" rx=".5" fill="white" />
                    <rect x="11" y="11" width="2" height="2" rx=".5" fill="white" />
                </svg>
            </div>
            <span class="text-sm font-medium tracking-tight text-gray-900">TipsenKuy</span>
        </a>

        <div class="flex items-center gap-3">

            {{-- Back --}}
            <a href=""
                class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 rounded-xl text-sm font-light text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-colors no-underline">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" class="text-gray-400">
                    <path d="M9 3L5 7l4 4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Semua Sesi
            </a>

            {{-- Notification --}}
            <button
                class="w-9 h-9 rounded-lg flex items-center justify-center border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 2a5 5 0 0 0-5 5v2.5L2 11h12l-1-1.5V7a5 5 0 0 0-5-5z" stroke="currentColor"
                        stroke-width="1.2" stroke-linejoin="round" />
                    <path d="M6.5 13a1.5 1.5 0 0 0 3 0" stroke="currentColor" stroke-width="1.2" />
                </svg>
            </button>

            {{-- USER DROPDOWN --}}
            <div x-data="{ open: false }" class="relative">

                {{-- Trigger --}}
                <button @click="open = !open"
                    class="flex items-center gap-2 px-2.5 py-1.5 border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-colors">

                    <div
                        class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-xs font-medium text-blue-900">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                    </div>

                    <span class="text-sm font-normal text-gray-800 max-w-32 truncate">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>

                    <svg width="12" height="12" viewBox="0 0 12 12" class="text-gray-400 transition-transform"
                        :class="{ 'rotate-180': open }">
                        <path d="M3 5l3 3 3-3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">

                    {{-- Profile --}}
                    <a href=""
                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                        👤 Profile
                    </a>

                    {{-- Divider --}}
                    <div class="border-t border-gray-100"></div>

                    {{-- Logout --}}
                    <form method="POST" action="">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                            🚪 Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>
</header>
