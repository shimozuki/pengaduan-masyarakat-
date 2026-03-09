<div class="flex h-full w-full flex-1 flex-col gap-4">
    <div class="rounded-xl border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-neutral-900">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div>
                <p class="text-sm text-neutral-600 dark:text-neutral-300">Laporan #{{ $report->id }}</p>
                <h1 class="mt-1 text-xl font-semibold text-neutral-900 dark:text-white">{{ $report->title }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300">{{ $report->category }} · {{ $report->waktu_pelaporan?->format('d M Y H:i') }}</p>
            </div>

            <form wire:submit="updateStatus" class="flex w-full flex-col gap-3 md:w-[320px]">
                <div>
                    <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Status</label>
                    <select wire:model.defer="status" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                        <option value="pending">pending</option>
                        <option value="in_progress">in_progress</option>
                        <option value="resolved">resolved</option>
                        <option value="rejected">rejected</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-neutral-900 px-4 text-sm font-medium text-white hover:bg-neutral-800" wire:loading.attr="disabled">
                    <span wire:loading.remove>Simpan</span>
                    <span wire:loading>Memproses...</span>
                </button>

                <div class="text-xs text-neutral-500">
                    @if ($report->resolved_at)
                        Resolved at: {{ $report->resolved_at->format('d M Y H:i') }}
                    @endif
                </div>
            </form>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-3">
            <div class="md:col-span-2">
                <h2 class="text-sm font-semibold text-neutral-900 dark:text-white">Deskripsi</h2>
                <p class="mt-2 whitespace-pre-line text-sm text-neutral-700 dark:text-neutral-200">{{ $report->description }}</p>

                @if ($report->location)
                    <h3 class="mt-6 text-sm font-semibold text-neutral-900 dark:text-white">Lokasi</h3>
                    <p class="mt-2 text-sm text-neutral-700 dark:text-neutral-200">{{ $report->location }}</p>
                @endif
            </div>

            <div>
                <h2 class="text-sm font-semibold text-neutral-900 dark:text-white">Pelapor</h2>
                <div class="mt-2 rounded-xl border border-neutral-200 bg-neutral-50 p-4 text-sm dark:border-neutral-700 dark:bg-neutral-800">
                    <p class="font-medium text-neutral-900 dark:text-white">{{ $report->user?->name }}</p>
                    <p class="mt-1 text-neutral-600 dark:text-neutral-300">{{ $report->user?->email }}</p>
                    <p class="mt-3 text-xs text-neutral-500">Priority: {{ $report->priority ?? '-' }}</p>
                </div>

                <h2 class="mt-6 text-sm font-semibold text-neutral-900 dark:text-white">Lampiran</h2>
                <div class="mt-2 grid grid-cols-2 gap-3">
                    @forelse ($report->attachments as $att)
                        <a href="{{ asset('storage/'.$att->path) }}" target="_blank" class="overflow-hidden rounded-xl border border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-800">
                            <img src="{{ asset('storage/'.$att->path) }}" alt="Attachment" class="h-24 w-full object-cover" />
                        </a>
                    @empty
                        <p class="text-sm text-neutral-600 dark:text-neutral-300">Tidak ada lampiran.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.reports.index') }}" class="text-sm font-medium text-neutral-900 underline underline-offset-4 dark:text-white" wire:navigate>
            Kembali
        </a>

        <form method="POST" action="{{ route('admin.reports.export', $report) }}">
            @csrf
            <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-neutral-900 px-4 text-sm font-medium text-white hover:bg-neutral-800">
                Export PDF
            </button>
        </form>
    </div>
</div>
