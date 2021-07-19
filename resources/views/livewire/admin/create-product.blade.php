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
        </div>
    </div>

    {{-- Product name --}}
    <div class="mb-4">
        <x-jet-label value="Nombre" />
        <x-jet-input type="text" 
            wire:model="name"
            class="w-full" 
            placeholder="Ingrese el nombre del producto" />
    </div>
    {{-- Slug name --}}
    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input type="text" 
            disabled
            wire:model="slug"
            class="w-full bg-gray-200" 
            placeholder="Ingrese el slug del producto" />
    </div>

    {{-- Description --}}
    <div class="mb-4" wire:ignore> {{-- El metodo name está renderizando la página cada vez que surge un cambio y este div se ve afectado. wire:ignore ignora ese proceso --}}

        <x-jet-label value="Descripción" />
        <textarea rows="4" 
            class="w-full form-control"
            x-data
            x-init="ClassicEditorCreate($refs.miEditor)
            .then(function(editor){
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData()) {{-- Livewire tiene .set que cambia el valor del componente de livewire. Para acceder desde JavaScript hay que agregar @this.set. Primer parametro será el description y este se cambiará por lo que se haya escrito en el editor --}}
                })
            })
            .catch( error => {
                console.error( error );
            } );"
            x-ref="miEditor" {{-- Es como un id --}}
            ></textarea>
    </div>
</div>