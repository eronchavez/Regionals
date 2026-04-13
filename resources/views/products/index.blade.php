<x-layout>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <p><a href="{{ url('/products/create') }}">Create new product</a></p>
    
    @foreach($products as $product)
        <p><a href="{{ url('/products/' . $product->gtin . '/show') }}">{{$product->name}}</a></p>
        <p>{{$product->french_name}}</p>
        <p>{{$product->gtin}}</p>
        <p>{{$product->description}}</p>
        <p>{{$product->french_description}}</p>
        <p>{{$product->country}}</p>
        <p>{{$product->brand}}</p>
        <p>{{$product->gross_weight}}</p>
        <p>{{$product->net_weight}}</p>
        <p>{{$product->weight_unit}}</p>
        <hr>
    @endforeach
</x-layout>