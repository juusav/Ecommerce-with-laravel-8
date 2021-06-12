@props(['category'])
<div>
    <ul>
        @foreach ($category->subcategories as $subcategory)
        <li>
            <a href="" class="inline-block text-sm py-1 px-4 text-black hover:text-blue-600">
                {{$subcategory->name}}
            </a>
        </li>
        @endforeach
    </ul>
</div>