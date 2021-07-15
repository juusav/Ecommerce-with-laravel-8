<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="text-lg font-semibold mb-6">Carro de compras</h1>

        @if (Cart::count())
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

                            <td class="text-center">
                                <span>{{$item->price}} €</span>
                                <a class="ml-6 cursor-pointer hover:text-red-700"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-700 opacity-25"
                                    wire:target="delete('{{$item->rowId}}')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    {{-- Al agregar un producto se genera un id para cada uno --}}
                                    {{-- RowId es el nombre que almacena la informacion en un id con numero aleatorio  --}}
                                    @if ($item->options->size)
                                        @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))

                                    @elseif($item->options->color)
                                        @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                        
                                    @else
                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                {{$item->price * $item->qty}} €
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a class="text-sm cursor-pointer hover:underline mt-3 inline-block"
                wire:click="destroy">
                <i class="fas fa-trash"></i>
                Borrar carrito de compras
            </a>

        @else
            <div class="flex flex-col items-center">
                <svg class="ml-4" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                    viewBox="0 0 171 171" style=" fill:#000000;">
                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                        stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                        font-family="none" font-weight="none" font-size="none" text-anchor="none"
                        style="mix-blend-mode: normal">
                        <path d="M0,171.98967v-171.98967h171.98967v171.98967z" fill="none"></path>
                        <g fill="#dddddd">
                            <path
                                d="M49.42969,14.69531c-2.27109,0 -4.00781,1.73672 -4.00781,4.00781c0,2.27109 1.73672,4.00781 4.00781,4.00781h9.35156v9.35156c0,2.27109 1.73672,4.00781 4.00781,4.00781h93.91745c1.73672,0 3.3388,0.80052 4.27396,2.27005c0.93516,1.46953 1.33594,3.20834 0.66797,4.81146l-18.3013,55.03958c-2.00391,6.01172 -7.61536,10.01953 -13.89427,10.01953h-70.67162c-7.34766,0 -13.35937,6.01172 -13.35937,13.35938c0,7.34766 6.01172,13.35938 13.35938,13.35938h50.09766c4.80937,0 8.68359,3.87422 8.68359,8.68359c0,2.27109 1.73672,4.00781 4.00781,4.00781c2.27109,0 4.00781,-1.73672 4.00781,-4.00781c0,-9.21797 -7.48125,-16.69922 -16.69922,-16.69922h-50.09766c-2.93906,0 -5.34375,-2.40469 -5.34375,-5.34375c0,-2.93906 2.40469,-5.34375 5.34375,-5.34375h70.67162c9.75234,0 18.43542,-6.27838 21.50807,-15.49635l18.3013,-55.04219c1.33594,-4.14141 0.67005,-8.55 -1.86823,-12.02344c-2.40469,-3.60703 -6.4125,-5.60989 -10.6875,-5.60989h-89.90964v-9.35156c0,-2.27109 -1.73672,-4.00781 -4.00781,-4.00781zM20.03906,54.77344c-2.27109,0 -4.00781,1.73672 -4.00781,4.00781c0,2.27109 1.73672,4.00781 4.00781,4.00781h26.71875c2.27109,0 4.00781,-1.73672 4.00781,-4.00781c0,-2.27109 -1.73672,-4.00781 -4.00781,-4.00781zM5.34375,81.39304c-0.26719,0 -0.53385,0.03236 -0.80104,0.09915c-0.26719,0 -0.53385,0.13255 -0.80104,0.26614c-0.26719,0.13359 -0.40078,0.26823 -0.66797,0.40182c-0.26719,0.13359 -0.4013,0.26771 -0.5349,0.5349c-0.80156,0.66797 -1.20287,1.7362 -1.20287,2.80495c0,1.06875 0.4013,2.13698 1.20287,2.80495c0.13359,0.26719 0.4013,0.4013 0.5349,0.5349c0.26719,0.13359 0.40078,0.26823 0.66797,0.40182c0.26719,0.13359 0.53385,0.13255 0.80104,0.26614h0.80104c0.26719,0 0.53385,0.00052 0.80104,-0.13307c0.26719,0 0.53385,-0.13516 0.80104,-0.26875c0.26719,-0.13359 0.53438,-0.26562 0.66797,-0.39922c0.26719,-0.13359 0.4013,-0.26771 0.5349,-0.5349c0.80156,-0.53438 1.20287,-1.60313 1.20287,-2.67187c0,-1.06875 -0.4013,-2.13698 -1.20287,-2.80495l-0.5349,-0.5349c-0.26719,-0.13359 -0.40078,-0.26823 -0.66797,-0.40182c-0.26719,-0.13359 -0.53385,-0.13255 -0.80104,-0.26614c-0.26719,-0.0668 -0.53385,-0.09915 -0.80104,-0.09915zM26.71875,81.49219c-2.27109,0 -4.00781,1.73672 -4.00781,4.00781c0,2.27109 1.73672,4.00781 4.00781,4.00781h40.07813c2.27109,0 4.00781,-1.73672 4.00781,-4.00781c0,-2.27109 -1.73672,-4.00781 -4.00781,-4.00781zM58.78125,142.94531c-7.34766,0 -13.35937,6.01172 -13.35937,13.35938c0,7.34766 6.01172,13.35938 13.35938,13.35938c7.34766,0 13.35938,-6.01172 13.35938,-13.35937c0,-7.34766 -6.01172,-13.35937 -13.35937,-13.35937zM105.62256,145.61719c-1.01865,0 -2.02061,0.4013 -2.75537,1.20286c-2.53828,2.53828 -3.87474,5.8776 -3.87474,9.48464c0,7.34766 6.01172,13.35938 13.35938,13.35938c7.34766,0 13.35938,-6.01172 13.35938,-13.35937c0,-2.27109 -1.73672,-4.00781 -4.00781,-4.00781c-2.27109,0 -4.00781,1.73672 -4.00781,4.00781c0,2.93906 -2.40469,5.34375 -5.34375,5.34375c-2.93906,0 -5.34375,-2.40469 -5.34375,-5.34375c0,-1.46953 0.53594,-2.80651 1.60469,-3.74167c1.33594,-1.60312 1.33385,-4.13984 -0.13568,-5.74297c-0.80156,-0.80156 -1.83587,-1.20286 -2.85452,-1.20286zM58.78125,150.96094c2.93906,0 5.34375,2.40469 5.34375,5.34375c0,2.93906 -2.40469,5.34375 -5.34375,5.34375c-2.93906,0 -5.34375,-2.40469 -5.34375,-5.34375c0,-2.93906 2.40469,-5.34375 5.34375,-5.34375z">
                            </path>
                        </g>
                    </g>
                </svg>

                <p class="text-lg text-gray-700 mt-4">Tu carrito de compras esta vacío</p>
                <x-button-enlace class="mt-4 px-16">
                    <a href="/">Ir al inicio</a> 
                </x-button-enlace>
            </div>
        @endif
    </section>

    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg tracking-widest">Total:</span>
                        {{Cart::subTotal()}} €
                    </p>
                </div>

                <div>
                    <x-button-enlace>
                        <a href="{{ route('orders.create') }}">Continuar</a> 
                    </x-button-enlace>
                </div>
            </div>
        </div>
    @endif
</div>