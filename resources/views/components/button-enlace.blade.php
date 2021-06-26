@props(['color' => 'red'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center justify-center px-4 py-2 bg-$color-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-$color-500 active:bg-$color-400 focus:outline-none focus:border-$color-300 focus:ring focus:ring-$color-300 disabled:opacity-25 transition"]) }}>
    {{ $slot }}
</button>
