<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        
                'event_name' ,
                'event_description',
                'event_image',
                'event_lieu',
                'event_datedebut',
                'event_datefin',
                'event_prixvote',
                'event_status',
                'eventcategory_name',
                'email_organisateur',
    ];

    // public function categories()
    // {
    //     return $this->hasMany(CategoryEvent::class, 'event_id', 'id');
    // }
}
