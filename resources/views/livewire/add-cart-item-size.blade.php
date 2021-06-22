<div>
    <div>
        <p class="text-lg text-gray-700">Talla:</p>

        <select wire:model="size_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione una talla</option>
            @foreach ($sizes as $size)
                <option value="{{$size->id}}">{{$size->name}}</option>
            @endforeach
        </select>
    </div>    

    <div>
        <p class="text-lg text-gray-700">Color:</p>

        <select class="form-control w-full">
            <option value="" selected disabled>Seleccionar color</option>
            @foreach ($colors as $color)
                <option class="capitalize" value="{{$color->id}}">{{__($color->name)}}</option>
            @endforeach
        </select>
    </div>    
</div>
