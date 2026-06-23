<div class="flex h-full w-full flex-1 flex-col gap-4">
    <!-- Tabs -->

    <div class="flex items-center gap-2 mb-4">
        <button
            wire:click="$set('tab', 'masyarakat')"
            class="rounded-lg px-4 py-2 text-sm font-medium transition
        {{ $tab === 'masyarakat'
            ? 'bg-white text-black border border-neutral-300 dark:bg-neutral-700 dark:text-white'
            : 'bg-neutral-800 text-white' }}">
            Masyarakat
        </button>

        <button
            wire:click="$set('tab', 'user')"
            class="rounded-lg px-4 py-2 text-sm font-medium transition
    {{ $tab === 'user'
        ? 'bg-white text-black border border-neutral-300 dark:bg-neutral-700 dark:text-white'
        : 'bg-neutral-800 text-white' }}">
            User
        </button>

    </div>

    <!-- Filter -->

    <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
        <div class="grid gap-3 md:grid-cols-5">

            <div class="md:col-span-2">
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">
                    Search
                </label>

                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white"
                    placeholder="Nama / Email" />
            </div>

            @if($tab === 'user')
            <div>
                <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">
                    Role
                </label>

                <select
                    wire:model.live="role"
                    class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white">
                    <option value="">Semua</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            @endif

            <div class="grid grid-cols-2 gap-3 md:col-span-2">
                <div>
                    <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">
                        Dari
                    </label>

                    <input
                        type="date"
                        wire:model.live="dateFrom"
                        class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" />
                </div>

                <div>
                    <label class="text-xs font-medium text-neutral-600 dark:text-neutral-300">
                        Sampai
                    </label>

                    <input
                        type="date"
                        wire:model.live="dateTo"
                        class="mt-1 h-10 w-full rounded-lg border border-neutral-200 bg-white px-3 text-sm text-neutral-900 outline-none focus:ring-2 focus:ring-neutral-900 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white" />
                </div>
            </div>

        </div>

    </div>


    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 text-sm dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        @if($tab === 'masyarakat')
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">NIK</th>
                        <th class="px-4 py-3 text-left">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left">No HP</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        @else
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        @endif
                    </tr>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-3">
                            {{ $loop->iteration }}
                        </td>

                        @if($tab === 'masyarakat')

                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->masyarakat?->nik }}</td>
                        <td class="px-4 py-3">{{ $user->masyarakat?->jenis_kelamin }}</td>
                        <td class="px-4 py-3">{{ $user->masyarakat?->no_hp }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>

                        @else

                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->role }}</td>

                        @endif

                    </tr>

                    @empty
                    <tr>
                        <td colspan="10" class="px-4 py-10 text-center">
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