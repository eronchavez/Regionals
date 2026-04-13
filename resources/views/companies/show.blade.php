<x-layout>

   @if($company->is_active)
   <form action="{{ url('/companies/' . $company->id . '/deactivate')}}" method="POST">
    @csrf

    <input type="submit" value="Deactivate">
    </form>
   @endif

   <a href="{{ url('/companies/' . $company->id . '/edit') }}">edit</a>
    @foreach ($company->products as $product)
        <p><strong>Company name:</strong> {{$company->name}}</p>
        <p>{{$product->name}}</p>
        <p>{{$product->gtin}}</p>
        <p>{{$product->french_name}}</p>
        <hr>
    @endforeach
        
   
</x-layout>