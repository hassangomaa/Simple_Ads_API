<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;


    protected $fillable =[
        #only allow the public data
    ];
    #security Filter
    protected $casts = [
        '1#'=> CleanHtml::class,
        '2#'=> CleanHtml::class,
        '3#'=> CleanHtml::class,
    ];


    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
