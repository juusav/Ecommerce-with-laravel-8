<div>
    <div class="bg-white rounded-lg shadow-lg mb-4">
        {{-- Target --}}
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">{{$category->name}}</h1>

            <div class="grid-grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer"></i>
                <i class="fas fa-th-list p-3 cursor-pointer"></i>
            </div>
        </div>
    </div>

    {{-- Main --}}
    <div class="grid grid-cols-5">
        {{-- Aside subcategories --}}
        <aside>
            <h2 class="font-semibold text-center mb-2">Subcategorías</h2>
            <ul>
                @foreach ($category->subcategories as $subcategory)
                    <li class="my-2 text-sm">
                        <a class="cursor-pointer hover:text-gray-500 capitalize" 
                            href="">
                            {{$subcategory->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        {{-- Products --}}
        <div class="col-span-4">

            {{-- Paginate --}}
            <div class="mt-4">
                {{$products->links()}}
            </div>

            <ul class="grid grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <li class="bg-white rounded-lg shadow">
                        <article>
                            <figure>
                                <img src="{{ Storage::url($product->images->first()->url) }}" alt="">
                            </figure>

                            <div class="py-4 px-6">
                                <h1 class="text-lg font-semibold">
                                    <a href="">
                                        {{Str::limit($product->name, 20)}}
                                    </a>
                                </h1>
                                <p class="font-bold text-gray-600">{{$product->price}} €</p>
                            </div>
                        </article>
                    </li>                    
                @endforeach
            </ul>

            {{-- Paginate --}}
            <div class="mt-4">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
