<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\JeuResource;
use App\Models\Jeu;
use App\Http\Requests\EnregistrerJeuApiRequest;

class JeuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $jeux = Jeu::query()
        ->with('user:id,name')
        ->orderBy('titre')
        ->paginate(10);

    return JeuResource::collection($jeux);
}

    /**
     * Store a newly created resource in storage.
     */
public function store(EnregistrerJeuApiRequest $request)
{
    $data = $request->safe()->except('image');
    $path = $request->file('image')?->store('jeux', 'public');

    try {
        $jeu = $request->user()->jeux()->create([
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

    return (new JeuResource($jeu->load('user:id,name')))
        ->response()
        ->setStatusCode(201);
}

    /**
     * Display the specified resource.
     */
    public function show(Jeu $jeu): JeuResource
    {
        $jeu->load('user:id,name');

        return new JeuResource($jeu);
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
