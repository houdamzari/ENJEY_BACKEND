<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consomation extends Model
{
    protected $fillable = [
        'mois', 'annee', 'consomation', 'prixHT', "TVA", 'prixTTC', 'status'
    ];
    public function user()
    {
        return   $this->belongsTo(User::class);
    }
}
