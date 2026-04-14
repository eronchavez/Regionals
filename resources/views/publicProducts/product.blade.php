<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Management System</title>
</head>
<body style="text-align: center">

    <div style="text-align: center">
        <a href="#" id="en-link">EN</a> |
        <a href="#" id="fr-link">FR</a>
    </div>

    <h1 id="product-name">{{$product->name}}</h1>
    <h2>{{$product->company?->name}}</h2>
    <img src="{{ $product->image ? asset('public/images/' . $product->image) : asset('public/images/placeholder.jpg') }}" style="width: 80%">
    <p>{{$product->gtin}}</p>
    <p>Rating: {{$product->reviews_avg_rating}}</p>
    <p>Number Of Reviews: {{$product->reviews->count()}}</p>
    <p id="product-description"> {{$product->description}}</p>
    <p>Weight: {{$product->gross_weight}} {{$product->weight_unit}}</p>
    <p>Net Content Weight: {{$product->net_weight}} {{$product->weight_unit}}</p>
    <p>Category: {{$product->category?->name}}</p>


    
    <script>
        let lang = 'en';

        document.getElementById('en-link').addEventListener('click',function(event){
                event.preventDefault();
                lang = 'en';
                updateContent();
        });

        document.getElementById('fr-link').addEventListener('click',function(event){
                event.preventDefault();
                lang = 'fr';
                updateContent();
        });


        function updateContent() {
            document.getElementsByTagName('html')[0].setAttribute('lang', lang);
            document.getElementById('product-name').textContent = lang === 'en' ? '{{$product->name}}' : '{{$product->french_name}}';
            document.getElementById('product-description').textContent = lang === 'en' ? '{{ $product->description }}' : '{{$product->french_description}}';

        };


    </script>

    
    @auth
        <h2>Reviews: </h2>
        <form action="{{ url('/review/' . $product->gtin) }}" method="POST">
            @csrf

            @if (session('success'))
                <p style="color: green">{{session('success')}}</p>
            @endif
            <label for="review">Review: </label>
            <textarea name="review" id="" cols="30" rows="10" maxlength="200"></textarea>

            <label for="rating">Rating: </label>
            <select name="rating" id="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="5">4</option>
                <option value="5">5</option>
            </select>
          

            <br>
            <input type="submit">

        </form>

    @endauth
        @foreach ($reviews as $review)
            <h3>{{$review->user->name}}</h3>
            <p>Rating: {{$review->rating}}</p>
            <p>Review: {{$review->review}}</p>
        @endforeach

</body>
</html>