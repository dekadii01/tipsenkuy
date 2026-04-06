<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Semua Sesi — Admin">

    <x-navbar-admin />

    <main class="max-w-6xl mx-auto px-6 py-10 flex flex-col gap-8">


        <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-light tracking-tight text-gray-900">
                    Semua <span class="font-medium">Sesi</span>
                </h1>
                <p class="text-sm font-light text-gray-400 mt-1">
                    Kelola seluruh sesi absensi
                </p>
            </div>
            <a href="{{ route('admin.attendance.create') }}"
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline self-start sm:self-auto shrink-0">
                <svg width="13" height="13" viewBox="0 0 12 12" fill="none">
                    <path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                </svg>
                Buat Sesi
            </a>
        </section>


        <section class="flex flex-col sm:flex-row gap-3">

            <form class="relative flex-1" action="" method="GET">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" class="text-gray-400">
                        <circle cx="6" cy="6" r="4" stroke="currentColor" stroke-width="1.3" />
                        <path d="M10 10l2 2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                    </svg>
                </div>
                <input type="text" name="search" placeholder="Cari nama sesi..."
                    class="w-full pl-9 pr-4 py-2.5 text-sm font-light text-gray-900 bg-white border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:ring-2 focus:ring-blue-100 transition-all duration-200">
            </form>

            <div class="flex items-center gap-1.5 p-1 bg-white border border-gray-200 rounded-xl shrink-0">
                @foreach ([['all', 'Semua', true], ['aktif', 'Aktif', false], ['selesai', 'Selesai', false], ['hari-ini', 'Hari ini', false]] as [$val, $label, $active])
                    <a href="{{ request()->fullUrlWithQuery(['filter' => $val]) }}" @class([
                        'px-3 py-1.5 rounded-lg text-xs font-normal transition-all duration-150 no-underline',
                        'bg-blue-900 text-white' => $active,
                        'text-gray-500 hover:text-gray-800' => !$active,
                    ])>
                        {{ $label }}
                    </a>
                @endforeach
            </div>

        </section>


        <section class="flex flex-col gap-4">

            <p class="text-[0.72rem] font-light text-gray-400">
                Menampilkan <span class="font-medium text-gray-600">8</span> sesi
            </p>

            @foreach ($sessions as $session)
                <div
                    class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:border-gray-300 transition-colors">
                    <div class="flex">

                        <div @class([
                            'w-[3px] shrink-0',
                            'bg-green-500' => $session['status'] === 'active',
                            'bg-yellow-400' => $session['status'] === 'pending',
                            'bg-gray-200' => $session['status'] === 'ended',
                        ])></div>

                        <div class="flex-1 px-5 py-4 flex flex-col sm:flex-row sm:items-center gap-4">

                            <div class="flex-1 min-w-0 flex flex-col gap-1.5">

                                <div class="flex items-center gap-2.5 flex-wrap">
                                    <p class="text-sm font-medium text-gray-900">{{ $session['nama_sesi'] }}</p>

                                    <div @class([
                                        'flex items-center gap-1.5 px-2 py-0.5 rounded-full border text-[0.65rem] font-light',
                                        'bg-green-50  border-green-200  text-green-700' =>
                                            $session['status'] === 'active',
                                        'bg-yellow-50 border-yellow-200 text-yellow-700' =>
                                            $session['status'] === 'pending',
                                        'bg-gray-100  border-gray-200   text-gray-400' =>
                                            $session['status'] === 'ended',
                                    ])>
                                        <span @class([
                                            'w-1 h-1 rounded-full',
                                            'bg-green-500 animate-pulse' => $session['status'] === 'active',
                                            'bg-yellow-400' => $session['status'] === 'pending',
                                            'bg-gray-400' => $session['status'] === 'ended',
                                        ])></span>
                                        @if ($session['status'] === 'active')
                                            Aktif
                                        @elseif ($session['status'] === 'pending')
                                            Menunggu
                                        @else
                                            Selesai
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    <div class="flex items-center gap-1">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <rect x="1.5" y="2.5" width="9" height="8" rx="1.5"
                                                stroke="currentColor" stroke-width="1.2" />
                                            <path d="M4 1.5v2M8 1.5v2M1.5 5.5h9" stroke="currentColor"
                                                stroke-width="1.2" stroke-linecap="round" />
                                        </svg>
                                        <span
                                            class="text-[0.72rem] font-light text-gray-400">{{ $session['tanggal'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <circle cx="6" cy="6" r="4.5" stroke="currentColor"
                                                stroke-width="1.2" />
                                            <path d="M6 3.5v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span
                                            class="text-[0.72rem] font-light text-gray-400">{{ $session['jam_mulai'] }}
                                            WIB</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none"
                                            class="text-gray-400">
                                            <circle cx="6" cy="4" r="2" stroke="currentColor"
                                                stroke-width="1.2" />
                                            <path d="M2 10c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke="currentColor"
                                                stroke-width="1.2" stroke-linecap="round" />
                                        </svg>
                                        <span class="text-[0.72rem] font-light text-gray-400">
                                            <span class="font-medium text-gray-600">{{ $session['present'] }}</span> /
                                            {{ $session['total'] }} hadir
                                        </span>
                                    </div>
                                </div>

                                <div class="w-full sm:w-48 h-[3px] rounded-full bg-gray-100 overflow-hidden mt-0.5">
                                    <div @class([
                                        'h-full rounded-full',
                                        'bg-blue-900' => $session['status'] === 'active',
                                        'bg-gray-300' => $session['status'] !== 'active',
                                    ])
                                        style="width: {{ $session['total'] > 0 ? round(($session['present'] / $session['total']) * 100) : 0 }}%">
                                    </div>
                                </div>

                            </div>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 shrink-0">

                                @if ($session['status'] === 'pending')
                                    <form method="POST" action="">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-900 hover:bg-blue-950 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                            <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                                <path d="M3 2.5l7 3.5-7 3.5V2.5z" fill="currentColor" />
                                            </svg>
                                            Mulai Sesi
                                        </button>
                                    </form>
                                @elseif ($session['status'] === 'active')
                                    <form method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-xs font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                            <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                                <rect x="2.5" y="2.5" width="7" height="7" rx="1.5"
                                                    fill="currentColor" />
                                            </svg>
                                            Akhiri Sesi
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.attendance.detail', $session['id']) }}"
                                    class="flex items-center justify-center gap-1.5 px-4 py-2 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-xs font-light text-gray-600 rounded-xl transition-all duration-200 no-underline">
                                    Detail
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                                        <path d="M3 6h6M7 4l2 2-2 2" stroke="currentColor" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach


            {{-- ── EMPTY STATE — uncomment when list is empty ── --}}
            {{--
            <div class="flex flex-col items-center justify-center gap-5 py-24 text-center">
                <div class="w-16 h-16 rounded-2xl bg-white border border-gray-200 flex items-center justify-center">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" class="text-gray-300">
                        <rect x="3" y="3" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.4" />
                        <rect x="13" y="3" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.4" />
                        <rect x="3" y="13" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.4" />
                        <path d="M16 17h2M18 15v2M18 17v2M20 17h-2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Belum ada sesi</p>
                    <p class="text-[0.75rem] font-light text-gray-400 mt-1">Mulai dengan membuat sesi baru</p>
                </div>
                <a href="{{ route('admin.sessions.create') }}"
                    class="flex items-center gap-2 px-5 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px no-underline">
                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none">
                        <path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                    </svg>
                    Buat Sesi
                </a>
            </div>
            --}}

        </section>


        <section class="flex items-center justify-between flex-wrap gap-4">

            <p class="text-[0.72rem] font-light text-gray-400">
                Halaman <span class="font-medium text-gray-600">1</span> dari <span
                    class="font-medium text-gray-600">3</span>
            </p>

            <div class="flex items-center gap-1.5">
                <a href="#"
                    class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M8 3L5 6l3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>

                @foreach ([1, 2, 3] as $page)
                    <a href="#" @class([
                        'flex items-center justify-center w-8 h-8 rounded-lg text-xs font-normal transition-colors no-underline',
                        'bg-blue-900 text-white border border-blue-900' => $page === 1,
                        'border border-gray-200 text-gray-500 hover:bg-gray-50 hover:border-gray-300' =>
                            $page !== 1,
                    ])>
                        {{ $page }}
                    </a>
                @endforeach

                <a href="#"
                    class="flex items-center justify-center w-8 h-8 border border-gray-200 rounded-lg text-gray-400 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-600 transition-colors no-underline">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

        </section>


        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>


    </main>

</x-layout-main>
