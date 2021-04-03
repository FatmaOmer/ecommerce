<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //use package for translations with their methods
    use translatable;
//use to come with other translations from another table
    protected  $with=['translations'];

    protected $translatedAttributes=['name'];

    protected $fillable=['is_active'];
    // protected $hidden=['translations'];


//cast to another type of attribute
    protected $casts =[
        'is_active' => 'boolean',
    ];



    public function getactive()
    {
        return $this->is_active == 0? trans('admin/brands.notactive'):trans('admin/brands.active');
    }
    public function getphotoattribute($val)
    {
        return $val !== null ?asset('assets/images/brands/'.$val):" ";
    }
}
