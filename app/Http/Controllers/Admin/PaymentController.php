<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nomine;
use App\Models\Payment;
use App\Models\Vote;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payVote(Request $request)
    {
        $mode_paiement = $request->input('mode_paiement');
        $tel_votant = $request->input('tel_votant');
        $quantity = $request->input('quantity');
        $nomine_id = $request->input('id');
        
        date_default_timezone_set("Africa/Porto-Novo");
        $date_paiement = date("d-m-Y");
        $heure_paiement = date("H:i:s");
        

        $nomine = Nomine::with('categories', 'evenements')->where('id', $nomine_id)->first();

        

        $event_prixvote = $nomine->evenements->event_prixvote;

        $mount = $event_prixvote * $quantity;

        $result = Payment::create([

            'event_id' => $nomine->evenements->id,
            'evenement' => $nomine->evenements->event_name,
            'mount' => $mount,
            'mode_paiement' => $mode_paiement,
            'tel_votant' => $tel_votant,
            'date_paiement' => $date_paiement, // Utilisation de la date actuelle pour 'date_paiement'
            'heure_paiement' => $heure_paiement, // Utilisation de la date actuelle pour 'date_paiement'

        ]);

        Vote::create([

            'nomine_id' => $nomine->id,
            'nomine' => $nomine->nom,
            'evenement' => $nomine->evenements->event_name,
            'payment_id' => $result->id,
            'quantity' => $quantity,
            'date_vote' => $date_paiement, // Utilisation de la date actuelle pour 'date_paiement'
            'heure_vote' => $heure_paiement,

        ]);

        return response([
            'message' => 'Vous avez Voté Votre Nominé avec Succès',
        ], 201);
    } // End Method
}
