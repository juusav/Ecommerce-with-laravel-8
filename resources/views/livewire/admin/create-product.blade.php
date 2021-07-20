<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Crear un producto</h1>

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Category --}}
        <div>
            <x-jet-label value="Categorías" />
            <select class="w-full form-control" wire:model="category_id">
                <option value="" selected disabled >Seleccionar categoría</option>

                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="category_id" />
        </div>
        {{-- Subcategory --}}
        <div>
            <x-jet-label value="Subcategorías" />
            <select class="w-full form-control" wire:model="subcategory_id">
                <option value="" selected disabled >Seleccionar subcategoría</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>    

            <x-jet-input-error for="subcategory_id" />
        </div>
    </div>

    {{-- Product name --}}
    <div class="mb-4">
        <x-jet-label value="Nombre" />
        <x-jet-input type="text" 
            wire:model="name"
            class="w-full" 
            placeholder="Ingrese el nombre del producto" />

        <x-jet-input-error for="brand" />
    </div>
    {{-- Slug name --}}
    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input type="text" 
            disabled
            wire:model="slug"
            class="w-full bg-gray-200" 
            placeholder="Ingrese el slug del producto" />

        <x-jet-input-error for="slug" />
    </div>

    {{-- Description --}}
    <div class="mb-4">
        {{-- El metodo name está renderizando la página cada vez que surge un cambio y este div se ve afectado. wire:ignore ignora ese proceso --}}
        <div wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea rows="4" 
                class="w-full form-control"
                wire:model="description"
                x-data
                x-init="ClassicEditor.create($refs.miEditor)
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData()) {{-- Livewire tiene .set que cambia el valor del componente de livewire. Para acceder desde JavaScript hay que agregar @this.set. Primer parametro será el description y este se cambiará por lo que se haya escrito en el editor --}}
                    })
                })
                .catch( error => {
                    console.error( error );
                } );"
                x-ref="miEditor" {{-- Es como un id --}}>
            </textarea>
        </div>
        
        <x-jet-input-error for="description" />
    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Brand --}}
        <div>
            <x-jet-label value="Marca" />
            <select class="form-control w-full" wire:model="brand_id">
                <option value="" selected disabled>Seleccionar una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="brand_id" />
        </div>
        {{-- Price --}}
        <div>
            <x-jet-label value="Precio" />
            <x-jet-input type="number" 
                wire:model="price"
                class="w-full" 
                step=".01" />
            <x-jet-input-error for="price" />
        </div>
    </div>

    @if ($subcategory_id)
        @if (!$this->subcategory->color && !$this->subcategory->size)
            <div>
                <x-jet-label value="Cantidad" />
                <x-jet-input type="number" 
                    wire:model="quantity"
                    class="w-full" />
                <x-jet-input-error for="quantity" />
            </div>
        @endif
    @endif

    <div class="flex mt-4">
        <x-jet-button 
            wire:loading.attr="disabled"
            wire:target="save"{{-- No interrumpe ningún otro proceso  --}}
            wire:click="save"
            class="ml-auto">
            Crear producto
        </x-jet-button>
    </div>
</div>