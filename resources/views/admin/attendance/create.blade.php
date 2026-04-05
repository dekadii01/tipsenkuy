<x-layout-main bodyClass="bg-gray-50 text-gray-900 antialiased min-h-screen" title="Buat Sesi — Admin">

    <x-navbar-admin />

    <main class="max-w-6xl mx-auto py-10 flex flex-col gap-8">


        <section class="flex flex-col gap-2">

            <nav class="flex items-center gap-1.5 flex-wrap">
                <a href="{{ route('dashboard-admin') }}"
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                    Dashboard
                </a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href=""
                    class="text-xs font-light text-gray-400 hover:text-gray-600 transition-colors no-underline">
                    Sesi
                </a>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="text-gray-300">
                    <path d="M3.5 2l3 3-3 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-xs font-light text-gray-500">Buat Sesi</span>
            </nav>

            <h1 class="text-2xl font-light tracking-tight text-gray-900">
                Buat <span class="font-medium">Sesi Baru</span>
            </h1>
            <p class="text-sm font-light text-gray-400">
                Isi informasi berikut untuk membuat sesi absensi baru
            </p>

        </section>


        <section>
            <form method="POST" action="" class="flex flex-col gap-6">
                @csrf

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                    <div class="h-[3px] bg-blue-900"></div>

                    <div class="p-8 flex flex-col gap-6">


                        <div class="flex flex-col gap-2">
                            <label for="nama_sesi" class="text-xs font-normal text-gray-600 tracking-wide">
                                Nama Sesi
                                <span class="text-red-400 ml-0.5">*</span>
                            </label>
                            <input id="nama_sesi" type="text" name="nama_sesi" value="{{ old('nama_sesi') }}"
                                placeholder="Contoh: Kelas Basis Data" autocomplete="off" required
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                            @error('nama_sesi')
                                <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex flex-col gap-2">
                            <label for="deskripsi" class="text-xs font-normal text-gray-600 tracking-wide">
                                Deskripsi
                                <span class="text-[0.65rem] font-light text-gray-400 ml-1">(opsional)</span>
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                placeholder="Tambahkan catatan atau keterangan tambahan untuk sesi ini..."
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-300 focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200 resize-none">{{ old('deskripsi') }}</textarea>
                            <p class="text-[0.7rem] font-light text-gray-400">
                                Deskripsi akan ditampilkan di detail sesi
                            </p>
                            @error('deskripsi')
                                <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="border-t border-gray-100"></div>


                        <div class="flex flex-col gap-2">
                            <label for="tanggal" class="text-xs font-normal text-gray-600 tracking-wide">
                                Tanggal Sesi
                                <span class="text-red-400 ml-0.5">*</span>
                            </label>
                            <input id="tanggal" type="date" name="tanggal"
                                value="{{ old('tanggal', now()->format('Y-m-d')) }}" required
                                class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                            @error('tanggal')
                                <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex flex-col gap-2">
                            <span class="text-xs font-normal text-gray-600 tracking-wide">
                                Waktu Sesi
                                <span class="text-red-400 ml-0.5">*</span>
                            </span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                <div class="flex flex-col gap-1.5">
                                    <label for="jam_mulai" class="text-[0.7rem] font-light text-gray-400">
                                        Jam mulai
                                    </label>
                                    <input id="jam_mulai" type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                        required
                                        class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                                    @error('jam_mulai')
                                        <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    <label for="jam_selesai" class="text-[0.7rem] font-light text-gray-400">
                                        Jam selesai
                                    </label>
                                    <input id="jam_selesai" type="time" name="jam_selesai"
                                        value="{{ old('jam_selesai') }}" required
                                        class="w-full px-4 py-2.5 text-sm font-light text-gray-900 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-300 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200">
                                    @error('jam_selesai')
                                        <p class="text-[0.72rem] font-light text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


                <div class="flex items-start gap-3 px-5 py-4 bg-blue-50 border border-blue-100 rounded-2xl">
                    <div
                        class="w-7 h-7 rounded-lg bg-blue-100 border border-blue-200 flex items-center justify-center shrink-0 mt-0.5">
                        <svg width="13" height="13" viewBox="0 0 14 14" fill="none" class="text-blue-900">
                            <circle cx="7" cy="7" r="5.5" stroke="currentColor"
                                stroke-width="1.3" />
                            <path d="M7 6v4M7 4.5v.5" stroke="currentColor" stroke-width="1.3"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-blue-900">QR dibuat otomatis</p>
                        <p class="text-[0.72rem] font-light text-blue-700 mt-0.5 leading-relaxed">
                            QR Code dapat dibuat secara otomatis di halaman detail sesi setelah berhasil dibuat. Kamu
                            bisa menampilkan dan
                            men-generate ulang QR dari halaman <br> detail sesi.
                        </p>
                    </div>
                </div>


                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2.5">

                    <a href="{{ route('dashboard-admin') }}"
                        class="flex items-center justify-center py-2.5 px-6 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-sm font-light text-gray-600 rounded-xl transition-all duration-200 no-underline">
                        Batal
                    </a>

                    <button type="submit"
                        class="flex items-center justify-center gap-2 py-2.5 px-7 bg-blue-900 hover:bg-blue-950 text-white text-sm font-normal rounded-xl transition-all duration-200 hover:-translate-y-px">
                        <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                            <path d="M2 7h8M7 4l3 3-3 3" stroke="currentColor" stroke-width="1.3"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Buat Sesi
                    </button>

                </div>


            </form>
        </section>


        <footer class="text-center pt-2 pb-4">
            <p class="text-[0.65rem] font-light text-gray-300 tracking-widest">
                &copy; {{ date('Y') }} TipsenKuy · Built with Laravel &amp; Tailwind CSS
            </p>
        </footer>


    </main>

</x-layout-main>
