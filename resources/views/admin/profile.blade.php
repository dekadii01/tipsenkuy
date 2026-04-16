<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Profil Admin">

    <x-navbar-admin />

    <main class="max-w-5xl mx-auto px-6 py-10 flex flex-col gap-6">


        <section class="flex flex-col gap-1">
            <h1 class="text-2xl font-light tracking-tight text-gray-900">
                Profil <span class="font-medium">Admin</span>
            </h1>
            <p class="text-sm font-light text-gray-400">
                Kelola informasi akun dan pengaturan sistem
            </p>
        </section>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            <div class="flex flex-col gap-4">

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="h-[3px] bg-blue-900"></div>

                    <div class="p-6 flex flex-col items-center gap-4 text-center">

                        <div
                            class="w-20 h-20 rounded-2xl bg-blue-900 flex items-center justify-center text-2xl font-medium text-white tracking-wide">
                            {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                        </div>

                        <div class="flex flex-col gap-1.5 items-center">
                            <p class="text-base font-medium text-gray-900">
                                {{ auth()->user()->first_name ?? 'Admin' }} {{ auth()->user()->last_name ?? '' }}
                            </p>
                            <p class="text-xs font-light text-gray-400">
                                {{ auth()->user()->email ?? 'admin@example.com' }}
                            </p>
                            <span
                                class="text-[0.65rem] font-light tracking-widest uppercase text-blue-800 bg-blue-50 border border-blue-200 rounded-full px-3 py-1">
                                Administrator
                            </span>
                        </div>

                        <div class="w-full border-t border-gray-100"></div>

                        <div class="w-full grid grid-cols-3 gap-2">
                            <div class="flex flex-col items-center gap-0.5">
                                <p class="text-base font-light text-gray-900">36</p>
                                <p class="text-[0.62rem] font-light text-gray-400 leading-tight text-center">
                                    Total<br>sesi</p>
                            </div>
                            <div class="flex flex-col items-center gap-0.5 border-x border-gray-100">
                                <p class="text-base font-light text-gray-900">142</p>
                                <p class="text-[0.62rem] font-light text-gray-400 leading-tight text-center">
                                    Total<br>peserta</p>
                            </div>
                            <div class="flex flex-col items-center gap-0.5">
                                <p class="text-base font-light text-gray-900">94%</p>
                                <p class="text-[0.62rem] font-light text-gray-400 leading-tight text-center">
                                    Rata-rata<br>hadir</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    @foreach ([['Informasi Pribadi', '#info', true], ['Keamanan', '#security', false], ['Pengaturan Sistem', '#system', false]] as [$label, $href, $active])
                        <a href="{{ $href }}" @class([
                            'flex items-center justify-between px-5 py-3.5 text-sm transition-colors no-underline border-b border-gray-100 last:border-0',
                            'bg-blue-50 text-blue-900 font-normal' => $active,
                            'text-gray-600 font-light hover:bg-gray-50 hover:text-gray-900' => !$active,
                        ])>
                            <span>{{ $label }}</span>
                            @if ($active)
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    class="text-blue-900 shrink-0">
                                    <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @else
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    class="text-gray-300 shrink-0">
                                    <path d="M4 3l3 3-3 3" stroke="currentColor" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @endif
                        </a>
                    @endforeach
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-2">
                    <p class="text-xs font-medium text-gray-500 mb-1">Akun</p>

                    <a href="{{ route('dashboard-admin') }}"
                        class="flex items-center gap-2.5 px-4 py-2.5 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-sm font-light text-gray-600 rounded-xl transition-all duration-200 no-underline">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" class="text-gray-400">
                            <rect x="2" y="2" width="5" height="5" rx="1" stroke="currentColor"
                                stroke-width="1.3" />
                            <rect x="9" y="2" width="5" height="5" rx="1" stroke="currentColor"
                                stroke-width="1.3" />
                            <rect x="2" y="9" width="5" height="5" rx="1" stroke="currentColor"
                                stroke-width="1.3" />
                            <rect x="9" y="9" width="5" height="5" rx="1" stroke="currentColor"
                                stroke-width="1.3" />
                        </svg>
                        Kembali ke Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2.5 px-4 py-2.5 border border-gray-200 hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-sm font-light text-gray-600 rounded-xl transition-all duration-200 group">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                                class="text-gray-400 group-hover:text-red-500 transition-colors">
                                <path d="M6 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3M10 11l4-4-4-4M14 8H6"
                                    stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>

            </div>


            <div class="lg:col-span-2 flex flex-col gap-6">


                <div id="info" class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="h-[3px] bg-blue-900"></div>

                    <div class="px-7 py-5 border-b border-gray-100">
                        <h2 class="text-sm font-medium text-gray-900">Informasi Pribadi</h2>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">Perbarui nama dan informasi dasar akun
                            admin</p>
                    </div>

                    <form method="POST" action="" class="px-7 py-6 flex flex-col gap-5">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="first_name" class="text-xs font-normal text-gray-600 tracking-wide">
                                    Nama depan <span class="text-red-400">*</span>
                                </label>
                                <input id="first_name" type="text" name="first_name"
                                    value="{{ old('first_name', auth()->user()->first_name ?? '') }}"
                                    placeholder="Admin" required
                                    class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                                @error('first_name')
                                    <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="last_name" class="text-xs font-normal text-gray-600 tracking-wide">
                                    Nama belakang
                                </label>
                                <input id="last_name" type="text" name="last_name"
                                    value="{{ old('last_name', auth()->user()->last_name ?? '') }}"
                                    placeholder="Utama"
                                    class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                                @error('last_name')
                                    <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-xs font-normal text-gray-600 tracking-wide">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input id="email" type="email" name="email"
                                value="{{ old('email', auth()->user()->email ?? '') }}"
                                placeholder="admin@example.com" required
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                            @error('email')
                                <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="flex flex-col gap-2">
                            <label for="phone" class="text-xs font-normal text-gray-600 tracking-wide">
                                Nomor telepon
                                <span class="text-[0.65rem] font-light text-gray-400 ml-1">(opsional)</span>
                            </label>
                            <input id="phone" type="tel" name="phone"
                                value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                placeholder="+62 812 3456 7890"
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                            @error('phone')
                                <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        @if (session('status') === 'profile-updated')
                            <div
                                class="flex items-center gap-2 px-4 py-3 bg-green-50 border border-green-200 rounded-xl">
                                <svg width="13" height="13" viewBox="0 0 14 14" fill="none"
                                    class="text-green-600 shrink-0">
                                    <path d="M2.5 7l3.5 3.5 5.5-7" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-xs font-light text-green-700">Profil berhasil diperbarui</p>
                            </div>
                        @endif

                        <div class="flex justify-end pt-1">
                            <button type="submit"
                                class="flex items-center gap-2 px-6 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>


                <div id="security" class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="px-7 py-5 border-b border-gray-100">
                        <h2 class="text-sm font-medium text-gray-900">Keamanan</h2>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">Perbarui password akun administrator
                        </p>
                    </div>

                    <form method="POST" action="" class="px-7 py-6 flex flex-col gap-5">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col gap-2">
                            <label for="current_password" class="text-xs font-normal text-gray-600 tracking-wide">
                                Password saat ini <span class="text-red-400">*</span>
                            </label>
                            <input id="current_password" type="password" name="current_password"
                                placeholder="••••••••" autocomplete="current-password" required
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                            @error('current_password', 'updatePassword')
                                <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="password" class="text-xs font-normal text-gray-600 tracking-wide">
                                    Password baru <span class="text-red-400">*</span>
                                </label>
                                <input id="password" type="password" name="password" placeholder="Min. 8 karakter"
                                    autocomplete="new-password" required
                                    class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                                @error('password', 'updatePassword')
                                    <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="password_confirmation"
                                    class="text-xs font-normal text-gray-600 tracking-wide">
                                    Konfirmasi password <span class="text-red-400">*</span>
                                </label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    placeholder="Ulangi password baru" autocomplete="new-password" required
                                    class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                                @error('password_confirmation', 'updatePassword')
                                    <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @if (session('status') === 'password-updated')
                            <div
                                class="flex items-center gap-2 px-4 py-3 bg-green-50 border border-green-200 rounded-xl">
                                <svg width="13" height="13" viewBox="0 0 14 14" fill="none"
                                    class="text-green-600 shrink-0">
                                    <path d="M2.5 7l3.5 3.5 5.5-7" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-xs font-light text-green-700">Password berhasil diperbarui</p>
                            </div>
                        @endif

                        <div class="flex justify-end pt-1">
                            <button type="submit"
                                class="flex items-center gap-2 px-6 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                Perbarui Password
                            </button>
                        </div>

                    </form>
                </div>


                <div id="system" class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="px-7 py-5 border-b border-gray-100">
                        <h2 class="text-sm font-medium text-gray-900">Pengaturan Sistem</h2>
                        <p class="text-[0.72rem] font-light text-gray-400 mt-0.5">Konfigurasi default perilaku aplikasi
                        </p>
                    </div>

                    <div class="px-7 py-6 flex flex-col gap-6">

                        <div class="flex flex-col gap-2">
                            <label for="default_duration" class="text-xs font-normal text-gray-600 tracking-wide">
                                Durasi QR default
                            </label>
                            <select id="default_duration" name="default_duration"
                                class="w-full sm:w-48 px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 appearance-none cursor-pointer">
                                <option value="5">5 menit</option>
                                <option value="10" selected>10 menit</option>
                                <option value="15">15 menit</option>
                                <option value="30">30 menit</option>
                            </select>
                            <p class="text-[0.7rem] font-light text-gray-400">
                                Akan dipakai sebagai nilai awal saat membuat sesi baru
                            </p>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        @foreach ([['Auto-akhiri sesi', 'Akhiri sesi otomatis setelah jam selesai', 'auto_end', true], ['Notifikasi scan masuk', 'Terima notifikasi setiap peserta berhasil absen', 'notify_scan', false], ['Izinkan scan berulang', 'Peserta dapat scan lebih dari sekali per sesi', 'allow_rescan', false], ['Laporan otomatis', 'Kirim rekap kehadiran setelah sesi berakhir', 'auto_report', true]] as [$title, $desc, $name, $checked])
                            <div
                                class="flex items-start justify-between gap-4 py-3 border-b border-gray-100 last:border-0">
                                <div class="flex flex-col gap-0.5">
                                    <p class="text-sm font-normal text-gray-800">{{ $title }}</p>
                                    <p class="text-[0.72rem] font-light text-gray-400">{{ $desc }}</p>
                                </div>
                                <label class="relative inline-flex items-center shrink-0 cursor-pointer">
                                    <input type="checkbox" name="{{ $name }}" class="sr-only peer"
                                        {{ $checked ? 'checked' : '' }}>
                                    <div
                                        class="w-10 h-5 rounded-full border border-gray-300 bg-gray-100 peer-checked:bg-blue-900 peer-checked:border-blue-900 transition-all duration-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all after:duration-200 peer-checked:after:translate-x-5 after:border after:border-gray-200 peer-checked:after:border-white">
                                    </div>
                                </label>
                            </div>
                        @endforeach

                        <div class="flex justify-end pt-1">
                            <button type="button"
                                class="flex items-center gap-2 px-6 py-2.5 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                                Simpan Pengaturan
                            </button>
                        </div>

                    </div>
                </div>


            </div>
        </div>


        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>


    </main>

</x-layout-main>
