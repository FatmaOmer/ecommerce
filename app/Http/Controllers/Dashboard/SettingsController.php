<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {
        if($type === 'free')
        {
            $shippingmethod =Setting::where('key','free_shipping_label')->first();
        }
        elseif($type === 'inner')
        {
            $shippingmethod =Setting::where('key','local_shipping_label')->first();
        }
        elseif($type === 'outer')
        {
            $shippingmethod =Setting::where('key','outer_shipping_label')->first();
        }
        else
        {
            $shippingmethod =Setting::where('key','free_shipping_label')->first();
        }
        return view('dashboard.settings.shippings.edit',compact('shippingmethod'));
    }
    public function updateShippingMethods(Request $request ,$id)
    {

    }



    //
}
