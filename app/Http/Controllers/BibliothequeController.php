<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BibliothequeController extends Controller
{
    public function store(Request $request, Jeu $jeu): RedirectResponse
    {
        $request->user()->jeux()->syncWithoutDetaching([
            $jeu->getKey() => ['date_ajout' => now()->toDateString()],
        ]);

        return back()->with('status', __('interface.added_to_library'));
    }

    public function destroy(Request $request, Jeu $jeu): RedirectResponse
    {
        $request->user()->jeux()->detach($jeu->getKey());

        return back()->with('status', __('interface.removed_from_library'));
    }
}
