<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EnregistrerJeuRequest;
use App\Models\Jeu;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Gate;


class JeuController extends Controller
{
    public function index(): View
    {
        $jeux = Jeu::query()
            ->orderBy('titre')
            ->paginate(10);

        $jeuxDansBibliotheque = Auth::check()
            ? Auth::user()->jeux()
                ->whereIn('jeux.id', $jeux->getCollection()->modelKeys())
                ->pluck('jeux.id')
                ->all()
            : [];

        return view('jeux.index', compact('jeux', 'jeuxDansBibliotheque'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jeux.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(EnregistrerJeuRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $path = $request->file('image')?->store('jeux', 'public');

        try {
            $jeu = Jeu::create([
                ...$data,
                'image_path' => $path,
                'published_at' => now(),
            ]);
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            throw $exception;
        }

        return redirect()->route('jeux.index')
            ->with('status', 'Jeu ajouté.');
    }


    public function show(Request $request, Jeu $jeu): View
    {
        $dansBibliotheque = $request->user()
            ? $request->user()->jeux()->whereKey($jeu->getKey())->exists()
            : false;

        return view('jeux.show', compact('jeu', 'dansBibliotheque'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jeu $jeu): View
    {
        Gate::authorize('update', $jeu);
        return view('jeux.edit', compact('jeu'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EnregistrerJeuRequest $request, Jeu $jeu): RedirectResponse
    {

        $data = $request->safe()->except('image');
        $newPath = $request->file('image')?->store('jeux', 'public');
        $oldPath = $jeu->image_path;

        try {
            $jeu->update([
                ...$data,
                ...($newPath ? ['image_path' => $newPath] : []),
            ]);
        } catch (Throwable $exception) {
            if ($newPath) {
                Storage::disk('public')->delete($newPath);
            }
            throw $exception;
        }

        if ($newPath && $oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jeu $jeu): RedirectResponse
    {

    Gate::authorize('delete', $jeu);
        $jeu->delete();

        return redirect()->route('jeux.index')
            ->with('status', 'Jeu supprimé.');
    }
}
