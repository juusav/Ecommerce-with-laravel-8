<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="nombre de contácto" />
                <x-jet-input type="text" placeholder="Ingrese el nombre de la persona que recibirá el producto"
                    class="w-full" />
            </div>

            <div>
                <x-jet-label value="nombre de contácto" />
                <x-jet-input type="text" placeholder="Ingrese el número de teléfono de contácto" class="w-full" />
            </div>
        </div>

        <div>
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>
            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input type="radio" name="envio" class="text-gray-600">
                <span class="ml-2 text-gray-700">Recoger en tienda (calle misteriosa 43, 3 3)</span>
                <span class="font-semibold text-gray-700 ml-auto">Gratis</span>
            </label>

            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>
            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center">
                <input type="radio" name="envio" class="text-gray-600">
                <span class="ml-2 text-gray-700">Entrega a domicilio</span>
            </label>
        </div>

        <div>
            <x-jet-button class="mt-6 mb-4">Continuar con la compra</x-jet-button>
            <hr>
            <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem quasi incidunt deleniti temporibus, provident eos reiciendis repudiandae distinctio sapiente iste, neque optio esse sunt eum quisquam. Sit omnis ea cupiditate? <a href="" class="font-semibold text-gray-500">Políticas y privacidad</a> </p>
        </div>

    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item) 

                    <li class="flex p-2 border-b border-gray-300">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">

                        <article class="flex-1">
                            <h1 class="font-bold">{{$item->name}}</h1>
                            <div class="flex">
                                <p>Cant: {{$item->qty}}</p>
                                @isset($item->options['color']) {{--  Si el parametro está definido se ejecuta la siguiente linea --}}
                                    <p class="mx-2">- Color: {{ __($item->options['color']) }}</p>
                                @endisset
                                @isset($item->options['size'])
                                    <p>{{$item->options['size']}}</p>
                                @endisset
                            </div>
                            <p>EUR: {{$item->price}}</p>
                        </article>
                    </li>
                @empty
                
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tienes ningún item seleccionado
                        </p>
                    </li> 
                @endforelse
            </ul>
            <hr class="mt-4 mb-3">
            <div class="text-gray-700">

                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{Cart::subtotal()}} EUR</span>
                </p>

                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">Gratis</span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    {{Cart::subtotal()}} EUR
                </p>
            </div>
        </div>
    </div>
</div>