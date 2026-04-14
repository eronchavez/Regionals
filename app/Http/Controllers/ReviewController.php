<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //

    public function store(Request $req, Product $product)
    {
      


        Review::create([
            "user_id" => Auth::id(),
            "product_id" => $product->id,
            "rating" => $req->rating,
            'review' => $req->review
        ]);

        return redirect()->back()->with('success', 'Review successfully created!');

    }
}
