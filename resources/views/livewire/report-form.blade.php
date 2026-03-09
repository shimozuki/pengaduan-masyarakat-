<form wire:submit="submit" class="space-y-4">
    <div class="grid gap-2">
        <label class="text-sm font-medium text-zinc-900" for="title">Judul</label>
        <input id="title" type="text" wire:model.defer="title" class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-zinc-900" placeholder="Contoh: Jalan berlubang di depan sekolah" />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-2">
        <label class="text-sm font-medium text-zinc-900" for="category">Kategori</label>
        <select id="category" wire:model.defer="category" class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-zinc-900">
            <option value="">Pilih kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
        </select>
        @error('category')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-2">
        <label class="text-sm font-medium text-zinc-900" for="priority">Prioritas</label>
        <select id="priority" wire:model.defer="priority" class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-zinc-900">
            <option value="low">Rendah</option>
            <option value="normal">Normal</option>
            <option value="high">Tinggi</option>
        </select>
        @error('priority')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-2">
        <label class="text-sm font-medium text-zinc-900" for="location">Lokasi (opsional)</label>
        <input id="location" type="text" wire:model.defer="location" class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-zinc-900" placeholder="Contoh: Jl. Merdeka, RT 02" />
        @error('location')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-2">
        <label class="text-sm font-medium text-zinc-900" for="description">Deskripsi</label>
        <textarea id="description" wire:model.defer="description" rows="5" class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm outline-none ring-offset-2 focus:ring-2 focus:ring-zinc-900" placeholder="Jelaskan kronologi dan detail masalah..."></textarea>
        @error('description')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-2">
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-zinc-900" for="attachments">Foto (maks. 5)</label>
            <span class="text-xs text-zinc-500">JPG/PNG, maks 5MB per file</span>
        </div>
        <input id="attachments" type="file" wire:model="attachments" multiple accept="image/png,image/jpeg" class="block w-full text-sm text-zinc-700 file:mr-4 file:rounded-lg file:border-0 file:bg-zinc-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-zinc-800" />
        @error('attachments')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('attachments.*')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if ($attachments)
            <div class="grid grid-cols-3 gap-3 pt-2">
                @foreach ($attachments as $photo)
                    <div class="overflow-hidden rounded-xl border border-zinc-200 bg-zinc-50">
                        <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="h-24 w-full object-cover" />
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <button type="submit" wire:loading.attr="disabled" class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-zinc-900 px-4 text-sm font-medium text-white shadow-sm hover:bg-zinc-800 disabled:opacity-60">
        <span wire:loading.remove>Kirim Laporan</span>
        <span wire:loading>Mengirim...</span>
    </button>
</form>
