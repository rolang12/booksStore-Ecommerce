<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','price','stock',
        'alerts','editorial','presentation',
        'edition','language','n_pages','height',
        'width','year','image','category_id','authors_id', 'barcode'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    
    public function getImagenAttribute()
    {
        if ($this->image == null) {
            return 'noimg.png';
        }

        if(file_exists('storage/products/'. $this->image)){
            return $this->image;
        } else {
            return 'noimg.png';
        }

    }
}
