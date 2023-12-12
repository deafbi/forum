@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-full py-1 px-3 bg-zinc-800/40 text-zinc-400 ring-1 ring-inset ring-zinc-800 hover:bg-zinc-800 hover:text-zinc-300 w-full mt-1 block text-neutral-400 border border-[#303030] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#353535] focus:border-[#353535] sm:text-sm']) !!}>
