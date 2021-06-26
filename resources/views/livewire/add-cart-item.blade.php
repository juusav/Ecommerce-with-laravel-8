<div x-data>{{--  Habilita Alpine --}}

    <p class="text-gray-500 mb-4">
        <span class="font-semibold">En Stock: </span>{{$quantity}}
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
                class="w-full"
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
