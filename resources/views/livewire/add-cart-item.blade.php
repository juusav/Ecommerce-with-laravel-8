<div>
    <div class="flex">
        <div>
            <x-button wire:click="decrement">
                -
            </x-button>
        </div>

        <span class="mx-3 text-gray-700">{{$qty}}</span>

        <div class="mr-4">
            <x-button wire:click="increment">
                +
            </x-button>
        </div>

        <div class="flex-1">
            <x-button class="full" color="blue">
                Agregar al carrito de compras
            </x-button>
        </div>
    </div>
</div>
