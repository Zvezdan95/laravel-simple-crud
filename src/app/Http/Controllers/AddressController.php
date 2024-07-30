<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(int $userId, ?int $id = null)
    {
        return view('address.upsert', [
            'address' => Address::find($id),
            'countries' => Country::all(),
            'userId' => $userId
        ]);
    }
    public function delete(Request $request)
    {
        Address::find($request->input("delete_address"))->delete();
        return back()->withInput();
    }

    public function upsert(Request $request)
    {
        $input =$request->input();
        unset($input['_token']);
        Address::upsert([$input], ['id']);
        return  redirect()->route('profile.edit');
    }
}
