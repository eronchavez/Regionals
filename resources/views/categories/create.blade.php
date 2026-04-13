<x-layout>

    <form action="{{ url('/categories/store') }}" method="POST">
        @csrf

        <label for="name">Category Name: </label>
        <input type="text" name="name">
        <input type="submit">
    </form>
</x-layout>