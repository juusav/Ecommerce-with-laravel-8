<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="text-lg font-semibold mb-6">Carro de compras</h1>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th></th>
                    <th>Precio</th>
                    <th>Cant</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach (Cart::content() as $item)
                    <tr>
                        <td>
                            <div class="flex">
                                <img src="{{ $item->options->image }}" alt="" class="h-15 w-20 object-cover mr-4">
                                <div>
                                    <p class="font-bold">{{$item->name}}</p>

                                    @if ($item->options->color)
                                        <span>
                                            Color: {{__($item->options->color)}}
                                        </span>
                                    @endif

                                    @if ($item->options->size)
                                        <span class="mx-1">-</span>
                                        <span>{{ $item->options->size }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td>
                            <span>EUR {{$item->price}}</span>
                            <a href="" class="ml-6 cursor-pointer hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td>

                            {{-- Al agregar un producto se genera un id para cada uno --}}
                            {{-- RowId es el nombre que almacena la informacion en un id con numero aleatorio  --}}
                            @if ($item->options->size)
                                @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))

                            @elseif($item->options->color)
                                @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                
                            @else
                                @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                            @endif
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>