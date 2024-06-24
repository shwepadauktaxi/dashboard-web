<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $drivers = User::role('user')->with('vehicle')->paginate(25);
        // $isAdmin = Auth::user()->hasRole('admin');

        // return response()->json([
        //     'drivers' => $drivers,
        //     'isAdmin' => $isAdmin,
        // ]);

        return DriverResource::collection($drivers);

    }

    public function search(Request $request){
         $data = $request->search;

         $user = User::where('name', $data)
                ->orWhere('phone', $data)
                ->orWhere('driver_id',$data)
                
                ->first();

        return response()->json($user);
    }

    public  function destroy(Request $request,$id)
    {
        $driver = User::findOrFail($id);
        $driver->delete();

        return response()->json($driver);
    }
}
