<button
    {{ $attributes->merge(['class' => 'py-2 border border-[#303030] inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md py-1 px-3 bg-zinc-800/40 text-zinc-400 ring-1 ring-inset ring-zinc-800 hover:bg-zinc-800 hover:text-zinc-300']) }}
    type="{{ $type }}">
    {{ $slot }}
</button>
