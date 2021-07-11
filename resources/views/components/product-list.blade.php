@props(['product'])
<li class="bg-white rounded-lg shadow mb-4">
    <article class="flex">
        <figure>
            <img class="h-48 w-56 object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
        </figure>

        <div class="flex-1 py-4 px-6 flex flex-col">
            <div class="flex justify-between">
                <div>
                    <a href="{{route('products.show', $product)}}">
                        <h1 class="text-lg font-semibold text-gray-700">{{$product->name}}</h1>
                    </a>
                    <p class="font-bold text-gray-700">{{ $product->price }} €</p>
                </div>
            </div>
            
            <div class="mt-auto mb-8">
                <x-product-link-list href="{{ route('products.show', $product) }}">
                    Más información
                </x-product-link-list>
            </div>
        </div>
    </article>
</li>
