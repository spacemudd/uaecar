<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adController extends Controller
{
    public function settings(){

        $ad = \App\Models\Ad::first();

        return view('back.pages.adScreen', compact('ad'));
    }

    public function update(Request $request, $id)
    {
        // جلب الإعلان باستخدام ID
        $ad = \App\Models\Ad::find($id);
    
        // التحقق من وجود الإعلان
        if (!$ad) {
            return redirect()->route('ad.screen')->with('error', 'Ad is not There');
        }
    
        // تحديث البيانات
        $ad->update([
            'title' => $request->title,
            'message' => $request->message,
            'image' => $request->hasFile('image') ? $request->file('image')->store('car_images', 'public') : $ad->image,
            'updated_at' => now(),
        ]);
    
        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('ad.screen', $ad->id)->with('success', 'Add Updated Successfully');
    }


}
