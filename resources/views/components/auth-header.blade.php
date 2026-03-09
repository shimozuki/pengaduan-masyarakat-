@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <h1 class="text-2xl font-semibold tracking-tight text-zinc-900">{{ $title }}</h1>
    <p class="mt-2 text-sm text-zinc-600">{{ $description }}</p>
</div>
