<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos
            </h2>
            
            <x-button class="ml-auto">
                <a href="{{route('admin.products.create')}}">Agregar producto</a> 
            </x-button>
        </div>
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container py-12">
        <x-table-responsive>

            <div class="px-6 py-4">
                <x-jet-input 
                    type="text" 
                    placeholder="Ingresar el nombre del producto" 
                    class="w-full"
                    wire:model="search" />
            </div>

            @if ($products->count())    
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoría
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)

                        <tr>
                            {{-- Name --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">

                                        @if ($product->images->count())
                                            <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{Storage::url($product->images->first()->url)}}" alt="">
                                        @else
                                            <img class="h-10 w-10 rounded-full object-cover"
                                            src="https://phantom-marca.unidadeditorial.es/252acdd64f48851f815c16049a789f23/resize/1320/f/jpg/assets/multimedia/imagenes/2021/04/19/16188479459744.jpg" alt="">
                                        @endif
                                    </div>
                                    
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$product->name}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            {{-- category --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{$product->subcategory->category->name}}
                                </div>
                            </td>
                            {{-- Status --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($product->status)
                                @case(1)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Borrador
                                    </span>
                                @break
                                @case(2)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Publicado
                                    </span>
                                @break
                                @default

                                @endswitch
                            </td>
                            {{-- Price --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{$product->price}} €
                            </td>
                            {{-- Edit --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ Route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No existe ningún registro
                </div>
            @endif

            @if ($products->hasPages())
                <div class="px-6 py-4">
                    {{$products->links()}}
                </div>
            @endif

        </x-table-responsive>

    </div>

</div>