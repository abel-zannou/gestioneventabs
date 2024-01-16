<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryEvent;
use App\Models\Evenement;
use App\Models\Nomine;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class NomineController extends Controller
{
    public function NomineByEvent(Request $request)
    {
        $evenement_id = $request->id;
        $nomines = Nomine::with('evenements', 'categories')->where('evenement_id', $evenement_id)->limit(16)->get();

        $votenomineAray = [];
        // return $nomine;
        foreach($nomines as $value)
        {
            $votenomine = Vote::with('nomine', 'payment')->where('nomine_id', $value['id'])->sum('quantity');

            $item = [
                'id' =>$value['id'],
                'evenement_id' =>$value['evenement_id'],
                'categoryevent_id' =>$value['categoryevent_id'],
                'nom' =>$value['nom'],
                'prenom' =>$value['prenom'],
                'age' =>$value['age'],
                'photo' =>$value['photo'],
                'pays' =>$value['pays'],
                'phone' =>$value['phone'],
                'email_nomine' =>$value['email_nomine'],
                'code_connexion' =>$value['code_connexion'],
                'attrib_nomine' =>$value['attrib_nomine'],
                'vote_nomine' =>$votenomine,
            ];

            array_push($votenomineAray, $item);
        }

        return $votenomineAray;

        // return $nomine;
    } //End Method

    //Cette function est utilisé pour les publics comme nomine par categori et aussi pour l'utilisateur comme nomine pour ses categories
    public function NomineByCategory(Request $request)
    {
        $category_id = $request->categoryevent_id;
        $evenement_id = $request->evenement_id;
        $nomines = Nomine::with('categories', 'evenements')->where('evenement_id', $evenement_id)->where('categoryevent_id', $category_id)->limit(8)->get();

        $votenomineAray = [];
        // return $nomine;
        foreach($nomines as $value)
        {
            $votenomine = Vote::with('nomine', 'payment')->where('nomine_id', $value['id'])->sum('quantity');

            $item = [
                'id' =>$value['id'],
                'evenement_id' =>$value['evenement_id'],
                'categoryevent_id' =>$value['categoryevent_id'],
                'nom' =>$value['nom'],
                'prenom' =>$value['prenom'],
                'age' =>$value['age'],
                'photo' =>$value['photo'],
                'pays' =>$value['pays'],
                'phone' =>$value['phone'],
                'email_nomine' =>$value['email_nomine'],
                'code_connexion' =>$value['code_connexion'],
                'attrib_nomine' =>$value['attrib_nomine'],
                'vote_nomine' =>$votenomine,
            ];

            array_push($votenomineAray, $item);
        }

        return $votenomineAray;
    } //End Method

    public function NomineDetails(Request $request)
    {
        $nomine_id = $request->id;
        $nomine = Nomine::with('categories', 'evenements')->where('id', $nomine_id)->get();
        return $nomine;
    } //End Method

    //////////////////////FRONT USER CREATE NOMINE/////////////////////////////////

    public function Nominecree(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'age' => 'required',
            'pays' => 'required',
            'phone' => 'required',
            'email_nomine' => 'required|email',
            'photo' => 'required|image',
            'categoryevent_id' => 'required',
            'evenement_id' => 'required',
        ]);

        // Gérer le téléchargement de la photo
        $image = $request->file('photo');
        $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(711, 960)->save('upload/nomine/' . $namegen);

        $save_url = 'http://127.0.0.1:8000/upload/nomine/' . $namegen;

        // Générer un code de connexion aléatoire
        $code_connexion = mt_rand(100000, 999999);

        // Récupérer l'événement spécifié
        $event_id = $request->evenement_id;
        $event = Evenement::find($event_id);

        // if (!$event) {
        //     return response()->json(['error' => 'Événement non trouvé'], 404);
        // }

        // Récupérer la catégorie spécifiée pour cet événement
        $category_id = $request->categoryevent_id;
        $category = CategoryEvent::with('evenement')->where('event_id', $event_id)
            ->where('id', $category_id)
            ->first();

        // if (!$category) {
        //     return response()->json(['error' => 'Catégorie d\'événement non trouvée'], 404);
        // }

        // Vérifier si un candidat avec la même adresse e-mail existe déjà pour cette catégorie et cet événement
        $nomine_email = $request->email_nomine;
        $existingNomine = Nomine::with('categories', 'evenements')->where('email_nomine', $nomine_email)
            ->where('evenement_id', $event_id)
            ->where('categoryevent_id', $request->categoryevent_id)
            ->first();

        if ($existingNomine) {
            return response()->json(['error' => 'Un candidat avec cette adresse e-mail existe déjà pour cette catégorie et cet événement'], 400);
        }

        // Générer un attribut nominee unique
        $words = explode(" ", $event->event_name);
        $uniqueAttribute = substr($words[0], 0, 2) . substr($words[1], 0, 2);
        do {
            $random_number = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
            $uniqueAttribute .= $random_number;
        } while (Nomine::where('attrib_nomine', $uniqueAttribute)->exists());

        // Créer un enregistrement pour le candidat
        Nomine::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'age' => $request->age,
            'pays' => $request->pays,
            'phone' => $request->phone,
            'email_nomine' => $request->email_nomine,
            'code_connexion' => $code_connexion,
            'attrib_nomine' => $uniqueAttribute,
            'photo' => $save_url,
            'evenement_id' => $event->id,
            'categoryevent_id' => $category->id,
        ]);

        return response()->json(['message' => 'Le Candidat a été créé avec succès']);
    }

    public function logNomine(Request $request)
    {
        $request->validate([
            'email_nomine' => 'required|email',
            'code_connexion' => 'required',
        ]);

        $nomine = Nomine::where('email_nomine', $request->email_nomine)->first();

        if (!$nomine) {
            return response()->json([
                'message' => 'Ce Nomine n\'existe pas',
            ]);
        }

        if ($nomine->code_connexion !== $request->code_connexion) {
            return response()->json([
                'message' => 'Le code de connexion est incorrect',
            ]);
        }

        return response()->json([
            'message' => 'Authentification réussie',
            'nomine' => $nomine,
        ]);
    }

    public function NomineAuth($nomine_email)
    {
        // $nomine_email = $request->email_nomine;
        $nomine = Nomine::with('categories', 'evenements')->where('email_nomine', $nomine_email)->get();
        return $nomine;
    }

    /***********************************************BACKEND*********************************************/

    public function GetAllNomine()
    {
        $nomines = Nomine::with('categories', 'evenements')->orderBy('nom', 'ASC')->paginate(10);

        return view('backend.nomine.nomine_all', compact('nomines'));
    }

    public function AddNomine()
    {
        $category = CategoryEvent::orderBy('eventcategory_name', 'ASC')->with('evenement')->get();
        $event = Evenement::orderBy('event_name', 'ASC')->get();

        return view('backend.nomine.nomine_add', compact('category', 'event'));
    }

    public function StoreNomine(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'email_nomine' => 'required|email',
            'photo' => 'required|image',
        ]);

        $event_id = $request->evenement_id;
        $category_id = $request->categoryevent_id;

        $event = Evenement::find($event_id);

        // Gérer le téléchargement de la photo
        $image = $request->file('photo');
        $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(711, 960)->save('upload/nomine/' . $namegen);

        $save_url = 'http://127.0.0.1:8000/upload/nomine/' . $namegen;

        $nomine_email = $request->email_nomine;
        $existingNomine = Nomine::with('categories', 'evenements')->where('email_nomine', $nomine_email)
            ->where('evenement_id', $event_id)
            ->where('categoryevent_id', $request->categoryevent_id)
            ->first();

        if ($existingNomine) {
            $notification = [
                'message' => 'un Nomine existe déjà avec cet email',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }

        // Générer un code de connexion aléatoire
        $code_connexion = mt_rand(100000, 999999);

        // Générer un attribut nominee unique
        $words = explode(" ", $event->event_name);
        $uniqueAttribute = substr($words[0], 0, 2) . substr($words[1], 0, 2);
        do {
            $random_number = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
            $uniqueAttribute .= $random_number;
        } while (Nomine::where('attrib_nomine', $uniqueAttribute)->exists());

        // Créer un enregistrement pour le candidat
        Nomine::insert([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'age' => $request->age,
            'pays' => $request->pays,
            'phone' => $request->phone,
            'email_nomine' => $request->email_nomine,
            'code_connexion' => $code_connexion,
            'attrib_nomine' => $uniqueAttribute,
            'photo' => $save_url,
            'evenement_id' => $event_id,
            'categoryevent_id' => $category_id,
        ]);

        $notification = [
            'message' => 'Nominé créé avec succès',
            'alert-type' => 'success'
        ];

        return redirect()->route('nomine.all')->with($notification);
    }

    public function NomineEdit($id)
    {
        $category = CategoryEvent::orderBy('eventcategory_name', 'ASC')->with('evenement')->get();
        $event = Evenement::orderBy('event_name', 'ASC')->get();
        $nomine = Nomine::with('categories', 'evenements')->findOrFail($id);

        return view('backend.nomine.nomine_edit', compact('category', 'event', 'nomine'));
    }

    public function NomineUpdate(Request $request)
    {
        $nomine_id = $request->id;

        if($request->hasFile('photo')){
            $image = $request->file('photo');
        $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(711, 960)->save('upload/nomine/' . $namegen);

        $save_url = 'http://127.0.0.1:8000/upload/nomine/' . $namegen;
        }else{
            $save_url = Nomine::findOrFail($nomine_id)->photo;
        }

        Nomine::findOrFail($nomine_id)->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'age' => $request->age,
            'pays' => $request->pays,
            'phone' => $request->phone,
            'email_nomine' => $request->email_nomine,
            'photo' => $save_url,
        ]);

        $notification = [
            'message' => 'Nominé a été Mise à Jour avec succès',
            'alert-type' => 'success'
        ];

        return redirect()->route('nomine.all')->with($notification);
    }

    public function NomineDelete($id)
    {
        Nomine::findOrFail($id)->delete();

        $notification = [
            'message' => 'Le Nominé a été Supprimé avec Succès',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
