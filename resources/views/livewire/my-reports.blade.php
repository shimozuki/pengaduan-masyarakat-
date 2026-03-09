<div class="min-h-screen bg-gradient-to-b from-zinc-50 via-white to-zinc-50">
    <header class="border-b border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3 font-semibold" wire:navigate>
                <x-app-logo-icon class="h-9 w-9 fill-current text-zinc-900" />
                <span class="text-lg">Laporin</span>
            </a>

            <nav class="flex items-center gap-3">
                <a href="{{ route('reports.create') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100" wire:navigate>Buat Laporan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100">Keluar</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-zinc-900">Laporan Saya</h1>
                <p class="mt-1 text-sm text-zinc-600">Pantau status laporan yang sudah kamu kirim.</p>
            </div>
            <a href="{{ route('reports.create') }}" class="inline-flex h-10 items-center justify-center rounded-xl bg-brand-600 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                Laporkan Baru
            </a>
        </div>

        @if (session('status'))
            <div class="mt-6 rounded-2xl border border-brand-200 bg-brand-50 px-4 py-3 text-sm text-brand-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-8 overflow-hidden rounded-2xl border border-zinc-200/70 bg-white shadow-sm">
            <div class="divide-y divide-zinc-200/70">
                @forelse ($reports as $report)
                    <div class="p-5">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div class="flex gap-4">
                                @if ($report->attachment)
                                    <div class="hidden sm:block">
                                        <div class="h-16 w-16 overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50">
                                            <img src="{{ asset('storage/'.$report->attachment) }}" alt="Lampiran" class="h-full w-full object-cover" />
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <p class="text-sm font-semibold text-zinc-900">{{ $report->title }}</p>
                                    <p class="mt-1 text-sm text-zinc-600">{{ $report->category }} · {{ $report->waktu_pelaporan?->format('d M Y H:i') }}</p>
                                    <p class="mt-3 line-clamp-3 text-sm text-zinc-700">{{ $report->description }}</p>

                                    @if ($report->attachment)
                                        <div class="mt-3">
                                            <a class="inline-flex items-center rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm font-medium text-zinc-900 hover:bg-zinc-50" href="{{ asset('storage/'.$report->attachment) }}" target="_blank">
                                                Lihat lampiran
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
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
                                <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $classes }}">{{ $label }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="text-sm font-semibold text-zinc-900">Belum ada laporan</p>
                        <p class="mt-1 text-sm text-zinc-600">Mulai buat laporan pertama kamu agar bisa dipantau statusnya.</p>
                        <div class="mt-5">
                            <a href="{{ route('reports.create') }}" class="inline-flex h-10 items-center justify-center rounded-xl bg-brand-600 px-5 text-sm font-medium text-white shadow-sm hover:bg-brand-700" wire:navigate>
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="border-t border-zinc-200/70 bg-white p-4">
                {{ $reports->links() }}
            </div>
        </div>
    </main>
</div>
