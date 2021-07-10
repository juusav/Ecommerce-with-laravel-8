<x-app-layout>
    <div class="container py-8">

        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class=" text-lg uppercase font-semibold text-gray-700 col-span-4">
                        {{$category->name}}
                    </h1>

                    <a href="{{route('categories.show', $category)}}"
                       class="text-sm text-gray-500 ml-2 font-semibold hover:text-gray-800
                        hover:underline">
                        Ver más
                    </a>
                </div> 
                @livewire('category-products', ['category' => $category])
                {{-- 'category' variable que está siendo enviada app\livewire --}}
            </section>
        @endforeach
    </div>
    
    {{-- Solución de desface --}}
    @push('slider')
        <script>
            // Este trozo se ejecutará luego de ejecutar la acción dentro de la función loadPosts de CategoryProducts en la carpeta Livewire
            Livewire.on('glider', function(id){
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots:'.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });
            });
            
        </script>
    @endpush
</x-app-layout>