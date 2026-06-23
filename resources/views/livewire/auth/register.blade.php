<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div class="grid gap-2">
                    <label for="name" class="text-sm font-medium text-zinc-900">{{ __('Name') }}</label>
                    <input
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="{{ __('Full name') }}"
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" />
                    @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIK -->

                <div class="grid gap-2">
                    <label for="nik" class="text-sm font-medium text-zinc-900">
                        NIK
                    </label>
                    <input
                        id="nik"
                        name="nik"
                        value="{{ old('nik') }}"
                        type="text"
                        maxlength="16"
                        required
                        placeholder="Masukkan NIK"
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" />
                    @error('nik')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Jenis Kelamin -->

                <div class="grid gap-2">
                    <label for="jenis_kelamin" class="text-sm font-medium text-zinc-900">
                        Jenis Kelamin
                    </label>


                    <select
                        id="jenis_kelamin"
                        name="jenis_kelamin"
                        required
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>

                    @error('jenis_kelamin')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror


                </div>

                <div class="grid gap-2">
                    <label for="no_hp" class="text-sm font-medium text-zinc-900">
                        Nomor HP
                    </label>


                    <input
                        id="no_hp"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        type="text"
                        required
                        placeholder="08xxxxxxxxxx"
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" />

                    @error('no_hp')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror


                </div>
            </div>

            <div class="grid gap-2">
                <div class="grid gap-2">
                    <label for="alamat" class="text-sm font-medium text-zinc-900">
                        Alamat
                    </label>


                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="3"
                        required
                        placeholder="Masukkan alamat lengkap"
                        class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600">{{ old('alamat') }}</textarea>

                    @error('alamat')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror


                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Email Address -->
                <div class="grid gap-2">
                    <label for="email" class="text-sm font-medium text-zinc-900">{{ __('Email address') }}</label>
                    <input
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" />
                    @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="grid gap-2">
                    <label for="password" class="text-sm font-medium text-zinc-900">{{ __('Password') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="{{ __('Password') }}"
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" />
                    @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="grid gap-2">
                    <label for="password_confirmation" class="text-sm font-medium text-zinc-900">{{ __('Confirm password') }}</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="{{ __('Confirm password') }}"
                        class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm text-zinc-900 shadow-sm outline-none ring-offset-2 focus:ring-2 focus:ring-brand-600" />
                    @error('password_confirmation')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button
                    type="submit"
                    class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-brand-600 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700">
                    {{ __('Create account') }}
                </button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Already have an account?') }}</span>
            <a class="font-medium text-brand-700 hover:underline" href="{{ route('login') }}" wire:navigate>{{ __('Log in') }}</a>
        </div>
    </div>
</x-layouts.auth>