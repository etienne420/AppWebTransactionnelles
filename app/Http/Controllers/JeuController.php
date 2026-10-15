<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EnregistrerJeuRequest;
use App\Models\Jeu;
use Illuminate\View\View;

class JeuController extends Controller
{
    public function index(): View
    {
        $jeux = Jeu::query()
            ->orderBy('titre')
            ->paginate(10);

        return view('jeux.index', compact('jeux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnregistrerJeuRequest $request): RedirectResponse
    {
        $jeu = Jeu::create($request->validated());

        return redirect()->route('jeux.index')
            ->with('status', 'Jeu ajouté.');
    }

    public function show(Jeu $jeu): View
    {
        return view('jeux.show', compact('jeu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jeu $jeu): View
    {
        return view('jeux.edit', compact('jeu'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EnregistrerJeuRequest $request, Jeu $jeu): RedirectResponse
    {
        $jeu->update($request->validated());

        return redirect()->route('jeux.show', $jeu)
            ->with('status', 'Jeu modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jeu $jeu): RedirectResponse
    {
        $jeu->delete();

        return redirect()->route('jeux.index')
            ->with('status', 'Jeu supprimé.');
    }
}
