<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //use package for translations with their methods
    use translatable;
//use to come with other translations from another table
    protected  $with=['translations'];
    protected $translatedAttributes=['name'];
    protected $fillable=['parent_id','slug','is_active'];
    protected $hidden=['translations'];


//cast to another type of attribute
    protected $casts =[
        'is_searchable'=>'boolean',
        'is_active' => 'boolean',
    ];



}
