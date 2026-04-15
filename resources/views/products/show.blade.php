<x-layout>

        @if(session('success'))
            <p style="color:green">{{session('success')}}</p>
        @endif
     
            <p><a href="{{ url('/products/' . $product->gtin . '/edit') }}">Update Product</a></p>


            <form action="{{ url('/products/' . $product->gtin . '/changeImage') }} " enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                
                <div id="preview">

                </div>
                <input type="file" name="image" id="image">
                <input type="submit" value="Change Image" name="changeImage">

            </form>

            <form action="{{ url('/products/' . $product->gtin . '/removeImage') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="submit" value="Remove image" name="removeImage">
            </form>

            @if(!$product->hidden)
                <form action="{{ url('/products/' . $product->gtin . '/hide') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="submit" value="Hide Product" name="hideProduct">
                </form>
            @else
                <form action="{{ url('/products/' . $product->gtin . '/destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="submit" value="Delete Product" name="deleteProduct">

                </form>
            @endif









        <h2>{{$product->name}} {{$product->hidden ? '(hidden)' : ''}}</h2>
        <img src="{{ $product->image ? asset('public/images/' . $product->image) : asset('public/images/placeholder.jpg') }}" alt="ProductImage" width="500">
        <p>{{$product->french_name}}</p>
        <p>{{$product->gtin}}</p>
        <p>{{$product->description}}</p>
        <p>{{$product->french_description}}</p>
        <p>{{$product->country}}</p>
        <p>{{$product->brand}}</p>
        <p>{{$product->gross_weight}}</p>
        <p>{{$product->net_weight}}</p>
        <p>{{$product->weight_unit}}</p>


            
    <script>
        
        document.getElementById('image').addEventListener('change' , (e) => {
            preview = document.getElementById('preview');

            preview.innerHTML = '';

            const file = e.target.files[0];

            if(file){
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            };

            const cancelBtn = document.createElement('button');
                cancelBtn.type = 'button';
                cancelBtn.textContent = 'cancel';
                cancelBtn.addEventListener('click', () => {
                    document.getElementById('image').value = '';
                    preview.innerHTML = '';
            });

            preview.appendChild(cancelBtn);

           

            
        });

    </script>
</x-layout>
