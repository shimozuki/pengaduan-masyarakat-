<div class="min-h-screen bg-gradient-to-b from-zinc-50 via-white to-zinc-50">
    <header class="border-b border-zinc-200 bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3 font-semibold" wire:navigate>
                <x-app-logo-icon class="h-9 w-9 fill-current text-zinc-900" />
                <span class="text-lg">Laporin</span>
            </a>

            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('my-reports') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100" wire:navigate>
                        Laporan Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100" wire:navigate>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-brand-600 px-3 py-2 text-sm font-medium text-white hover:bg-brand-700" wire:navigate>
                        Daftar
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-50 via-white to-white"></div>
            <div class="relative mx-auto grid max-w-6xl grid-cols-1 items-center gap-10 px-4 py-14 sm:px-6 md:grid-cols-2 md:py-20">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-medium text-zinc-700">
                        Web pengaduan publik
                    </p>
                    <h1 class="mt-4 text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl">
                        Laporkan masalah di sekitarmu dengan cepat dan rapi.
                    </h1>
                    <p class="mt-4 text-base leading-7 text-zinc-600">
                        Kirim laporan lengkap dengan kategori, lokasi, dan foto. Pantau progresnya langsung dari akunmu.
                    </p>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        @auth
                            <a href="{{ route('reports.create') }}" class="inline-flex h-11 items-center justify-center rounded-lg bg-brand-600 px-5 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                                Laporkan Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex h-11 items-center justify-center rounded-lg bg-brand-600 px-5 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                                Login
                            </a>
                        @endauth
                        <a href="#cara" class="inline-flex h-11 items-center justify-center rounded-lg border border-zinc-200 bg-white px-5 text-sm font-medium text-zinc-900 hover:bg-zinc-50">
                            Cara Kerja
                        </a>
                    </div>

                    <dl class="mt-10 grid grid-cols-3 gap-4">
                        <div class="rounded-xl border border-zinc-200 bg-white p-4">
                            <dt class="text-xs text-zinc-500">Status</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900">Realtime</dd>
                        </div>
                        <div class="rounded-xl border border-zinc-200 bg-white p-4">
                            <dt class="text-xs text-zinc-500">Lampiran</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900">Foto</dd>
                        </div>
                        <div class="rounded-xl border border-zinc-200 bg-white p-4">
                            <dt class="text-xs text-zinc-500">Admin</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900">Kelola</dd>
                        </div>
                    </dl>
                </div>

                <div class="relative">
                    <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-zinc-900">Ringkas & Terstruktur</p>
                            <span class="rounded-full bg-brand-50 px-2 py-1 text-xs font-medium text-brand-700">Aman</span>
                        </div>
                        <div class="mt-4 grid gap-3">
                            <div class="h-10 rounded-xl bg-zinc-100"></div>
                            <div class="h-10 rounded-xl bg-zinc-100"></div>
                            <div class="h-20 rounded-xl bg-zinc-100"></div>
                            <div class="h-10 rounded-xl bg-zinc-100"></div>
                        </div>
                        <p class="mt-4 text-xs text-zinc-500">Form modern dengan validasi dan preview foto.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="cara" class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
            <div class="grid gap-10 md:grid-cols-3">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-500">Cara kerja</p>
                    <h2 class="mt-2 text-2xl font-semibold tracking-tight text-zinc-900">3 langkah sederhana</h2>
                    <p class="mt-3 text-sm leading-6 text-zinc-600">Mulai dari isi form, unggah foto, lalu pantau status hingga selesai.</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-6">
                    <p class="text-sm font-semibold text-zinc-900">1. Tulis laporan</p>
                    <p class="mt-2 text-sm text-zinc-600">Judul, kategori, deskripsi, dan prioritas yang jelas.</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-6">
                    <p class="text-sm font-semibold text-zinc-900">2. Lampirkan bukti</p>
                    <p class="mt-2 text-sm text-zinc-600">Unggah hingga 5 foto (JPG/PNG) untuk memperkuat laporan.</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-6 md:col-start-2">
                    <p class="text-sm font-semibold text-zinc-900">3. Pantau status</p>
                    <p class="mt-2 text-sm text-zinc-600">Admin memproses laporan: pending → in progress → resolved.</p>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-4 pb-6 sm:px-6">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-500">Laporan</p>
                    <h2 class="mt-2 text-2xl font-semibold tracking-tight text-zinc-900">Laporan terbaru</h2>
                    <p class="mt-2 text-sm text-zinc-600">Beberapa laporan yang baru masuk untuk gambaran.</p>
                </div>

                @auth
                    <a href="{{ route('reports.create') }}" class="inline-flex h-10 items-center justify-center rounded-xl bg-brand-600 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                        Buat Laporan
                    </a>
                @endauth
            </div>

            <div class="mt-6 grid gap-4 md:grid-cols-3">
                @forelse (($recentReports ?? []) as $report)
                    @php
                        $status = $report->status;
                        $map = [
                            'pending' => ['Menunggu', 'bg-amber-50 text-amber-700 border-amber-200'],
                            'in_progress' => ['Diproses', 'bg-brand-50 text-brand-700 border-brand-200'],
                            'resolved' => ['Selesai', 'bg-green-50 text-green-700 border-green-200'],
                            'rejected' => ['Ditolak', 'bg-red-50 text-red-700 border-red-200'],
                        ];
                        [$label, $classes] = $map[$status] ?? ['Unknown', 'bg-zinc-50 text-zinc-700 border-zinc-200'];
                    @endphp

                    <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <p class="text-sm font-semibold text-zinc-900 line-clamp-2">{{ $report->title }}</p>
                            <span class="shrink-0 inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $classes }}">{{ $label }}</span>
                        </div>
                        <p class="mt-2 text-sm text-zinc-600">{{ $report->category }} · {{ $report->waktu_pelaporan?->format('d M Y') }}</p>
                        <p class="mt-3 line-clamp-3 text-sm text-zinc-700">{{ \Illuminate\Support\Str::limit($report->description, 140) }}</p>

                        @if ($report->attachment)
                            <div class="mt-4 overflow-hidden rounded-xl border border-zinc-200 bg-zinc-50">
                                <img src="{{ asset('storage/'.$report->attachment) }}" alt="Lampiran" class="h-36 w-full object-cover" loading="lazy" />
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="rounded-2xl border border-zinc-200 bg-white p-6 text-sm text-zinc-600 md:col-span-3">
                        Belum ada laporan.
                    </div>
                @endforelse
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
            <div class="rounded-2xl border border-zinc-200 bg-white p-6">
                <h3 class="text-lg font-semibold text-zinc-900">FAQ</h3>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Apakah laporan bisa anonim?</p>
                        <p class="mt-1 text-sm text-zinc-600">Saat ini laporan terhubung ke akun untuk pelacakan status.</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Berapa maksimal foto?</p>
                        <p class="mt-1 text-sm text-zinc-600">Maksimal 5 foto, masing-masing hingga 5MB.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-10 text-sm text-zinc-600 sm:px-6">
            <p class="font-medium text-zinc-900">Laporin</p>
            <p>© {{ date('Y') }}. Sistem pengaduan publik.</p>
        </div>
    </footer>
</div>
