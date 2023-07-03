<?php

namespace App\Http\Controllers;

use App\Mail\NewManual;
use App\Models\Manual;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManualController extends Controller
{
    public function index()
    {
        $manuals = Manual::all()->sortBy('title');

        if(isset($_GET['search'])){
            $manuals = Manual::where('title', 'like', '%'.$_GET['search'].'%')->get();
        }

        return view('manuals.index', [
            'manuals' => $manuals
        ]);
    }
    public function create()
    {
        return view("manuals.create", [
            'products' => Product::all()->sortBy('name')
        ]); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'product' => ['required'],
            'file' => ['required']
        ]);
        
        $manual=Manual::add($request->all());
        $manual->uploadImage($request->file('image'));
        $manual->uploadFile($request->file('file'));

        Mail::to('laravel-project-seo@yandex.ru')->send(new NewManual($manual));

        return redirect()->route('app.main');
    }

    public function edit($manualId)
    {
        return view('manuals.edit', [
            'products' => Product::all()->sortBy("name"),
            'manual' => Manual::find($manualId)
        ]);
    }

    public function update(Request $request, $manualId)
    {

        $available = 1;
        if(!$request ->has('is_approved')){
            $available = 0;
        }

        $request->validate([
            'title' => 'required|min:3|max:255',
            'product' => 'required',
        ]);

        $manual = Manual::find($manualId);
        $manual->update([
            'title' => $request->input("title"),
            'product_id' => $request->input("product"),
            'is_approved' => $available,
        ]);

        $manual->uploadImage($request->file("image"));

        return redirect()->route("manuals.index")->with('success', 'Инструкция успешно обновлена');
    }

    public function delete($manualId)
    {
        Manual::find($manualId)->remove();
        return back();
    }

    public function show($manualSlug)
    {
        return view("manuals.show", [
            'manual' => Manual::where("slug", $manualSlug)->first()
        ]);
    }

    public function removeImage($manualId)
    {
        Manual::find($manualId)->removeImage();
        return back();
        
    }
}
