<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Scan QR">

    <x-navbar-auth-user />

    <main class="max-w-md mx-auto px-6 py-10 flex flex-col gap-6">

        {{-- Header --}}
        <section class="text-center">
            <h1 class="text-2xl font-light tracking-tight text-gray-900">
                Scan <span class="font-medium">QR Code</span>
            </h1>
            <p class="text-sm font-light text-gray-400 mt-2 leading-relaxed">
                Arahkan kamera ke QR untuk melakukan absensi
            </p>
        </section>

        {{-- ── STATE: IDLE — Kamera aktif ── --}}
        <section id="state-idle" class="flex flex-col gap-5">

            {{-- Viewfinder --}}
            <div class="relative rounded-2xl overflow-hidden aspect-square w-full border border-gray-200 bg-gray-900">

                {{-- Placeholder saat kamera belum ready --}}
                <div id="camera-placeholder"
                    class="absolute inset-0 flex items-center justify-center flex-col gap-3 opacity-40">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" class="text-white">
                        <rect x="4" y="4" width="12" height="12" rx="2" stroke="currentColor"
                            stroke-width="1.5" />
                        <rect x="24" y="4" width="12" height="12" rx="2" stroke="currentColor"
                            stroke-width="1.5" />
                        <rect x="4" y="24" width="12" height="12" rx="2" stroke="currentColor"
                            stroke-width="1.5" />
                        <path d="M26 26h2M29 26h5M26 29v2M26 32v3M29 35h5M32 29v2M35 29v5" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <p class="text-white text-xs font-light">Memuat kamera...</p>
                </div>

                {{-- html5-qrcode render di sini --}}
                <div id="qr-reader" class="absolute inset-0 w-full h-full"></div>

                {{-- Corner overlay --}}
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
                    <div class="relative w-52 h-52">
                        <span
                            class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-white rounded-tl-lg"></span>
                        <span
                            class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-white rounded-tr-lg"></span>
                        <span
                            class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-white rounded-bl-lg"></span>
                        <span
                            class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-white rounded-br-lg"></span>
                        <span id="scan-line"
                            class="absolute top-0 left-0 right-0 h-px bg-white/60 transition-all duration-1000"></span>
                    </div>
                </div>

                {{-- Vignette --}}
                <div class="absolute inset-0 pointer-events-none z-10"
                    style="background: radial-gradient(ellipse 55% 55% at 50% 50%, transparent 40%, rgba(0,0,0,0.5) 100%);">
                </div>
            </div>

            <p class="text-center text-xs font-light text-gray-400">
                Pastikan QR berada di dalam area bingkai
            </p>
        </section>

        {{-- ── STATE: LOADING ── --}}
        <section id="state-loading" class="hidden flex-col items-center gap-6 py-8">
            <div class="w-16 h-16 rounded-full border-2 border-blue-900 border-t-transparent animate-spin"></div>
            <p class="text-sm font-light text-gray-500">Memverifikasi QR...</p>
        </section>

        {{-- ── STATE: SUCCESS ── --}}
        <section id="state-success" class="hidden flex-col gap-4">

            <div
                class="relative bg-gray-900 rounded-2xl overflow-hidden aspect-square w-full border border-gray-200 flex items-center justify-center">
                <div class="flex flex-col items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-full bg-green-500/20 border border-green-400/40 flex items-center justify-center">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" class="text-green-400">
                            <path d="M5 15l7 7L23 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p class="text-white text-sm font-light tracking-wide">QR terdeteksi</p>
                </div>
            </div>

            <div class="bg-white border border-green-200 rounded-2xl overflow-hidden">
                <div class="h-[3px] bg-green-500"></div>
                <div class="p-5 flex items-start gap-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-green-50 border border-green-200 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" class="text-green-600">
                            <path d="M3 9.5l4.5 4.5L15 5" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">Absensi berhasil</p>
                        <p id="success-sesi" class="text-[0.72rem] font-light text-gray-400 mt-0.5">—</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <svg width="10" height="10" viewBox="0 0 12 12" fill="none" class="text-gray-400">
                                <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                    stroke-width="1.2" />
                                <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                    stroke-linecap="round" />
                            </svg>
                            <span id="success-time" class="text-[0.7rem] font-light text-gray-400">—</span>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('dashboard-user') }}"
                class="w-full flex items-center justify-center py-3 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                Kembali ke Dashboard
            </a>
        </section>

        {{-- ── STATE: ERROR ── --}}
        <section id="state-error" class="hidden flex-col gap-4">

            <div
                class="relative bg-gray-900 rounded-2xl overflow-hidden aspect-square w-full border border-gray-200 flex items-center justify-center">
                <div class="flex flex-col items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-full bg-red-500/20 border border-red-400/40 flex items-center justify-center">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" class="text-red-400">
                            <path d="M7 7l12 12M19 7L7 19" stroke="currentColor" stroke-width="2.2"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                    <p class="text-white/70 text-sm font-light tracking-wide">Scan gagal</p>
                </div>
            </div>

            <div class="bg-white border border-red-200 rounded-2xl overflow-hidden">
                <div class="h-[3px] bg-red-500"></div>
                <div class="p-5 flex items-start gap-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-red-50 border border-red-200 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" class="text-red-500">
                            <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="1.5" />
                            <path d="M9 6v4M9 12v.5" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">QR tidak valid</p>
                        <p id="error-message" class="text-[0.72rem] font-light text-gray-400 mt-0.5">—</p>
                    </div>
                </div>
            </div>

            <button onclick="resetScanner()"
                class="w-full flex items-center justify-center gap-2 py-3 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M2 7a5 5 0 1 1 1.4 3.5" stroke="currentColor" stroke-width="1.3"
                        stroke-linecap="round" />
                    <path d="M2 11V7h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Coba Lagi
            </button>

            <a href="{{ route('dashboard-user') }}"
                class="w-full flex items-center justify-center py-3 border border-gray-200 hover:bg-gray-50 text-sm font-light text-gray-700 rounded-xl transition-all duration-200 no-underline">
                Kembali ke Dashboard
            </a>

            <p class="text-center text-[0.7rem] font-light text-gray-400 leading-relaxed">
                Jika gagal scan, coba arahkan ulang kamera<br>atau minta admin untuk memperbarui QR
            </p>
        </section>

    </main>

    <script>
        const SCAN_URL = "{{ route('scan.process') }}";
        const CSRF = "{{ csrf_token() }}";

        // ── State manager ──
        const states = ['idle', 'loading', 'success', 'error'];

        function showState(name) {
            states.forEach(s => {
                const el = document.getElementById('state-' + s);
                el.classList.add('hidden');
                el.classList.remove('flex');
            });
            const target = document.getElementById('state-' + name);
            target.classList.remove('hidden');
            target.classList.add('flex');
        }

        // ── Scan line animation ──
        let scanLineDir = 1,
            scanLinePos = 0;
        setInterval(() => {
            const line = document.getElementById('scan-line');
            if (!line) return;
            scanLinePos += scanLineDir * 2;
            if (scanLinePos >= 100) scanLineDir = -1;
            if (scanLinePos <= 0) scanLineDir = 1;
            line.style.top = scanLinePos + '%';
        }, 20);

        // ── html5-qrcode setup ──
        let scanner = null;
        let isProcessing = false;

        function startScanner() {
            scanner = new Html5Qrcode("qr-reader");

            const config = {
                fps: 10,
                qrbox: {
                    width: 200,
                    height: 200
                },
                aspectRatio: 1.0,
            };

            scanner.start({
                    facingMode: "environment"
                }, // kamera belakang
                config,
                onScanSuccess,
                () => {} // abaikan error per-frame
            ).then(() => {
                document.getElementById('camera-placeholder').style.display = 'none';
            }).catch(err => {
                console.error('Kamera error:', err);
            });
        }

        async function onScanSuccess(decodedText) {
            if (isProcessing) return;
            isProcessing = true;

            // Hentikan scanner sementara
            if (scanner) await scanner.stop();

            showState('loading');

            // Ekstrak token dari URL atau pakai langsung sebagai token
            let token = decodedText;
            try {
                const url = new URL(decodedText);
                token = url.searchParams.get('token') ?? decodedText;
            } catch (_) {
                // bukan URL, pakai as-is
            }

            try {
                const res = await fetch(SCAN_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        token
                    }),
                });

                const data = await res.json();

                if (data.state === 'success') {
                    document.getElementById('success-sesi').textContent = data.nama_sesi;
                    document.getElementById('success-time').textContent = data.scanned_at;
                    showState('success');
                } else {
                    document.getElementById('error-message').textContent = data.message;
                    showState('error');
                }

            } catch (e) {
                document.getElementById('error-message').textContent = 'Terjadi kesalahan jaringan.';
                showState('error');
            }
        }

        function resetScanner() {
            isProcessing = false;
            showState('idle');
            startScanner();
        }

        window.onload = () => {
            showState('idle');
            startScanner();
        };
    </script>

</x-layout-main>
