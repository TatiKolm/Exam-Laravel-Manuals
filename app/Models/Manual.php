<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Manual extends Model
{
    use HasFactory, HasSlug;
    protected $fillable = [
        'title',
        'file',
        'image',
        'product_id',
        'is_approved'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public static function add(array $input)
    {
        $manual = new static;
        $manual->fill($input);
        $manual->product_id = $input["product"];
        $manual->save();

        return $manual;
    }

    public function getApprovedStatus()
    {
        if($this->is_approved){
            return "Да";
        }
        return "Нет";
    }
    public function uploadImage($file)
    {
        if ($file == null) return false;

        $filename = $file->getClientOriginalName();
        $path = 'manuals/images/manual_' . $this->id . '/';

        $this->removeImage();

        $file->storeAs($path, $filename, 'uploads');
        $this->image = $path . $filename;
        $this->save();
    }

    public function getImage()
    {
        $image = $this->image;

        return $image ? asset('uploads/' . $image) : asset("assets/images/no-img.png");
    }
    public function removeImage()
    {
        if($this->image){
            Storage::disk("uploads")->delete($this->image);
            $this->image = null;
            $this->save();
        }
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }


    public function uploadFile($file)
    {
        if ($file == null) return false;

        $filename = $file->getClientOriginalName();
        $path = 'manuals/files/manual_' . $this->id . '/';

       
        $file->storeAs($path, $filename, 'uploads');
        $this->file = $path . $filename;
        $this->save();
    }

    public function getFile()
    {
        $file = $this->file;

        return $file ? asset('uploads/' . $file) : asset("assets/images/no-img.png");
    }
       public function getCountApprovedManuals(){
        $appManuals = Manual::where('is_approved', '1')->get();
        return $appManuals->count();
    }

   

}
