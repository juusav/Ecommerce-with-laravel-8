<div>

    {{-- button to delete product --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>

                <x-jet-danger-button wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">Editar producto</h1>

        {{-- upload new images --}}
        <div class="mb-4" wire:ignore>
            <form action="{{route('admin.products.files', $product)}}"
                method="POST"
                class="dropzone"
                id="my-awesome-dropzone"></form>
        </div>

        {{-- Imagenes --}}
        @if ($product->images->count())

            <section class="bg-white shadow-lg rounded-lg p-6 mb-4">
                <ul class="flex flex-wrap">
                    
                    @foreach ($product->images as $image)

                        <li class="relative" wire:key="image-{{$image->id}}">
                            <img src="{{Storage::url($image->url)}}" alt="" class="w-32 h-20 object-cover">

                            <x-jet-danger-button class="absolute right-2 top-2"
                                wire:click="deleteImage({{$image->id}})"
                                wire:loading.attr="disabled"
                                wire:target="deleteImage({{$image->id}})">
                                x
                            </x-jet-danger-button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        @livewire('admin.status-product', ['product' => $product], key('status-product' . $product->id))

        <div class="bg-white shadow-xl rounded-lg p-6">
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
                    <select class="w-full form-control" wire:model="product.subcategory_id">
                        <option value="" selected disabled >Seleccionar subcategoría</option>

                        @foreach ($subcategories as $subcategory)
                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                        @endforeach
                    </select>    

                    <x-jet-input-error for="product.subcategory_id" />
                </div>
            </div>

            {{-- Product name --}}
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" 
                    wire:model="product.name"
                    class="w-full" 
                    placeholder="Ingrese el nombre del producto" />

                <x-jet-input-error for="product.brand" />
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
                        wire:model="product.description"
                        x-data
                        x-init="ClassicEditor.create($refs.miEditor)
                        .then(function(editor){
                            editor.model.document.on('change:data', () => {
                                @this.set('product.description', editor.getData()) {{-- Livewire tiene .set que cambia el valor del componente de livewire. Para acceder desde JavaScript hay que agregar @this.set. Primer parametro será el description y este se cambiará por lo que se haya escrito en el editor --}}
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );"
                        x-ref="miEditor" {{-- Es como un id --}}>
                    </textarea>
                </div>
                
                <x-jet-input-error for="product.description" />
            </div>

            <div class="grid grid-cols-2 gap-6 mb-4">
                {{-- Brand --}}
                <div>
                    <x-jet-label value="Marca" />
                    <select class="form-control w-full" wire:model="product.brand_id">
                        <option value="" selected disabled>Seleccionar una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.brand_id" />
                </div>
                {{-- Price --}}
                <div>
                    <x-jet-label value="Precio" />
                    <x-jet-input type="number" 
                        wire:model="product.price"
                        class="w-full" 
                        step=".01" />
                    <x-jet-input-error for="product.price" />
                </div>
            </div>

            @if ($this->subcategory)

                @if (!$this->subcategory->color && !$this->subcategory->size)
                    <div>
                        <x-jet-label value="Cantidad" />
                        <x-jet-input type="number" 
                            wire:model="product.quantity"
                            class="w-full" />
                        <x-jet-input-error for="product.quantity" />
                    </div>
                @endif
            @endif
            
            {{-- update product button --}}
            <div class="flex justify-end items-center mt-4">
                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado
                </x-jet-action-message>

                <x-jet-button 
                    wire:loading.attr="disabled"
                    wire:target="save"{{-- No interrumpe ningún otro proceso  --}}
                    wire:click="save">
                    Actualizar producto
                </x-jet-button>
            </div>
        </div>

        {{-- size and colors options --}}
        @if ($this->subcategory)
            @if ($this->subcategory->size)
                @livewire('admin.size-product', ['product' => $product], key('admin.size-product' . $product->id))
            @elseif($this->subcategory->color)
                @livewire('admin.color-product', ['product' => $product], key('admin.color-product' . $product->id))
            @endif
        @endif
    </div>

    {{-- Dropzone images up --}}
    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'x-CSRF-TOKEN' : "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastra una imagen",
                acceptedFiles: "image/*",
                paramName: "file", 
                maxFilesize: 2, // MB
                complete: function(){
                    this.removeFile(file);
                },
                queuecomplete: function(){
                    Livewire.emit('refreshProduct');
                }
            };

            Livewire.on('deleteProduct', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.edit-product', 'delete');

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });

            Livewire.on('deleteSize', sizeId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.size-product', 'delete', sizeId);

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });

            Livewire.on('deletePivot', pivot => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.color-product', 'delete', pivot);

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
            
            Livewire.on('deleteColorSize', pivot => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.color-size', 'delete', pivot);

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>