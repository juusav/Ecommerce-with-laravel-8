<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">
        {{-- Color --}}
        <div>
            <x-jet-label>
                Color
            </x-jet-label>

            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" 
                            name="color_id"
                            wire:model.defer="color_id"
                            value="{{$color->id}}">
                        <span class="ml-2 text-gray-700 capitalize">{{__($color->name)}}</span>
                    </label>
                @endforeach
            </div>

            <x-jet-input-error for="color_id"/>
        </div>
        {{-- quantity --}}
        <div class="mt-6">
            <x-jet-label>Cantidad</x-jet-label>
            <x-jet-input type="number"
                wire:model.defer="quantity"
                placeholder="Ingresar cantidad"
                class="w-full" />

            <x-jet-input-error for="quantity"/>
        </div>

        {{-- button --}}
        <div class="flex justify-end items-center mt-4">
            <x-jet-action-message class="mr-3" on="saved">
                Agregado
            </x-jet-action-message>

            <x-jet-button 
                wire:loading.attr="disabled"
                wire:target="save"{{-- No interrumpe ningún otro proceso  --}}
                wire:click="save">
                Agregar
            </x-jet-button>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
        <table>
            <thead>
                <tr>
                    <th class="px-4 py-2 w1/3">Color</th>
                    <th class="px-4 py-2 w1/3">Cantidad</th>
                    <th class="px-4 py-2 w1/3"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($product_colors as $product_color)
                    <tr>
                        <td class="capitalize px-4 py-2">
                            {{__($colors->find($product_color->pivot->color_id)->name)}}
                        </td>

                        <td class="px-4 py-2">
                            {{$product_color->pivot->quantity}} Unidades
                        </td>

                        <td class="px-4 py-2 flex">
                            <x-jet-secondary-button class="ml-auto mr-2">
                                Actualizar
                            </x-jet-secondary-button>

                            <x-jet-danger-button>
                            Eliminar
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
