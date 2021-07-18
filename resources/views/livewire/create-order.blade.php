<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        {{-- Contácto --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de contácto" />
                <x-jet-input type="text" placeholder="Ingrese el nombre de la persona que recibirá el producto"
                    class="w-full" 
                     wire:model.defer="contact"/> {{-- .defer para mandar la informacion HASTA que se accione el boton --}}
                <x-jet-input-error  for="contact" />
            </div>

            <div>
                <x-jet-label value="Teléfono de contácto" />
                <x-jet-input type="text" placeholder="Ingrese el número de teléfono de contácto" 
                    class="w-full" 
                    wire:model.defer="phone"/>
                <x-jet-input-error  for="phone" />
            </div>
        </div>

        {{-- Envíos --}}
        <div x-data="{ envio_type: @entangle('envio_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input type="radio" x-model="envio_type" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">Recoger en tienda (calle misteriosa 43, 3 3)</span>
                <span class="font-semibold text-gray-700 ml-auto">Gratis</span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input type="radio" x-model="envio_type" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">Entrega a domicilio</span>
                </label>

                <div class="hidden" :class="{ 'hidden': envio_type !=2 }">
                    <div class="px-6 pb-6 grid grid-cols-2 gap-6">
                        {{-- Departments --}}
                        <div>
                            <x-jet-label value="Departamento"/>
                            <select class="form-control w-full" wire:model="department_id">
                                <option value="" disabled selected>Selecciona un departamento</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="department_id" />
                        </div>
                    
                        {{-- Cities --}}
                        <div>
                            <x-jet-label value="Ciudad"/>
                            <select class="form-control w-full" wire:model="city_id">
                                <option value="" disabled selected>Selecciona una ciudad</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="city_id" />
                        </div>
                    
                        {{-- Districts --}}
                        <div>
                            <x-jet-label value="Distrito"/>
                            <select class="form-control w-full" wire:model="district_id">
                                <option value="" disabled selected>Selecciona un distrito</option>
                                @foreach ($districts as $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="district_id" />
                        </div>
                    
                        {{-- Dirección --}}
                        <div>
                            <x-jet-label value="Dirección"/>
                            <x-jet-input class="w-full" wire:model="address" type="text"/>
                            <x-jet-input-error for="address"/>
                        </div>
                        {{-- Referencia --}}
                        <div class="col-span-2">
                            <x-jet-label value="Referencia"/>
                            <x-jet-input class="w-full" wire:model="references" type="text"/>
                            <x-jet-input-error for="references" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Continuar con la compra --}}
        <div>
            <x-jet-button 
                wire:loading.attr="disabled"
                wire:target="create_order"
                class="mt-6 mb-4" 
                wire:click="create_order" >
                Continuar con la compra
            </x-jet-button>
            <hr>
            <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem quasi incidunt deleniti temporibus, provident eos reiciendis repudiandae distinctio sapiente iste, neque optio esse sunt eum quisquam. Sit omnis ea cupiditate? <a href="" class="font-semibold text-gray-500">Políticas y privacidad</a> </p>
        </div>
    </div>

    {{-- Productos seleccionados --}}
    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            {{-- Productos seleccionados --}}
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
            {{-- Total --}}
            <div class="text-gray-700">

                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{Cart::subtotal()}} EUR</span>
                </p>

                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            {{$shipping_cost}} EUR
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($envio_type == 1)
                        {{Cart::subtotal()}} EUR
                    @else
                        {{Cart::subtotal() + $shipping_cost }} EUR
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>