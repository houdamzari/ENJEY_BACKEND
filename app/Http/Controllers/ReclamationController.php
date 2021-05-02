<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\RecResource as RecResource;
use App\Reclamation;
use App\Http\Requests\RecCreateRequest;
use App\Http\Requests\UpdateRecRequest;


class ReclamationController extends Controller
{

    public function index()
    {
        $recs = Reclamation::orderBy('created_at', 'desc')->paginate(5);
        return RecResource::collection($recs);
    }

    public function store(RecCreateRequest $request)
    {
        $rec = new Reclamation;
        $rec->suject = $request->suject;
        $rec->message = $request->message;
        $rec->status = false;
        $rec->user()->associate($request->user());
        $rec->save();


        return new RecResource($rec);
    }

    public function show(Reclamation $rec)
    {
        return new RecResource($rec);
    }


    public function update(UpdateRecRequest $request, Reclamation $rec)
    {
        $rec->status = $request->get('status', $rec->status);
        $rec->save();
        return new RecResource($rec);
    }

    public function destroy(Reclamation $rec)
    {

        $rec->delete();
        return response(null, 204);
    }
}
