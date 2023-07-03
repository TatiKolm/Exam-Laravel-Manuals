<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable= ['name'];

    public function manuals()
    {
        return $this->hasMany(Manual::class);
    }

    
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
