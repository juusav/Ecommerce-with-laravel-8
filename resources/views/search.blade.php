<x-app-layout>
    <ul>
        @foreach ($products as $product)
            <li>{{$product->name}}</li>
        @endforeach
    </ul>
</x-app-layout>