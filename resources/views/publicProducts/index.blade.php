<x-user.layout>
    
        <h1>Products</h1>
        <p>Filter</p>

        <form action="{{ url('/') }}" method="GET">
            @csrf
            <label for="company">By Company: </label>
            <select name="company" id="company">
                @foreach ($companies as $company )
                    <option value="{{ $company->id }}">{{$company->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="filter">
        </form>

        <form action="{{ url('/') }}" method="GET">
            @csrf
            <label for="category">By Category: </label>
            <select name="category" id="category">
                @foreach ($categories as $category )
                    <option value="{{ $category->id }}">{{$category->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="filter">
        </form>

        <table>
            <tr>
                <th>GTIN</th>
                <th>Product</th>
                <th>Category</th>
                <th>Company</th>
            </tr>
            @foreach ($products as $product )
                <tr>
                    <td>{{$product->gtin}}</td>
                    <td><a href="{{ url('01/' . $product->gtin) }}">{{$product->name}}</a></td>
                    <td>{{$product->category?->name}}</td>
                    <td>{{$product->company?->name}}</td>
                </tr>
            @endforeach
        </table>



</x-user.layout>