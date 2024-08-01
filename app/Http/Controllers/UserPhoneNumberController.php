<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use Illuminate\Http\Request;

class UserPhoneNumberController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'number' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->phoneNumbers()->create($validated);

        return back()->with('status', 'phone-number-added');
    }

    public function destroy(PhoneNumber $phoneNumber)
    {
        $successful = $phoneNumber->delete();
        if(!$successful) {
            abort(500);
        }
        return back()->with('status', 'phone-number-deleted');
    }
}
