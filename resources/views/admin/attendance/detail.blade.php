<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Detail Sesi — Admin">

    <x-navbar-admin />

    <main class="max-w-6xl mx-auto px-6 py-10 flex flex-col gap-8">

        {{-- ── Breadcrumb & Header ──────────────────────────────────────── --}}
        <section class="flex flex-col gap-3">

            <nav class="flex items-center gap-1.5 flex-wrap">
                <a href="{{ route('dashboard-admin') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                    Dashboard
                </a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="{{ route('admin.attendance.index') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                    Sesi
                </a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-xs font-light text-gray-500">Detail Sesi</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                <div class="flex flex-col gap-2">
                    <h1 class="text-2xl font-light tracking-tight text-gray-900">
                        Kelas <span class="font-medium">{{ $session['nama_sesi'] }}</span>
                    </h1>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex items-center gap-1.5">
                            <svg width="11" height="11" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                                <rect x="1.5" y="2.5" width="9" height="8" rx="1.5" stroke="currentColor"
                                    stroke-width="1.2" />
                                <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" />
                            </svg>
                            <span class="text-xs font-light text-gray-400">{{ $session['tanggal'] }}</span>
                        </div>
                        <span class="text-gray-300 text-xs">·</span>
                        <div class="flex items-center gap-1.5">
                            <svg width="11" height="11" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                                <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                    stroke-width="1.2" />
                                <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" />
                            </svg>
                            <span class="text-xs font-light text-gray-400">
                                {{ $session['jam_mulai'] }} – {{ $session['jam_selesai'] }} WIB
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Status badge --}}
                <div @class([
                    'flex items-center gap-2 px-3 py-1.5 rounded-xl border text-xs font-light self-start shrink-0',
                    'bg-yellow-50 border-yellow-200 text-yellow-700' =>
                        $session->status === 'pending',
                    'bg-green-50  border-green-200  text-green-700' =>
                        $session->status === 'active',
                    'bg-gray-100  border-gray-200   text-gray-500' =>
                        $session->status === 'ended',
                ])>
                    <span @class([
                        'w-1.5 h-1.5 rounded-full',
                        'bg-yellow-400' => $session->status === 'pending',
                        'bg-green-500 animate-pulse' => $session->status === 'active',
                        'bg-gray-400' => $session->status === 'ended',
                    ])></span>
                    @if ($session->status === 'pending')
                        Menunggu
                    @elseif ($session->status === 'active')
                        Sesi Aktif
                    @else
                        Sesi Berakhir
                    @endif
                </div>

            </div>
        </section>

        {{-- ── Flash messages ───────────────────────────────────────────── --}}
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

        @if ($errors->any())
            <div
                class="flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm font-light text-red-700">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" class="shrink-0">
                    <circle cx="7" cy="7" r="6" stroke="currentColor" stroke-width="1.3" />
                    <path d="M7 4.5v3M7 9.5v.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                </svg>
                {{ $errors->first('message') }}
            </div>
        @endif

        {{-- ── Main grid ────────────────────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ═══════════════════════════════════════════════════════════
                 LEFT COLUMN — QR Card
            ════════════════════════════════════════════════════════════ --}}
            <div class="flex flex-col gap-4">
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    {{-- Accent top bar --}}
                    <div class="h-[3px] bg-blue-900"></div>

                    <div class="p-7 flex flex-col gap-6">

                        {{-- Section label + countdown --}}
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-medium text-gray-900">QR Code Sesi</h2>

                            @if ($session->status === 'active' && isset($activeQr))
                                <div class="flex items-center gap-1.5 text-[0.7rem] font-light text-green-600">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                        <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                            stroke-width="1.2" />
                                        <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                    Berlaku hingga
                                    <span id="qr-countdown" class="font-medium"
                                        data-expired="{{ $activeQr->expired_at->toIso8601String() }}">
                                        --:--
                                    </span>
                                </div>
                            @endif
                        </div>



                        {{-- ── A. QR DISPLAY AREA ── --}}
                        {{-- @dd($session->status) --}}
                        @if ($session->status === 'active' && isset($activeQr))

                            {{-- QR aktif --}}
                            <div class="flex flex-col items-center gap-4">
                                <div class="p-5 border border-gray-200 rounded-2xl bg-white">
                                    {!! $qrSvg !!}
                                </div>

                                {{-- Token display --}}
                                <div
                                    class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none"
                                        class="text-gray-400 shrink-0">
                                        <rect x="2" y="5" width="8" height="6" rx="1.5"
                                            stroke="currentColor" stroke-width="1.2" />
                                        <path d="M4 5V3.5a2 2 0 1 1 4 0V5" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" />
                                    </svg>
                                    <span
                                        class="text-[0.7rem] font-light text-gray-500 tracking-widest uppercase">{{ Str::upper(Str::substr($activeQr->token, 0, 8)) }}</span>
                                </div>
                            </div>
                        @else
                            {{-- QR belum dibuat / sesi ended / pending --}}
                            <div
                                class="flex flex-col items-center justify-center gap-4 py-10 border-2 border-dashed border-gray-200 rounded-2xl">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        class="text-gray-300">
                                        <rect x="3" y="3" width="8" height="8" rx="1.5"
                                            stroke="currentColor" stroke-width="1.4" />
                                        <rect x="13" y="3" width="8" height="8" rx="1.5"
                                            stroke="currentColor" stroke-width="1.4" />
                                        <rect x="3" y="13" width="8" height="8" rx="1.5"
                                            stroke="currentColor" stroke-width="1.4" />
                                        <path d="M15 17h2M18 15v2M18 17v2M20 17h-2" stroke="currentColor"
                                            stroke-width="1.4" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    @if ($session->status === 'ended')
                                        <p class="text-sm font-normal text-gray-400">Sesi telah berakhir</p>
                                        <p class="text-[0.72rem] font-light text-gray-300 mt-1">QR tidak dapat
                                            digunakan lagi</p>
                                    @elseif ($session->status === 'pending')
                                        <p class="text-sm font-normal text-gray-400">Sesi belum dimulai</p>
                                        <p class="text-[0.72rem] font-light text-gray-300 mt-1">Tunggu hingga sesi
                                            dimulai</p>
                                    @else
                                        <p class="text-sm font-normal text-gray-400">QR belum dibuat</p>
                                        <p class="text-[0.72rem] font-light text-gray-300 mt-1">Pilih durasi lalu klik
                                            Tampilkan QR</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- ── B. DURATION SELECTOR + ACTIONS ── --}}
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-normal text-gray-600 tracking-wide">Durasi QR</label>

                            <form method="POST"
                                action="{{ route('admin.sessions.generate-qr', ['session' => $session['id']]) }}">
                                @csrf

                                {{-- Segmented pill group --}}
                                <div class="grid grid-cols-4 gap-1.5 p-1 bg-gray-100 rounded-xl" id="duration-group">
                                    @foreach ([['5', '5m'], ['10', '10m'], ['15', '15m'], ['30', '30m']] as [$val, $label])
                                        <label
                                            class="duration-label flex items-center justify-center py-2 rounded-lg text-xs font-normal cursor-pointer transition-all duration-150
                                                   {{ $val === '10' ? 'bg-white border border-gray-200 text-blue-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}"
                                            data-value="{{ $val }}">
                                            <input type="radio" name="durasi_qr" value="{{ $val }}"
                                                class="sr-only" {{ $val === '10' ? 'checked' : '' }}>
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>

                                <p class="text-[0.7rem] font-light text-gray-400 mt-1.5">
                                    QR akan otomatis tidak valid setelah durasi habis
                                </p>

                                {{-- ── C. ACTION BUTTONS ── --}}
                                <div class="flex flex-col gap-2.5 mt-4">

                                    @if ($session->status === 'active')
                                        <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 py-2.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-sm font-light text-gray-700 rounded-xl transition-all duration-200 hover:-translate-y-px">
                                            <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                                                <path d="M2 7a5 5 0 1 1 1.4 3.5" stroke="currentColor"
                                                    stroke-width="1.3" stroke-linecap="round" />
                                                <path d="M2 11V7h4" stroke="currentColor" stroke-width="1.3"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Generate Ulang QR
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px
                                                   {{ $session->status === 'ended' || $session->status === 'pending' ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
                                            {{ $session->status === 'ended' ? 'disabled' : '' }}>
                                            <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                                                <rect x="3" y="3" width="4" height="4" rx="1"
                                                    stroke="currentColor" stroke-width="1.2" />
                                                <rect x="7" y="3" width="4" height="4" rx="1"
                                                    stroke="currentColor" stroke-width="1.2" />
                                                <rect x="3" y="7" width="4" height="4" rx="1"
                                                    stroke="currentColor" stroke-width="1.2" />
                                                <path d="M8 9h1M9.5 7.5v1M9.5 9v1M11 9h-1" stroke="currentColor"
                                                    stroke-width="1.2" stroke-linecap="round" />
                                            </svg>
                                            Tampilkan QR
                                        </button>
                                    @endif

                            </form>{{-- end generate-qr form --}}

                            {{-- Akhiri Sesi — form terpisah --}}
                            @if ($session->status !== 'ended')
                                <form method="POST" action="{{ route('admin.sessions.end', $session['id']) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 py-2.5
                       bg-gray-900 hover:bg-gray-800 text-white text-sm
                       font-normal rounded-xl transition-all duration-200
                       hover:-translate-y-px">
                                        <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                                            <rect x="3" y="3" width="8" height="8" rx="1.5"
                                                stroke="currentColor" stroke-width="1.3" />
                                        </svg>
                                        Akhiri Sesi
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-full flex items-center justify-center py-2.5 bg-gray-100 text-gray-400 text-sm font-normal rounded-xl cursor-not-allowed">
                                    Sesi Telah Berakhir
                                </button>
                            @endif

                        </div>
                    </div>{{-- end flex flex-col gap-2 --}}
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
                 RIGHT COLUMN — Stats + Attendance list
            ════════════════════════════════════════════════════════════ --}}
        <div class="flex flex-col gap-4">

            {{-- Summary strip --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    <p class="text-[1.6rem] font-light leading-none tracking-tight text-gray-900">
                        {{ $allStudent }}
                    </p>
                    <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Total<br>peserta</p>
                    <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full w-full bg-gray-200 rounded-full"></div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    <p class="text-[1.6rem] font-light leading-none tracking-tight text-gray-900">
                        {{ $presentCount }}
                        <span class="text-base text-gray-400 font-light">/ {{ $allStudent }}</span>
                    </p>
                    <p class="text-[0.72rem] font-light text-gray-400 mt-2 leading-snug">Sudah<br>hadir</p>
                    <div class="mt-3 h-[3px] rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full bg-blue-900 rounded-full transition-all duration-500"
                            style="width: {{ $allStudent > 0 ? round(($presentCount / $allStudent) * 100) : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Attendance list --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden flex flex-col flex-1">

                <div class="px-6 pt-5 pb-4 flex items-center justify-between border-b border-gray-100 shrink-0">
                    <div>
                        <h2 class="text-sm font-medium text-gray-900">Peserta Hadir</h2>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">
                            {{ $presentCount }} orang tercatat
                        </p>
                    </div>
                    @if ($session->status === 'active')
                        <span
                            class="text-[0.65rem] font-light tracking-widest uppercase text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-2.5 py-1">
                            Live
                        </span>
                    @endif
                </div>

                {{-- List (scrollable) --}}
                <div class="px-6 overflow-y-auto max-h-96">

                    @forelse ($attendances as $record)
                        <div @class([
                            'flex items-center gap-3.5 py-3',
                            'border-b border-gray-100' => !$loop->last,
                        ])>
                            <div
                                class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[0.65rem] font-medium text-blue-900 shrink-0 tracking-wide">
                                {{ strtoupper(substr($record->user->first_name ?? 'XX', 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-normal text-gray-800 truncate">
                                    {{ $record->user->first_name . ' ' . $record->user->last_name ?? '-' }}
                                </p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="text-[0.7rem] font-light text-gray-400">
                                    {{ \Carbon\Carbon::parse($record->created_at)->format('H:i') }}
                                </span>
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400 shrink-0"></span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center gap-3 py-16 text-center">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    class="text-gray-300">
                                    <circle cx="10" cy="8" r="3.5" stroke="currentColor"
                                        stroke-width="1.4" />
                                    <path d="M3 17c0-3.314 3.134-6 7-6s7 2.686 7 6" stroke="currentColor"
                                        stroke-width="1.4" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-normal text-gray-500">Belum ada peserta yang hadir</p>
                                <p class="text-[0.72rem] font-light text-gray-400 mt-1">Peserta akan muncul setelah
                                    scan QR</p>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>

        </div>

        {{-- Footer --}}
        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>

    </main>

    {{-- ── Scripts ────────────────────────────────────────────────────── --}}
    <script>
        /* ── 1. Segmented duration selector ── */
        document.querySelectorAll('.duration-label').forEach(label => {
            label.addEventListener('click', () => {
                document.querySelectorAll('.duration-label').forEach(l => {
                    l.classList.remove('bg-white', 'border', 'border-gray-200', 'text-blue-900',
                        'shadow-sm');
                    l.classList.add('text-gray-500');
                });
                label.classList.add('bg-white', 'border', 'border-gray-200', 'text-blue-900', 'shadow-sm');
                label.classList.remove('text-gray-500');
            });
        });

        /* ── 2. QR countdown timer ── */
        const countdownEl = document.getElementById('qr-countdown');
        if (countdownEl) {
            const expiredAt = new Date(countdownEl.dataset.expired);

            function updateCountdown() {
                const diff = Math.max(0, Math.floor((expiredAt - Date.now()) / 1000));
                const m = String(Math.floor(diff / 60)).padStart(2, '0');
                const s = String(diff % 60).padStart(2, '0');
                countdownEl.textContent = `${m}:${s}`;

                if (diff <= 0) {
                    countdownEl.textContent = 'Kedaluwarsa';
                    countdownEl.classList.replace('text-green-600', 'text-red-400');
                    clearInterval(timer);
                }
            }

            updateCountdown();
            const timer = setInterval(updateCountdown, 1000);
        }

        /* ── 3. Auto-dismiss flash message ── */
        const flash = document.getElementById('flash-success');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = 'opacity 0.4s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 400);
            }, 3000);
        }
    </script>

</x-layout-main>
