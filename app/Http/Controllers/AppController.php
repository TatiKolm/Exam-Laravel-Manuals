<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function mainPage()
    {
        return view("main",[
            'products' => Product::all()->sortBy('name')
        ]);
    }

   

    public function searchPage()
    {       
        if(isset($_GET['search'])){
            $manuals = Manual::where('title', 'like', '%'.$_GET['search'].'%')->where('is_approved', '1')->get();
        }
        
        return view("search",[
            'manuals' => $manuals
        ]);      
    }

    public function productManualPage($productId)
    {
       
        $manuals = Manual::where('product_id', $productId)->where('is_approved', '1')->get();


        if(isset($_GET['search'])){
            $manuals = Manual::where('title', 'like', '%'.$_GET['search'].'%')->where('is_approved', '1')->get();
        }

        return view("product",[
            'manuals' => $manuals
        ]);
    }

    public function manualPage($manualSlug)
    {
        return view("manual", [
            'manual' => Manual::where("slug", $manualSlug)->first()
        ]);
    }

    
}
