<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RechercheJeuController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:50'],
        ]);

        $jeux = Jeu::query()
            ->where('titre', 'like', '%'.$data['q'].'%')
            ->orderBy('titre')
            ->limit(8)
            ->get(['id', 'titre']);

        return response()->json([
            'data' => $jeux->map(fn (Jeu $jeu) => [
                'id' => $jeu->id,
                'label' => $jeu->titre,
                'url' => route('jeux.show', $jeu),
            ]),
        ]);
    }
}
