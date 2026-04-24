<div class="flex h-full w-full flex-1 flex-col gap-4">
    <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
        <div class="grid gap-3 md:grid-cols-5">
            <div class="md:col-span-2">
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Search</label>
                <input type="text" wire:model.live.debounce.300ms="search" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" placeholder="Judul / deskripsi / pelapor" />
            </div>

            <div>
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Role</label>
                <select wire:model.live="role" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                    <option value="">Semua</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3 md:col-span-5 md:max-w-md">
                <div>
                    <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Dari</label>
                    <input type="date" wire:model.live="dateFrom" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" />
                </div>
                <div>
                    <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">Sampai</label>
                    <input type="date" wire:model.live="dateTo" class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" />
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 text-sm dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">No</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Nama</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Email</th>
                        <th class="px-4 py-3 text-left font-medium text-neutral-600 dark:text-neutral-300">Role</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-neutral-900 dark:text-white">{{ $user->name }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-xs text-neutral-500">{{ $user->email }}</p>
                        </td>
                        <td class="px-4 py-3 text-neutral-700 dark:text-neutral-200">{{ $user->role }}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-sm text-neutral-600 dark:text-neutral-300">
                            Tidak ada data.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            {{ $users->links() }}
        </div>
    </div>
</div>