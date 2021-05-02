<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsoRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mois' => $this->mois,
            'annee' => $this->annee,
            'consomation' => $this->consomation,
            'prixHT' => $this->prixHT,
            'TVA' => $this->TVA,
            'prixTTC' => $this->prixTTC,
            'status' => $this->status,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'user' => $this->user,
            'consoannuelle' => $this->user->consomations()->sum('consomation'),
            'ID_Agent' => 15648,
            'anneedeconso' => $this->annee
        ];
    }
}
