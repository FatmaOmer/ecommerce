<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  //use package for translations with their methods
use translatable;
//use to come with other translations from another table
protected  $with=['translations'];
protected $translatedAttributes=['value'];

protected $fillable=['key','is_translatable','plain_value'];


//cast to another type of attribute
 protected $casts =['is_translatable'=>'boolean'];

    public static function setMany($settings)
    {
        foreach ($settings as $key => $value)
        {
            self::set($key,$value);
        }
    }
    public static function set($key,$value)
    {
      if($key === 'translatable')
      {
          return static ::setTranslatableSettings($value);
      }
      if(is_array($value))
      {
         $value=json_encode($value);
      }
             static ::updateOrCreate(['key' =>$key],['plain_value' =>$value]);
    }

    public static function setTranslatableSettings($settings=[])
    {
        foreach ($settings as $key => $value)
        {
            static ::updateOrCreate(['key' =>$key],['is_translatable'=>true,'value' =>$value]);
        }

    }


}
