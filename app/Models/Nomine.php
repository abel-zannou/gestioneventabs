<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomine extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['categories', 'evenements'];

    public function categories()
    {
        return $this->belongsTo(CategoryEvent::class, 'categoryevent_id', 'id');
    }

    public function evenements()
    {
        return $this->belongsTo(Evenement::class, 'evenement_id', 'id');
    }

    // public function votes()
    // {
    //     return $this->hasMany(Vote::class, 'nomine_id', 'id');
    // }
}
