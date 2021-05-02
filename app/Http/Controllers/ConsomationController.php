<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ConsoRessource as ConsoResource;
use App\Consomation;
use App\Http\Requests\ConsoCreateRequest;
use App\Http\Requests\UpdateConsoRequest;
use App\Policies\ConsoPolicy;

class ConsomationController extends Controller
{

    public function index()
    {
        $consos = Consomation::orderBy('created_at', 'asc')->paginate(12);
        return ConsoResource::collection($consos);
    }
    public function singleconso($id)
    {
        $consos = Consomation::all();
        return $consos;
    }

    public function store(ConsoCreateRequest $request)
    {
        $conso = new Consomation;
        $conso->mois = $request->mois;
        $conso->annee = $request->annee;
        $conso->consomation = $request->consomation;
        if ($conso->consomation <= 100) {
            $conso->prixHT = $conso->consomation * 0.91;
        } elseif ($conso->consomation > 101 && $conso->consomation <= 200) {
            $conso->prixHT = $conso->consomation * 1.01;
        } else {
            $conso->prixHT = $conso->consomation * 1.12;
        }
        $conso->TVA = ($conso->prixHT * 14) / 100;
        $conso->prixTTC = $conso->prixHT - $conso->TVA;
        $conso->status = false;
        $conso->user()->associate($request->user());
        $conso->save();


        return new ConsoResource($conso);
    }

    public function show(Consomation $conso)
    {
        return new ConsoResource($conso);
    }


    public function update(UpdateConsoRequest $request, Consomation $conso)
    {
        $conso->status = $request->get('status', $conso->status);
        $conso->save();
        return new ConsoResource($conso);
    }

    public function destroy(Consomation $conso)
    {
        $this->authorize('destroy', $conso);
        $conso->delete();
        return response(null, 204);
    }
}
