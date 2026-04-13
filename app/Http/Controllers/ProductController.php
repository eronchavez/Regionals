<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function verifyGTINs(Request $req)
    {
        $validated = $req->validate([
            'gtins' => 'required'
        ]);

        $gtins = explode("\n", $validated['gtins']);
        $gtins = array_map('trim', $gtins);
        $products = Product::whereIn('gtin', $gtins)->where('hidden', 0)->get();
        
        return view('publicProducts.verify_result',compact('gtins', 'products'));

    }

    public function getProductsPublic(Request $req)
        {
            $category = $req->query('category');
            $company = $req->query('company');
            $productsQuery = Product::where('hidden', 0);
          

            if($category)
                {
                    $productsQuery->where('category_id', $category);
                }

            if($company)
                {
                    $productsQuery->where('company_id', $company);
                }

               
            
            $products = $productsQuery->get();
            $categories = Category::all();
            $companies = Company::where('active',1)->get();


            return view('publicProducts.index',compact('products', 'categories', 'companies'));
            
        }

        public function getProductPublic(Product $product)
        {
            if($product->hidden) abort(404);
            return view('publicProducts.product',compact('product'));
        }


    public function getProductsJson(Request $req)
    {

        $query = $req->input('query');
        $productsQuery = Product::where('hidden', 0);
        
        if($query)
            {
                $productsQuery->where(function($p) use ($query){
                    $p->where('name', 'like', '%' . $query . '%')
                    ->orWhere('french_name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('french_description', 'like', '%' . $query . '%');
                });
            }

        $products = $productsQuery->paginate(10);

        return response()->json([
            'data' => $products->map(function($product){
                return [

                    'name' => [
                        'en' => $product->name,
                        'fr' => $product->french_name
                    ],
                    

                    'description' => [
                        'en' => $product->description,
                        'fr' => $product->french_description
                    ],


                    'gtin' => $product->gtin,
                    'brand' => $product->brand,
                    'category' => $product->category,
                    'countryOfOrigin' => $product->country,

                    'weight' => [
                        'gross' => $product->gross_weight,
                        'net' => $product->net_weight,
                        'unit' => $product->weight_unit
                    ],



                    'company' => [
                        'companyName' => $product->company?->name,
                        'companyAddress' => $product->company?->address,
                        'companyTelephone' => $product->company?->telphone,
                        'companyEmail' => $product->company?->email,
                    ],

                    'contact' => [
                        'name' => $product->company?->contact->name,
                        'mobileNumber' => $product->company?->contact->mobile,
                        'email' => $product->company?->contact->email,
                    ],

                    'owner' => [
                        'name' => $product->company?->owner->name,
                        'mobileNumber' => $product->company?->owner->mobile,
                        'email' => $product->company?->owner->email,
                    ]

                  



                    


                ];
            }),


            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url'=> $products->previousPageUrl()
            ]
        ]);


     
    }


    public function getProductJson(Product $product)
    {
        if($product->hidden) abort(404);

        return response()->json([
               'name' => [
                        'en' => $product->name,
                        'fr' => $product->french_name
                    ],
                    

                    'description' => [
                        'en' => $product->description,
                        'fr' => $product->french_description
                    ],


                    'gtin' => $product->gtin,
                    'brand' => $product->brand,
                    'category' => $product->category,
                    'countryOfOrigin' => $product->country,

                    'weight' => [
                        'gross' => $product->gross_weight,
                        'net' => $product->net_weight,
                        'unit' => $product->weight_unit
                    ],



                    'company' => [
                        'companyName' => $product->company?->name,
                        'companyAddress' => $product->company?->address,
                        'companyTelephone' => $product->company?->telphone,
                        'companyEmail' => $product->company?->email,
                    ],

                    'contact' => [  
                        'name' => $product->company?->contact->name,
                        'mobileNumber' => $product->company?->contact->mobile,
                        'email' => $product->company?->contact->email,
                    ],

                    'owner' => [
                        'name' => $product->company?->owner->name,
                        'mobileNumber' => $product->company?->owner->mobile,
                        'email' => $product->company?->owner->email,
                    ]

                  
        ]);
    }

    public function index()
    {
        $products = Product::all(); 

        return view('products.index',compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }


    public function destroy(Product $product)
    {
       $product->delete();
       return redirect('/products')->with('success','Product successfully deleted!');
    }

   public function changeImage(Request $req, Product $product)
    {
        $validated = $req->validate([
            'image' => 'required|image|max:2048'
        ]);

        $file = $validated['image'];

        $imageName = time() . '.' . $file->extension();
        $file->move(public_path('images'), $imageName);

        $product->update(['image' => $imageName]);

        return back()->with('success', 'Image successfully updated');
    }
    
    public function hideProduct(Product $product)
    {      
        $product->hidden = 1;
        $product->save();

        return redirect()->back()->with('success', 'Product successfully hidden!');
      
    }


    public function removeImage(Product $product)
    {
        $product->image = null;
        $product->save();

        return redirect()->back()->with('success', 'Image successfully removed');

       
    }

    public function create()
    {   
       $companies = Company::where('active', 1)->get();
       $categories = Category::all();

       return view('products.create',compact('companies','categories'));
    }


    public function store(Request $req)
        {
            $validated = $req->validate([
                'name' => 'required',
                'french_name' => 'required',
                'description' => 'required',
                'french_description' => 'required',
                'gtin' => 'required|unique:products,gtin|min:13|max:14',
                'country' => 'required',
                'brand' => 'required',
                'category_id' => 'required',
                'gross_weight' => 'required',
                'net_weight' => 'required',
                'weight_unit' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'company_id' => 'required|exists:companies,id'
            ]);



        if ($req->hasFile('image')) {
            $imageName = time() . '.' . $req->file('image')->extension();
            $req->file('image')->move(public_path('images'), $imageName);
            $validated['image'] = $imageName; 
        }

        

        Product::create($validated);
            return redirect('/products')->with('success', 'Product successfully added!');
        }

    public function edit(Product $product)
    {
        $companies = Company::where('active',1)->get();
        $categories = Category::all();
        return view('products.edit',compact('product','companies', 'categories'));
    }

        
    public function update(Request $req, Product $product)
        {
            $validated = $req->validate([
                'name' => 'required',
                'french_name' => 'required',
                'description' => 'required',
                'french_description' => 'required',
                'gtin' => 'required|min:13|max:14|unique:products,gtin,' . $product->id,
                'country' => 'required',
                'brand' => 'required',
                'category_id' => 'required',
                'gross_weight' => 'required',
                'net_weight' => 'required',
                'weight_unit' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'company_id' => 'required|exists:companies,id'
            ]);

        if($req->hasFile('image'))
            {
                $imageName = time() . '.' . $req->file('image')->extension();
                $req->file('image')->move(public_path('images'),$imageName);
                $validated['image'] = $imageName;
            }

            $product->update($validated);

        return redirect('/products')->with('success', 'Product successfully updated');
    }

}
