<x-layout>

    <a href="{{ url('/companies/create') }}">Add new Company</a>
      @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif
    <h2>Active: </h2>
    @foreach ($companies as $company )
        @if ($company->is_active)
            <h3>Name: <a href="{{ url('/companies/' . $company->id . '/show') }}">{{$company->name}}</a></h3>
            <p>Email: {{$company->email}}</p>
            <p>Telephone: {{$company->telephone}}</p>
            <p>Address: {{$company->address}}</p>
            <hr>
            
        @endif
    @endforeach



    <h2>Inactive: </h2>
     @foreach ($companies as $company )
     
        @if (!$company->is_active)
            
            <h3>Name: <a href="{{ url('/companies/' . $company->id . '/show') }}">{{$company->name}}</a></h3>
            <p>Email: {{$company->email}}</p>
            <p>Telephone: {{$company->telephone}}</p>
            <p>Address: {{$company->address}}</p>
            
            <hr>
            
        @endif
    @endforeach


</x-layout>