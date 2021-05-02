<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    protected $fillable = [
        'message', 'status', 'suject'
    ];
    public function user()
    {
        return   $this->belongsTo(User::class);
    }
}
