<x-layout>

    <h2>Update Product</h2>
    

    <form action="{{ url('/products/' . $product->gtin . '/update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        

       <div>
            <label for="image">Image: </label>
            <input type="file" name="image">
        </div>
        
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name">
            @error('name')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="french_name">French Name: </label>
            <input type="text" name="french_name">
            @error('french_name')
                <p>{{$message}}</p>
            @enderror
        </div>

         <div>
            <label for="description">Description: </label>
            <input type="text" name="description">
             @error('description')
                <p>{{$message}}</p>
            @enderror
        </div>

         <div>
            <label for="french_description">French Description: </label>
            <input type="text" name="french_description">
             @error('french_description')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="gtin">GTIN: </label>
            <input type="text" name="gtin">
             @error('gtin')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="country">Country: </label>
            <input type="text" name="country">
             @error('country')
                <p>{{$message}}</p>
            @enderror
        </div>

       

         <div>
            <label for="brand">Brand: </label>
            <input type="text" name="brand">
             @error('brand')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <select name="category_id" id="category_id">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

         <div>
            <label for="gross_weight">Gross Weight: </label>
            <input type="text" name="gross_weight">
             @error('gross_weight')
                <p>{{$message}}</p>
            @enderror
        </div>

         <div>
            <label for="net_weight">Net Weight: </label>
            <input type="text" name="net_weight">
             @error('net_weight')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="weight_unit"> Weight Unit: </label>
            <input type="tel" name="weight_unit">
             @error('weight_unit')
                <p>{{$message}}</p>
            @enderror
        </div>

       <div>
         <select name="company_id" id="company_id">
            @foreach ($companies as $company )
                <option value="{{ $company->id }}">{{$company->name}}</option>
            @endforeach
        </select> 
       </div>

        <input type="submit" value="Update Product">
    </form>
</x-layout>