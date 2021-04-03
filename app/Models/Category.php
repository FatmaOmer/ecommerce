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
   // protected $hidden=['translations'];


//cast to another type of attribute
    protected $casts =[
        'is_searchable'=>'boolean',
        'is_active' => 'boolean',
    ];




    public function scopeParent($query)
        {
             return $query->whereNull('parent_id');
        }
    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }

        public function getactive()
        {
            return $this->is_active == 0? trans('admin/categories.notactive'):trans('admin/categories.active');
        }
        public function _parent()
        {

           return $this->belongsTo(self::class,'parent_id');

        }

}
