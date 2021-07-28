<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear categoria
        </x-slot>

        <x-slot name="description"></x-slot>

        <x-slot name="form">
            {{-- Name --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" wire:model="createForm.name" />

                <x-jet-input-error for="createForm.name" />
            </div>
            {{-- Slug --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Slug</x-jet-label>
                <x-jet-input disabled type="text" class="w-full mt-1 bg-gray-100" wire:model="createForm.slug" />

                <x-jet-input-error for="createForm.slug" />
            </div>
            {{-- Brands --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Marcas</x-jet-label>

                <div class="grid grid-cols-4">
                    @foreach ($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox wire:model.defer="createForm.brands" name="brands[]"
                                value="{{ $brand->id }}" />
                            {{ $brand->name }}
                        </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="createForm.brands" />
            </div>
            {{-- Image --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Imagen</x-jet-label>
                <input type="file" class="mt-1" accept="image/*" wire:model="createForm.image"
                    id="{{ $rand }}" />

                <x-jet-input-error for="createForm.image" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">Categoría creada</x-jet-action-message>
            <x-jet-button>Crear categoria</x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-action-section>
        <x-slot name="title">
            Lista de categorías
        </x-slot>

        <x-slot name="description"></x-slot>

        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span class="uppercase">{{ $category->name }}</span>
                            </td>

                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer"
                                        wire:click="edit('{{ $category->slug }}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer"
                                        wire:click="$emit('deleteCategory', '{{ $category->slug }}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>

    <x-jet-dialog-model wire:model="editForm.open">
        <x-slot name="title">
            Editar categoría
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                {{-- Name --}}
                <div>
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type="text" class="w-full mt-1" wire:model="editForm.name" />
                
                    <x-jet-input-error for="editForm.name" />
                </div>
                {{-- Slug --}}
                <div>
                    <x-jet-label>Slug</x-jet-label>
                    <x-jet-input disabled type="text" class="w-full mt-1 bg-gray-100" wire:model="editForm.slug" />
                
                    <x-jet-input-error for="editForm.slug" />
                </div>
                {{-- Brands --}}
                <div>
                    <x-jet-label>Marcas</x-jet-label>
                
                    <div class="grid grid-cols-4">
                        @foreach ($brands as $brand)
                            <x-jet-label>
                                <x-jet-checkbox wire:model.defer="editForm.brands" name="brands[]"
                                    value="{{ $brand->id }}" />
                                {{ $brand->name }}
                            </x-jet-label>
                        @endforeach
                    </div>
                    <x-jet-input-error for="editForm.brands" />
                </div>
                {{-- Image --}}
                <div>
                    <x-jet-label>Imagen</x-jet-label>
                    <input type="file" class="mt-1" accept="image/*" wire:model="editImage"
                        id="{{ $rand }}" />
                
                    <x-jet-input-error for="editImage" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-model>
</div>
