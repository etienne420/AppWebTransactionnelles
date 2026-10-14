<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
    }

    public function show(Jeu $jeu): View
    {
        return view('jeux.show', compact('jeu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
