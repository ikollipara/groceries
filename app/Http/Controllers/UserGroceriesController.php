<?php

namespace App\Http\Controllers;

use App\Models\Grocery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserGroceriesController extends Controller
{
    public function index(Request $request)
    {
        $groceries = $request->user()->groceries()->unpurchased()->get();
        return view('groceries.index', [
            'groceries' => $groceries,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->groceries()->create($validated);

        return Redirect::route('groceries.index')->with('status', 'grocery-added');
    }

    public function destroy(Grocery $grocery)
    {
        $successful = $grocery->delete();
        if(!$successful) {
            abort(500);
        }
        return response(status: 204);
    }
}
