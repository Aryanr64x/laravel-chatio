<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=', $request->user()->id)->get();
        return response()->json($users);
    }


    public function update(Request $request)
    {
        $base64 = $request->image;



        $imageName = "abc" . '.' . 'jpeg';

        $img = \Image::make($base64);
        $filename = public_path() . '/storage/dp'.sha1(time()). $request->user()->id . '.jpeg';
        
        $img->save($filename);
        $path = 'storage/dp'.sha1(time()).'' . $request->user()->id . '.jpeg';
        $request->user()->dp = $path;
        $request->user()->save();
        return response()->json($path);

    }
}