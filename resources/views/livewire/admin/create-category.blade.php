<div>
    <x-jet-form-section submit="save">
        <x-slot name="title">
            Crear categoria
        </x-slot>

        <x-slot name="description">
            Completar la información 
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Slug</x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Ícono</x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Marcas</x-jet-label>

                <div class="grid grid-cols-4">
                    @foreach ($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox />
                            {{$brand->name}}
                        </x-jet-label>
                    @endforeach
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>Imagen</x-jet-label>
                <x-jet-input type="file" class="mt-1" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-button>Crear categoria</x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
