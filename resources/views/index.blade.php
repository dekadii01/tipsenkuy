<x-layout-main title="Home - TipsenKuy">
    <header class="navbar">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="#" class="flex items-center gap-2.5 group">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-accent">
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
                <span class="text-sm font-medium tracking-tight text-text-base">TipsenKuy</span>
            </a>

            <div class="hidden md:flex gap-3">
                <a href="#features"
                    class="px-4 py-2 rounded-lg text-sm font-light text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-colors">Features</a>
                <a href="#how"
                    class="px-4 py-2 rounded-lg text-sm font-light text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-colors">How
                    It Works</a>
                <a href="#contact"
                    class="px-4 py-2 rounded-lg text-sm font-light text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-colors">Contact</a>
            </div>

            <nav class="flex items-center gap-3">

                @auth
                    @if (auth()->user()->role === 'admin')
                        <div x-data="{ open: false }" class="relative">

                            <button @click="open = !open"
                                class="flex items-center gap-2 px-2.5 py-1.5 border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-colors">

                                <div
                                    class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-xs font-medium text-blue-900">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                                </div>

                                <span class="text-sm font-normal text-gray-800 max-w-32 truncate">
                                    {{ auth()->user()->name ?? 'Admin' }}
                                </span>

                                <svg width="12" height="12" viewBox="0 0 12 12"
                                    class="text-gray-400 transition-transform" :class="{ 'rotate-180': open }">
                                    <path d="M3 5l3 3 3-3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">
                                <a href="{{ route('dashboard-admin') }}"
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                    📊 Dashboard
                                </a>
                                <a href=""
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                    👤 Profile
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin logout?')"
                                        class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                        🚪 Logout
                                    </button>
                                </form>

                            </div>

                        </div>
                    @else
                        <div x-data="{ open: false }" class="relative">

                            <button @click="open = !open"
                                class="flex items-center gap-2 px-2.5 py-1.5 border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-colors">

                                <div
                                    class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-xs font-medium text-blue-900">
                                    {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 2)) }}
                                </div>

                                <span class="text-sm font-normal text-gray-800 max-w-32 truncate">
                                    {{ auth()->user()->first_name ?? 'Admin' }}
                                </span>

                                <svg width="12" height="12" viewBox="0 0 12 12"
                                    class="text-gray-400 transition-transform" :class="{ 'rotate-180': open }">
                                    <path d="M3 5l3 3 3-3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">
                                <a href="{{ route('dashboard-user') }}"
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                    📊 Dashboard
                                </a>
                                <a href=""
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                    👤 Profile
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin logout?')"
                                        class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                        🚪 Logout
                                    </button>
                                </form>

                            </div>

                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-lg text-sm font-light text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-colors">Login</a>
                    <a href="#"
                        class="px-4 py-2 rounded-lg bg-accent text-white text-sm font-light hover:bg-accent-hover transition-colors">Sign
                        Up</a>
                @endauth
            </nav>

        </div>
    </header>

    <main>

        <section class="relative overflow-hidden dot-bg">
            <div class="absolute inset-0 pointer-events-none hero-gradient"></div>

            <div class="max-w-6xl mx-auto px-6 py-24 md:py-36 relative">
                <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">

                    <div class="flex-1 text-center lg:text-left">
                        <span class="tag animate-fade-up">Attendance Reimagined</span>

                        <h1
                            class="mt-6 text-4xl md:text-5xl lg:text-6xl font-light leading-tight tracking-tight
                                   text-text-base animate-fade-up delay-100">
                            Smart QR<br>
                            <span class="font-medium text-accent">Attendance</span><br>
                            System
                        </h1>

                        <p
                            class="mt-6 text-base md:text-lg font-light leading-relaxed max-w-md mx-auto lg:mx-0
                                  text-text-muted animate-fade-up delay-200">
                            Generate, scan, and track attendance in seconds. No paper, no friction —
                            just a QR code and you're done.
                        </p>

                        <div
                            class="mt-10 flex flex-wrap items-center gap-3 justify-center lg:justify-start
                                    animate-fade-up delay-350">
                            <a href="#" class="btn-primary gap-2 px-7 py-3 rounded-xl w-fit">
                                Get Started
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M3 7h8M8 4l3 3-3 3" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <a href="#how" class="btn-outline gap-2 px-6 py-3 rounded-xl">Learn More</a>
                        </div>

                        <p class="mt-10 font-mono-light text-xs text-accent-muted animate-fade-up delay-500"
                            style="letter-spacing:.06em">
                            FAST · SECURE · PAPERLESS
                        </p>
                    </div>

                    <div class="shrink-0 animate-fade-up delay-200">
                        <div class="ring-outer w-72 h-72 md:w-80 md:h-80">
                            <div class="ring-inner w-56 h-56 md:w-64 md:h-64 relative">
                                <svg width="120" height="120" viewBox="0 0 120 120" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="8" y="8" width="34" height="34" rx="4" fill="#0f4c81" />
                                    <rect x="14" y="14" width="22" height="22" rx="2"
                                        fill="white" />
                                    <rect x="20" y="20" width="10" height="10" rx="1"
                                        fill="#0f4c81" />
                                    <rect x="78" y="8" width="34" height="34" rx="4"
                                        fill="#0f4c81" />
                                    <rect x="84" y="14" width="22" height="22" rx="2"
                                        fill="white" />
                                    <rect x="90" y="20" width="10" height="10" rx="1"
                                        fill="#0f4c81" />
                                    <rect x="8" y="78" width="34" height="34" rx="4"
                                        fill="#0f4c81" />
                                    <rect x="14" y="84" width="22" height="22" rx="2"
                                        fill="white" />
                                    <rect x="20" y="90" width="10" height="10" rx="1"
                                        fill="#0f4c81" />
                                    <rect x="52" y="8" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="64" y="8" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="52" y="20" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="64" y="20" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="52" y="32" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="8" y="52" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="20" y="52" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="32" y="52" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="8" y="64" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="20" y="64" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="32" y="64" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="52" y="52" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="64" y="52" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="78" y="52" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="90" y="52" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="102" y="52" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="52" y="64" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="64" y="64" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="78" y="64" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="90" y="64" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="102" y="64" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="52" y="78" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="64" y="78" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="78" y="78" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="90" y="90" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="102" y="78" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="52" y="90" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="64" y="90" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="78" y="90" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="102" y="90" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="52" y="102" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="64" y="102" width="10" height="10" rx="1.5"
                                        fill="#c0d4ea" />
                                    <rect x="78" y="102" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="90" y="102" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                    <rect x="102" y="102" width="10" height="10" rx="1.5"
                                        fill="#0f4c81" />
                                </svg>

                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none"
                                    aria-hidden="true">
                                    <div class="scan-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="features" class="py-24 md:py-32 bg-surface">
            <div class="max-w-6xl mx-auto px-6">

                <div class="text-center mb-16">
                    <span class="tag">Features</span>
                    <h2 class="mt-5 text-3xl md:text-4xl font-light tracking-tight text-text-base">
                        Everything you need,<br class="hidden sm:block"> nothing you don't.
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="feature-card p-8">
                        <div class="icon-wrap mb-6">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                class="text-accent">
                                <rect x="2" y="2" width="7" height="7" rx="1.5" stroke="currentColor"
                                    stroke-width="1.5" />
                                <rect x="11" y="2" width="7" height="7" rx="1.5"
                                    stroke="currentColor" stroke-width="1.5" />
                                <rect x="2" y="11" width="7" height="7" rx="1.5"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M11 14.5h2.5M14.5 11v2.5M14.5 14.5v2.5M17 14.5h-2.5" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3 class="text-base font-medium mb-2 text-text-base">Dynamic QR Code</h3>
                        <p class="text-sm font-light leading-relaxed text-text-muted">
                            Generate unique, time-bound QR codes for each session to prevent misuse and ensure accuracy.
                        </p>
                    </div>

                    <div class="feature-card p-8">
                        <div class="icon-wrap mb-6">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                class="text-accent">
                                <path d="M10 2a8 8 0 100 16A8 8 0 0010 2z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M10 6v4l2.5 2.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3 class="text-base font-medium mb-2 text-text-base">Fast Scanning</h3>
                        <p class="text-sm font-light leading-relaxed text-text-muted">
                            Scan and confirm attendance in under a second — works with any modern smartphone camera.
                        </p>
                    </div>

                    <div class="feature-card p-8">
                        <div class="icon-wrap mb-6">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                class="text-accent">
                                <path d="M10 2l2.5 5 5.5.8-4 3.9.9 5.5L10 14.5 5.1 17.2 6 11.7 2 7.8l5.5-.8L10 2z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3 class="text-base font-medium mb-2 text-text-base">Secure Tracking</h3>
                        <p class="text-sm font-light leading-relaxed text-text-muted">
                            All attendance records are securely stored and instantly accessible from your dashboard.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section id="how" class="py-24 md:py-32 bg-white">
            <div class="max-w-6xl mx-auto px-6">

                <div class="text-center mb-20">
                    <span class="tag">How It Works</span>
                    <h2 class="mt-5 text-3xl md:text-4xl tracking-tight text-text-base">
                        Simple attendance in three seamless steps.
                    </h2>
                </div>

                <div class="flex flex-col md:flex-row items-start md:items-stretch gap-0">

                    <div class="flex-1 flex flex-col items-center text-center px-6 py-10 relative">
                        <div class="step-divider"></div>
                        <span class="step-num mb-6">01</span>
                        <div class="icon-wrap-lg mb-6">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                class="text-accent">
                                <rect x="4" y="4" width="10" height="10" rx="2" stroke="currentColor"
                                    stroke-width="1.5" />
                                <rect x="14" y="4" width="10" height="10" rx="2"
                                    stroke="currentColor" stroke-width="1.5" />
                                <rect x="4" y="14" width="10" height="10" rx="2"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M16 16h2M19 16h3M16 19v3M22 16v3M19 22h3" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3 class="text-base font-medium mb-2 text-text-base">Create Session</h3>
                        <p class="text-sm font-light leading-relaxed max-w-xs text-text-muted">
                            Admin starts a session and instantly generates a unique QR code for that attendance period.
                        </p>
                    </div>

                    <div class="md:hidden w-px h-10 self-center bg-border"></div>

                    <div class="flex-1 flex flex-col items-center text-center px-6 py-10 relative">
                        <div class="step-divider"></div>
                        <span class="step-num mb-6">02</span>
                        <div class="icon-wrap-lg mb-6">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                class="text-accent">
                                <rect x="7" y="4" width="14" height="20" rx="3" stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M11 9h6M11 13h6M11 17h3" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M14 23v1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3 class="text-base font-medium mb-2 text-text-base">Scan QR Code</h3>
                        <p class="text-sm font-light leading-relaxed max-w-xs text-text-muted">
                            Participants simply scan the QR code using their device — quick, seamless, and no setup
                            required.
                        </p>
                    </div>

                    <div class="md:hidden w-px h-10 self-center bg-border"></div>

                    <div class="flex-1 flex flex-col items-center text-center px-6 py-10">
                        <span class="step-num mb-6">03</span>
                        <div class="icon-wrap-lg mb-6">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                class="text-accent">
                                <path d="M5 15l6 6L23 8" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3 class="text-base font-medium mb-2 text-text-base">Attendance Recorded</h3>
                        <p class="text-sm font-light leading-relaxed max-w-xs text-text-muted">
                            Attendance is securely recorded in real-time and instantly visible in the admin dashboard.
                        </p>
                    </div>

                </div>

                <div class="mt-16 text-center">
                    <a href="#" class="btn-primary gap-2 px-8 py-3.5 rounded-xl w-fit">
                        Get Started
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3 7h8M8 4l3 3-3 3" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>

            </div>
        </section>

    </main>


    <footer id="contact" class="bg-surface border-t border-border">
        <div class="max-w-6xl mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8">

                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-md flex items-center justify-center bg-accent">
                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                <rect x="1" y="1" width="5" height="5" rx="1" fill="white" />
                                <rect x="8" y="1" width="5" height="5" rx="1" fill="white" />
                                <rect x="1" y="8" width="5" height="5" rx="1" fill="white" />
                                <rect x="8" y="8" width="2" height="2" rx=".5" fill="white" />
                                <rect x="11" y="8" width="2" height="2" rx=".5" fill="white" />
                                <rect x="8" y="11" width="2" height="2" rx=".5" fill="white" />
                                <rect x="11" y="11" width="2" height="2" rx=".5" fill="white" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-text-base">TipsenKuy</span>
                    </div>
                    <p class="text-xs font-light max-w-xs text-text-muted">
                        Smart, paperless attendance tracking for schools, offices, and events.
                    </p>
                </div>

                <nav class="flex items-center gap-6">
                    <a href="{{ route('login') }}"
                        class="text-xs font-light text-text-muted hover:text-gray-900 transition-colors">Login</a>
                    <a href="#"
                        class="text-xs font-light text-text-muted hover:text-gray-900 transition-colors">Contact</a>
                    <a href="#features"
                        class="text-xs font-light text-text-muted hover:text-gray-900 transition-colors">Features</a>
                </nav>

            </div>

            <div
                class="mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-border">
                <p class="font-mono-light text-xs text-accent-muted" style="letter-spacing:.04em">
                    &copy; {{ date('Y') }} TipsenKuy. All rights reserved.
                </p>
                <p class="font-mono-light text-xs text-gray-300" style="letter-spacing:.04em">
                    Built with Laravel &amp; Tailwind CSS
                </p>
            </div>

        </div>
    </footer>
</x-layout-main>
