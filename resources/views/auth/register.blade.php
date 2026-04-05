<x-layout-main title="Register" bodyClass="auth-body auth-body--register">
    <main class="panel-left">
        <form action="{{ route('register') }}" method="POST" class="form-card">

            <div class="brand brand--mb fade-up">
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

            <div class="form-heading form-heading--sm fade-up d1">
                <h1>Create your account</h1>
                <p>
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in</a>
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

            <form method="POST" action="{{ route('register') }}" class="auth-form--register">
                @csrf

                <div class="input-name-row fade-up d2">
                    <div class="input-group">
                        <label for="first_name" class="input-label">First name</label>
                        <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}"
                            class="input-field" placeholder="John" autocomplete="given-name" required autofocus>
                    </div>
                    <div class="input-group">
                        <label for="last_name" class="input-label">Last name</label>
                        <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}"
                            class="input-field" placeholder="Doe" autocomplete="family-name" required>
                    </div>
                </div>

                <div class="input-group fade-up d3">
                    <label for="email" class="input-label">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="input-field"
                        placeholder="you@example.com" autocomplete="email" required>
                </div>

                {{-- <div class="input-group fade-up d3">
                    <label for="role" class="input-label">I am registering as</label>
                    <select id="role" name="role" class="input-field input-field--select" required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select a role…</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin / Organizer
                        </option>
                        <option value="participant" {{ old('role') == 'participant' ? 'selected' : '' }}>Participant /
                            Student</option>
                    </select>
                </div> --}}

                <div class="input-group fade-up d4">
                    <label for="password" class="input-label">Password</label>
                    <input id="password" type="password" name="password" class="input-field"
                        placeholder="Min. 8 characters" autocomplete="new-password" required>
                    <div class="strength-bar" aria-hidden="true">
                        <div class="strength-segment" id="seg1"></div>
                        <div class="strength-segment" id="seg2"></div>
                        <div class="strength-segment" id="seg3"></div>
                        <div class="strength-segment" id="seg4"></div>
                    </div>
                    <p id="strength-label" class="strength-label"></p>
                </div>

                <div class="input-group fade-up d5">
                    <label for="password_confirmation" class="input-label">Confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="input-field" placeholder="Re-enter password" autocomplete="new-password" required>
                </div>

                <div class="checkbox-wrap checkbox-wrap--terms fade-up d6 my-3">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" class="checkbox-label--terms">
                        I agree to the
                        <a href="#">Terms of Service</a>
                        and
                        <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <div class="btn-submit-wrap fade-up d7">
                    <button type="submit" class="btn-primary">
                        Create Account
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3 7h8M8 4l3 3-3 3" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

            </form>

            <p class="back-link-wrap back-link-wrap--sm fade-up" style="animation-delay:0.6s;">
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

    <aside class="panel-right">

        <div class="panel-ring" style="width:300px;height:300px;top:-100px;right:-100px;"></div>
        <div class="panel-ring" style="width:180px;height:180px;top:40px;right:40px;"></div>
        <div class="panel-ring" style="width:460px;height:460px;bottom:-180px;left:-180px;"></div>

        <div class="brand brand--muted relative z-10">
            <svg width="18" height="18" viewBox="0 0 14 14" fill="none">
                <rect x="1" y="1" width="5" height="5" rx="1" fill="var(--color-accent)" />
                <rect x="8" y="1" width="5" height="5" rx="1" fill="var(--color-accent)" />
                <rect x="1" y="8" width="5" height="5" rx="1" fill="var(--color-accent)" />
                <rect x="8" y="8" width="2" height="2" rx=".5" fill="var(--color-accent)" />
                <rect x="11" y="8" width="2" height="2" rx=".5" fill="var(--color-accent)" />
                <rect x="8" y="11" width="2" height="2" rx=".5" fill="var(--color-accent)" />
                <rect x="11" y="11" width="2" height="2" rx=".5" fill="var(--color-accent)" />
            </svg>
        </div>

        <div class="panel-center-content">
            <span class="tag mb-6 w-fit">Get Started</span>
            <h2 class="panel-tagline--dark">
                Join in three<br>simple steps.
            </h2>
            <p class="panel-subtext--dark">
                Set up your account and start managing attendance the smart way.
            </p>

            <div class="step-list">
                <div class="step-item">
                    <div class="step-dot">01</div>
                    <div>
                        <p class="step-title">Create your account</p>
                        <p class="step-desc">Fill in your details and choose your role.</p>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-dot">02</div>
                    <div>
                        <p class="step-title">Set up your session</p>
                        <p class="step-desc">Admins create events; participants join instantly.</p>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-dot">03</div>
                    <div>
                        <p class="step-title">Start tracking</p>
                        <p class="step-desc">Scan, record, and monitor attendance in real-time.</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="panel-footer-note--accent">FAST · SECURE · PAPERLESS</p>

    </aside>

    <script>
        const pw = document.getElementById('password');
        const segs = [1, 2, 3, 4].map(i => document.getElementById('seg' + i));
        const label = document.getElementById('strength-label');
        const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
        const labels = ['Weak', 'Fair', 'Good', 'Strong'];

        pw.addEventListener('input', () => {
            const v = pw.value;
            let score = 0;
            if (v.length >= 8) score++;
            if (/[A-Z]/.test(v)) score++;
            if (/[0-9]/.test(v)) score++;
            if (/[^A-Za-z0-9]/.test(v)) score++;

            segs.forEach((s, i) => {
                s.style.background = i < score ? colors[score - 1] : 'var(--color-border)';
            });
            label.textContent = v.length > 0 ? labels[score - 1] || '' : '';
            label.style.color = score > 0 ? colors[score - 1] : 'var(--color-text-muted)';
        });
    </script>
</x-layout-main>
