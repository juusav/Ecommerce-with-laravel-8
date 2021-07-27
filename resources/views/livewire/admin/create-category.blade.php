<div>
    <x-jet-form-section submit="save">
        <x-slot name="title">
            Crear categoria
        </x-slot>

        <x-slot name="description">
            Completar la información 
        </x-slot>

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
                            <x-jet-checkbox 
                                wire:model.defer="createForm.brands"
                                name="brands[]"
                                value="{{$brand->id}}" />
                            {{$brand->name}}
                        </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="createForm.brands" />
            </div>
            {{-- Image --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Imagen</x-jet-label>
                <input type="file" class="mt-1" accept="image/*" wire:model="createForm.image" id="{{$rand}}"/>

                <x-jet-input-error for="createForm.image" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-button>Crear categoria</x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
