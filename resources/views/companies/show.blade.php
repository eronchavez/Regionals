<x-layout>

   @if($company->active)
   <form action="{{ url('/companies/' . $company->id . '/deactivate')}}" method="POST">
    @csrf

    <input type="submit" value="Deactivate">
    </form>
   @endif   

   

   <a href="{{ url('/companies/' . $company->id . '/edit') }}">edit</a>
   <p><strong>Company name:</strong> {{$company->name}}</p>
    @foreach ($company->products as $product)
        <p>{{$product->name}}</p>
        <p>{{$product->gtin}}</p>
        <p>{{$product->french_name}}</p>
        <hr>
    @endforeach
        
   
</x-layout>