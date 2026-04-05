<x-layout-main title="Login" bodyClass="auth-body ">
    <aside class="panel-left">

        <div class="panel-ring" style="width:320px;height:320px;top:-80px;left:-80px;"></div>
        <div class="panel-ring" style="width:200px;height:200px;top:60px;left:60px;"></div>
        <div class="panel-ring" style="width:500px;height:500px;bottom:-200px;right:-200px;"></div>

        <div class="brand relative z-10">
            <div class="brand-icon brand-icon-light">
                <svg width="16" height="16" viewBox="0 0 14 14" fill="none">
                    <rect x="1" y="1" width="5" height="5" rx="1" fill="white" />
                    <rect x="8" y="1" width="5" height="5" rx="1" fill="white" />
                    <rect x="1" y="8" width="5" height="5" rx="1" fill="white" />
                    <rect x="8" y="8" width="2" height="2" rx=".5" fill="white" />
                    <rect x="11" y="8" width="2" height="2" rx=".5" fill="white" />
                    <rect x="8" y="11" width="2" height="2" rx=".5" fill="white" />
                    <rect x="11" y="11" width="2" height="2" rx=".5" fill="white" />
                </svg>
            </div>
            <span class="brand-name brand-name--light">TipsenKuy</span>
        </div>

        <div class="panel-center-content">
            <span class="tag tag--dark w-fit">Secure Login</span>
            <h2 class="panel-tagline">
                Welcome<br>back.
            </h2>
            <p class="panel-subtext">
                Scan in. Log in. Carry on.<br>
                Your attendance data is waiting.
            </p>

            <div class="stats-strip">
                <div>
                    <p class="stat-value">99%</p>
                    <p class="stat-label">Uptime</p>
                </div>
                <div>
                    <p class="stat-value">&lt;1s</p>
                    <p class="stat-label">Scan Speed</p>
                </div>
                <div>
                    <p class="stat-value">SSL</p>
                    <p class="stat-label">Encrypted</p>
                </div>
            </div>
        </div>

        <svg class="qr-deco" width="100" height="100" viewBox="0 0 120 120" fill="none">
            <rect x="8" y="8" width="34" height="34" rx="4" fill="white" />
            <rect x="14" y="14" width="22" height="22" rx="2" fill="#0f4c81" />
            <rect x="20" y="20" width="10" height="10" rx="1" fill="white" />
            <rect x="78" y="8" width="34" height="34" rx="4" fill="white" />
            <rect x="84" y="14" width="22" height="22" rx="2" fill="#0f4c81" />
            <rect x="90" y="20" width="10" height="10" rx="1" fill="white" />
            <rect x="8" y="78" width="34" height="34" rx="4" fill="white" />
            <rect x="14" y="84" width="22" height="22" rx="2" fill="#0f4c81" />
            <rect x="20" y="90" width="10" height="10" rx="1" fill="white" />
            <rect x="52" y="8" width="10" height="10" rx="1.5" fill="white" />
            <rect x="64" y="20" width="10" height="10" rx="1.5" fill="white" />
            <rect x="52" y="32" width="10" height="10" rx="1.5" fill="white" />
            <rect x="52" y="52" width="10" height="10" rx="1.5" fill="white" />
            <rect x="78" y="52" width="10" height="10" rx="1.5" fill="white" />
            <rect x="64" y="64" width="10" height="10" rx="1.5" fill="white" />
            <rect x="52" y="78" width="10" height="10" rx="1.5" fill="white" />
            <rect x="78" y="78" width="10" height="10" rx="1.5" fill="white" />
        </svg>

        <p class="panel-footer-note">FAST · SECURE · PAPERLESS</p>

    </aside>

    <main class="panel-right">
        <form action="{{ route('login') }}" method="POST" class="form-card">

            <div class="brand mb-8 md:hidden fade-up">
                <div class="brand-icon brand-icon-dark">
                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none">
                        <rect x="1" y="1" width="5" height="5" rx="1" fill="white" />
                        <rect x="8" y="1" width="5" height="5" rx="1" fill="white" />
                        <rect x="1" y="8" width="5" height="5" rx="1" fill="white" />
                        <rect x="8" y="8" width="2" height="2" rx=".5" fill="white" />
                        <rect x="11" y="8" width="2" height="2" rx=".5" fill="white" />
                        <rect x="8" y="11" width="2" height="2" rx=".5" fill="white" />
                        <rect x="11" y="11" width="2" height="2" rx=".5" fill="white" />
                    </svg>
                </div>
                <span class="brand-name">TipsenKuy</span>
            </div>

            <div class="form-heading fade-up d1">
                <h1>Sign in to your account</h1>
                <p>
                    Don't have an account?
                    <a href="{{ route('register') }}">Register here</a>
                </p>
            </div>

            @if ($errors->any())
                <div class="error-msg fade-up d1">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                        style="flex-shrink:0;margin-top:1px;">
                        <circle cx="7" cy="7" r="6" stroke="#b91c1c" stroke-width="1.2" />
                        <path d="M7 4v3M7 9.5v.5" stroke="#b91c1c" stroke-width="1.2" stroke-linecap="round" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="input-group fade-up d2">
                    <label for="email" class="input-label">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="input-field" placeholder="you@example.com" autocomplete="email" required autofocus>
                </div>

                <div class="input-group fade-up d3">
                    <div class="input-row">
                        <label for="password" class="input-label">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" class="input-field"
                        placeholder="••••••••" autocomplete="current-password" required>
                </div>

                <div class="checkbox-wrap fade-up d4 my-3">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="checkbox-label">Keep me signed in</label>
                </div>

                <div class="btn-submit-wrap fade-up d5">
                    <button type="submit" class="btn-primary">
                        Sign In
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3 7h8M8 4l3 3-3 3" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

            </form>

            <div class="divider fade-up" style="animation-delay:0.44s;">
                <span>or continue with</span>
            </div>

            <a href="#" class="btn-social fade-up" style="animation: fadeUp 0.5s 0.48s ease both;">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                        d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"
                        fill="#6b7280" />
                </svg>
                Continue with Google
            </a>

            <p class="back-link-wrap fade-up" style="animation: fadeUp 0.5s 0.52s ease both;">
                <a href="{{ route('home') ?? '/' }}" class="back-link">
                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                        <path d="M9 6H3M5 4L3 6l2 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Back to home
                </a>
            </p>

        </form>
    </main>

</x-layout-main>
