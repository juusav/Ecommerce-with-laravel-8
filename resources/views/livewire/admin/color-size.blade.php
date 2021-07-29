<div class="mt-4">
    <div class="bg-gray-100 shadow-lg rounded-lg p-6">
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

    {{-- Si no hay ningun dato en la tabla esta no se mostrará --}}
    @if ($size_colors->count())    
        <div class="mt-8">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">Color</th>
                        <th class="px-4 py-2 w-1/3">Cantidad</th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($size_colors as $size_color)
                        <tr wire:key="size_color-{{$size_color->pivot->id}}"> {{-- Para no saturar a livewire --}}
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($size_color->pivot->color_id)->name) }}
                            </td>

                            <td class="px-4 py-2">
                                {{ $size_color->pivot->quantity }} Unidades
                            </td>

                            {{-- Update and delete --}}
                            <td class="px-4 py-2 flex">
                                <x-jet-secondary-button 
                                    class="ml-auto mr-2"
                                    wire:click="edit({{ $size_color->pivot->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="edit({{ $size_color->pivot->id }})">
                                    Actualizar
                                </x-jet-secondary-button>

                                <x-jet-danger-button
                                    wire:click="$emit('deleteColorSize', {{ $size_color->pivot->id }})">
                                    Eliminar
                                </x-jet-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Color quantity --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title" >
            Editar colores
        </x-slot>

        <x-slot name="content">
            {{-- Color --}}
            <div class="mb-4">
                <x-jet-label>
                    Color
                </x-jet-label>

                <select class="form-control w-full"
                    wire:model="pivot_color_id">
                    <option value="">Seleccionar color</option>
                    @foreach ($colors as $color)
                        <option value="{{$color->id}}">{{ucfirst(__($color->name))}}</option>
                    @endforeach
                </select>
            </div>
            {{-- Quantity --}}
            <div>
                <x-jet-label>
                    Cantidad
                </x-jet-label>
                <x-jet-input class="w-full" type="number" placeholder="Ingresar cantidad" wire:model="pivot_quantity" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button 
                wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button 
                wire:click="update"
                wire:loading.attr="disabled"
                wire:target="update">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
