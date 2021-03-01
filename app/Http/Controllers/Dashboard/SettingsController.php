<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

use DB;


class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {
        if ($type === 'free') {
            $shippingmethod = Setting::where('key', 'free_shipping_label')->first();
        } elseif ($type === 'inner') {
            $shippingmethod = Setting::where('key', 'local_shipping_label')->first();
        } elseif ($type === 'outer') {
            $shippingmethod = Setting::where('key', 'outer_shipping_label')->first();
        } else {
            $shippingmethod = Setting::where('key', 'free_shipping_label')->first();
        }
        return view('dashboard.settings.shippings.edit', compact('shippingmethod'));
    }

    public function updateShippingMethods(ShippingsRequest $request, $id)
    {
        try {
            DB::begintransaction();
            $shipping_method = Setting::find($id);
            $shipping_method->update(['plain_value' => $request->plain_value]);
            $shipping_method->value = $request->value;
            $shipping_method->save();
            DB::commit();
            return redirect()->back()-> with (["success"=> "{{__('messages.success')}}"]);
            }
            catch (\Exception $ex)
            {
                return redirect()->back()-> with (["error"=> "{{__('messages.error')}}"]);
            DB::rollback();
            }

    }


    //
}
