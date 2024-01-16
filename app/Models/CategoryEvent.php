<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryEvent extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['evenement'];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'event_id', 'id');
    }
}
