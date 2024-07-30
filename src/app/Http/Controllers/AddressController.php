<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\LegalEntity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AddressController extends Controller
{
    public function index(int $userId, ?int $id = null): View
    {
        return view('address.upsert', [
            'address' => Address::find($id),
            'countries' => Country::all(),
            'userId' => $userId
        ]);
    }

    public function delete(Request $request): RedirectResponse
    {
        Address::find($request->input("delete_address"))->delete();
        return back()->withInput();
    }

    public function upsert(Request $request, int $id = null): RedirectResponse
    {
        $legalEntityInput = $request->input('legal_entity');
        $hasLegalEntity = collect($legalEntityInput)
            ->values()
            ->filter(function ($value) {
                return Str::of($value)->trim()->isNotEmpty();
            })
            ->isNotEmpty();

        $address = Address::find($id);
        $address = $address ?? new Address();
        $address->fill($request->all());
        $address->address_type = $hasLegalEntity ? 'legal' : 'individual';
        $address->save();

        /** @var LegalEntity|null $legalEntity */
        $legalEntity = $address->legalEntity;

        if ($hasLegalEntity) {
            $legalEntity = $legalEntity ?? (new LegalEntity());
            $legalEntity->fill($legalEntityInput);
            $legalEntity->address()->associate($address);
            $legalEntity->save();
        } else {
            $legalEntity?->delete();
        }

        return redirect()->route('address', [
            'userId' => $request->input('user_id'),
            'id' => $address->id
        ]);
    }
}
