<div x-data>
    <p class="text-xl text-gray-500">Color: </p>

    <select wire:model="color_id"{{-- variable asignada en componente  --}}
         class="form-control w-full">
        <option value="" selected disabled>Seleccionar color</option>
        @foreach ($colors as $color)
            <option value="{{$color->id}}">{{ __($color->name) }}</option>
        @endforeach
    </select>

    
    <p class="text-gray-500 my-4">
        <span class="font-semibold">En Stock: </span>

        @if ($quantity)
            {{$quantity}}
        @else
            {{$product->stock}}
        @endif

    </p>

    <div class="flex">
        <div class="mr-4">
            <x-button 
                disabled 
                x-bind:disabled="$wire.qty <= 1"{{-- el button se habilita si el número es mayor o igual que uno --}}
                wire:loading.attr="disabled"{{-- Mientras se está cargando el boton estará deshabilitado --}}
                wire:target="decrement"{{-- El boton solo se deshabilita cuando ejecutemos este método  --}}
                wire:click="decrement">{{-- Variable en componente AddCartItem --}}
                -
            </x-button>
            <span class="mx-3 text-gray-700">{{$qty}}</span>
            <x-button 
                x-bind:disabled="$wire.qty >= $wire.quantity"{{-- Se bloquea cuando la cantidad es igual que la cantidad de los productos en stock  --}}
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment">
                +
            </x-button>
        </div>

        <div class="flex-1">
            <x-button 
                x-bind:disabled="!$wire.quantity"{{-- Valor 0 o negativo este boton se bloquea  --}}
                class="full" 
                color="blue"
                x-bind:disabled="$wire.qty > $wire.quantity"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
                Agregar al carrito de compras
            </x-button>
        </div>
    </div>
</div>
