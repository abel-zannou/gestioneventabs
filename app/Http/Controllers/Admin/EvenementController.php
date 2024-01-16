<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvenementRequest;
use App\Models\CategoryEvent;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class EvenementController extends Controller
{
    //Permet d'afficher toutes les categories et leur sous categories correspondante
    public function AllEvent()
    {
        $event = Evenement::all();
        $eventDetailsArry = [];

        foreach ($event as $value) {
            $categoriesevent = CategoryEvent::where('event_id', $value['id'])->get();

            $item = [
                'id' => $value['id'],
                'event_name' => $value['event_name'],
                'event_description' => $value['event_description'],
                'event_image' => $value['event_image'],
                'event_lieu' => $value['event_lieu'],
                'event_datedebut' => $value['event_datedebut'],
                'event_datefin' => $value['event_datefin'],
                'event_prixvote' => $value['event_prixvote'],
                'event_status' => $value['event_status'],
                'eventcategory_name' => $categoriesevent,
            ];

            array_push($eventDetailsArry, $item);
        }
        return $eventDetailsArry;
    } //End Method

    public function AllEventByUser($email)
    {
        // $email = $request->input('email_organisateur');

        $events = Evenement::where('email_organisateur', $email)->get();

        if ($events->isEmpty()) {
            return response()->json(['message' => 'Vous n\'avew pas encore créer un évènement.']);
        }

        return $events;
    }

    public function CreerEvent(EvenementRequest $request)
    {
        $image = $request->file('event_image');
        $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalName(); //exp: 303030.jpg
        Image::make($image)->resize(960, 711)->save('upload/event/' . $namegen);

        $save_url = 'http://127.0.0.1:8000/upload/event/' . $namegen;

        $event = Evenement::create([
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_lieu' => $request->event_lieu,
            'event_datedebut' => $request->event_datedebut,
            'event_datefin' => $request->event_datefin,
            'event_prixvote' => $request->event_prixvote,
            'email_organisateur' => $request->email_organisateur,
            'event_image' => $save_url,
            'event_status' => $request->event_status,
        ]);

        return response()->json([
            'message' => 'Evènement a été créée avec succès',
            'Evenement' => $event,
        ], 200);
    }

    public function showEvent($id)
    {
        $event = Evenement::find($id);
        return $event;
    }

    ////////////////////////////BACKEND////////////////////////////////////////
    public function GetAllEvent()
    {
        $events = Evenement::orderBy('event_name', 'ASC')->paginate(8);

        return view('backend.evenement.evenement_all', compact('events'));
    } //End Method

    public function AddEvent()
    {
        return view('backend.evenement.evenement_add');
    }

    public function StoreEvent(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'event_image' => 'required',
        ], [
            'event_name.required' => 'Veuillez donner un nom à votre évènement',
            'event_image.required' => 'Veuillez télécharger une image de votre évènement'
        ]);

        $user = Auth::user();

        $image = $request->file('event_image');
        $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(960, 711)->save('upload/event/' . $namegen);
        $save_url = 'http://127.0.0.1:8000/upload/event/' . $namegen;

        Evenement::insert([
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_lieu' => $request->event_lieu,
            'event_datedebut' => $request->event_datedebut,
            'event_datefin' => $request->event_datefin,
            'event_prixvote' => $request->event_prixvote,
            'email_organisateur' => $user->email,
            'event_image' => $save_url,
            'event_status' => $request->event_status,
        ]);

        $notification = [
            'message' => 'Evènement créé avec Succès',
            'alert-type' => 'success'
        ];

        return redirect()->route('event.all')->with($notification);
    }

    public function EventEdit($id)
    {
        $event = Evenement::findOrFail($id);
        return view('backend.evenement.evenement_edit', compact('event'));
    }

    public function EventUpdate(Request $request)
    {
        $event_id = $request->id;

        // Vérifier si l'utilisateur est authentifié
        if (auth()->check()) {
            $user = Auth::user();

            if ($request->file('event_image')) {

                $image = $request->file('event_image');
                $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(960, 711)->save('upload/event/' . $namegen);
                $save_url = 'http://127.0.0.1:8000/upload/event/' . $namegen;
            } else {
                // Si aucune nouvelle image n'est fournie, conserver l'URL existante
                $save_url = Evenement::findOrFail($event_id)->event_image;
            }

            // Mettre à jour l'événement
            Evenement::findOrFail($event_id)->update([
                'event_name' => $request->event_name,
                'event_description' => $request->event_description,
                'event_lieu' => $request->event_lieu,
                'event_datedebut' => $request->event_datedebut,
                'event_datefin' => $request->event_datefin,
                'event_prixvote' => $request->event_prixvote,
                'email_organisateur' => $user->email,
                'event_image' => $save_url,
                'event_status' => $request->event_status,
            ]);

            $notification = [
                'message' => 'L\'Evènement a été mise à jour avec Succès',
                'alert-type' => 'success'
            ];

            return redirect()->route('event.all')->with($notification);
        } else {
            // L'utilisateur n'est pas authentifié, gérer ce cas ici
            abort(403, 'Accès non autorisé');
        }
    }

    public function EventDelete($id)
    {
        Evenement::findOrFail($id)->delete();

        $notification = [
            'message' => 'L\'Evènement a été Supprimé avec Succès',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
