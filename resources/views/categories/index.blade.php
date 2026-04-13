<x-layout>
    
    @if (session('success'))
        <p style="color:green">{{session('success')}}</p>
    @endif

    @if (session('error'))
        <p style="color:red">{{session('error')}}</p>
    @endif
    <p><a href="{{ url('/categories/create') }}">Add new Category</a></p>
    @foreach ($categories as $category )
        <p>{{$category->name}}</p>
        <a href="{{ url('/categories/' . $category->id . '/edit') }}">Edit</a>
        <form action="{{ url('/categories/' . $category->id . '/destroy') }}" method="POST">
            @csrf
            @method('DELETE')

            <input type="submit" value="Delete" name="destroy_category">
        </form>
        <hr>
    @endforeach
</x-layout>