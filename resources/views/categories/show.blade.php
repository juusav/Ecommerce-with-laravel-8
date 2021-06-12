<x-app-layout>
    <div class="container py-8">
        <figure class="mb-4">
            <img src="{{ Storage::url($category->image) }}" alt="" class="w-full h-80 object-cover object-center">
        </figure>

        @livewire('category-filter', ['category' => $category])
    </div>
</x-app-layout>