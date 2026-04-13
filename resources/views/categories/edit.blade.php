<x-layout>

    <form action="{{ url('/categories/' . $category->id . '/update') }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Category Name: </label>
        <input type="text" name="name">
        <input type="submit">
    </form>
</x-layout>



