<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    public function limit()
    {
        return Str::limit($this->description, 30, '...');
    }
    public function getCategoryProductName(){
        $category = Category::find($this->category_id);
        if($category)
        {
            return $category->name;
        }
        else {
            return "Emty";
        }
    }
}
