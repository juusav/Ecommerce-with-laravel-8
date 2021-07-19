<x-app-layout>
    <div class="grid grid-cols-5 gap-6 container py-8">
        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase">
                    <span class="font-semibold">Número de pedido:</span>
                    Pedido-- {{$order->id}}
                </p>
            </div>
        
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg font-semibold uppercase">Envío</p>
        
                        @if ($order->envio_type == 1)
                            <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                            <p class="text-sm">Calle fantasma 12, 8C</p>
                        @else
                            <p class="text-sm">Los productos serán enviados a:</p>
                            <p class="text-sm">{{$order->address}}</p>
                            <p>{{$order->department->name}} - {{$order->city->name}} - {{$order->district->name}}</p>
                        @endif
                    </div>
        
                    <div>
                        <p class="text-lg font-semibold uppercase">Datos de contacto</p>
                        <p class="text-sm">A nombre de: {{$order->contact}}</p>
                        <p class="text-sm">Número: {{$order->phone}}</p>
                    </div>
        
                </div>
            </div>
        
            <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                <p class="text-xl font-semibold mb-4">Resumen de la compra</p>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio</th>
                            <th>Cant</th>
                            <th>Total</th>
                        </tr>
                    </thead>
        
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <img src="{{$item->options->image}}" class="h-15 w-20 object-cover mr-4">
        
                                        <article>
                                            <h1 class="font-bold">{{$item->name}}</h1>
                                            <div class="flex text-xs">
        
                                                @isset($item->options->color)
                                                    Color: {{__($item->options->color)}}    
                                                @endisset
        
                                                @isset($item->options->size)
                                                    - {{$item->options->size}}    
                                                @endisset
                                            </div>
                                        </article>
                                    </div>
                                </td>
        
                                <td class="text-center">
                                    {{$item->price}} EUR
                                </td>
        
                                <td class="text-center">
                                    {{$item->qty}}
                                </td>
        
                                <td class="text-center">
                                    {{$item->price * $item->qty}} EUR
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6 ">
                <div class="flex justify-between items-center">
                    <img src="{{asset('img/payment.png')}}" alt="" class="h-10">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: {{$order->total - $order->shipping_cost}} EUR
                        </p>
                        <p class="text-sm font-semibold">
                            Envio: {{$order->shipping_cost}} EUR
                        </p>
                        <p class="text-lg font-semibold">
                            Total: {{$order->total}} EUR
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>