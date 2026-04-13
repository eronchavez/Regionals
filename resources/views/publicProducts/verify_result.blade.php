<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GTIN verification Results</title>
</head>
<body>
    <h2>GTIN verification results</h2>

    @php
        $allValid = true;

        foreach ($gtins as $gtin) 
        {
            if(!$products->contains('gtin', $gtin))
            {
                $allValid = false;
                break;
            }
        }
    @endphp

    @if($allValid)
         <img src="{{asset('images/green-tick-2.png')}}" alt="All Valid" id="checkmark" width="100">
        <p>All valid</p>
    @endif

    <ul>
        @foreach ($gtins as $gtin)
            <li>
                GTIN: {{ $gtin }}
                @if ($products->contains('gtin', $gtin))
                    Valid
                @else
                    Invalid
                @endif

            </li>
        @endforeach
    </ul>

</body>
</html>