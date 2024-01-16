<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryEventRequest;
use App\Models\CategoryEvent;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class CategoryEventController extends Controller
{
    public function AllEventCategory(Request $request)
    {
        $event_id = $request->id;
        $eventcategory = CategoryEvent::with('evenement')->where('event_id', $event_id)->limit(8)->get();
        // $event = Evenement::where('id', $event_id)->get();

        // $item = [
        //     'eventcategory' => $eventcategory,
        //     'evenement' => $event,
        // ];

        return $eventcategory;
    }

    public function AllCategoryEventByUser(Request $request, $email)
    {
        $event_id = $request->id;
        $categoryevent = CategoryEvent::with('evenement')->where('email_organisateur', $email)->where('event_id', $event_id)->get();

        return $categoryevent;
    }

    public function creerCategoryEvent(CategoryEventRequest $request)
    {
        $image = $request->file('eventcategory_image');
        $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalName(); //exp: 303030.jpg
        Image::make($image)->resize(960, 711)->save('upload/eventcategory/' . $namegen);

        $save_url = 'http://127.0.0.1:8000/upload/eventcategory/' . $namegen;

        $eventcategory = CategoryEvent::create([
            'eventcategory_name' => $request->eventcategory_name,
            'eventcategory_description' => $request->eventcategory_description,
            'email_organisateur' => $request->email_organisateur,
            'eventcategory_image' => $save_url,
            'event_id' => $request->event_id,

        ]);

        return response()->json([
            'message' => 'La categorie a été créée avec succès',
            'categorie' => $eventcategory,
        ], 200);
    }

    public function showCategoryEvent($id)
    {
        $categoryevent = CategoryEvent::find($id);
        return $categoryevent;
    }

    //**************************************************BACKEND**************************************************/

    public function GetAllEventCategory()
    {
        $category = CategoryEvent::orderBy('eventcategory_name', 'ASC')->with('evenement')->paginate(10);
        return view('backend.category.category_all', compact('category'));
    }

    public function AddEventCategory()
    {
        $event = Evenement::OrderBy('event_name', 'ASC')->get();
        return view('backend.category.category_add', compact('event'));
    }

    public function StoreEventCategory(Request $request)
    {
        $request->validate([
            'eventcategory_name' => 'required',
            'eventcategory_image' => 'required',
        ], [
            'eventcategory_name.required' => 'Veuillez donner un nom à votre catégorie événement',
            'eventcategory_image.required' => 'Veuillez télécharger une image de votre catégorie événement'
        ]);

        // Vérifiez si l'utilisateur est authentifié
        if (auth()->check()) {
            $user = Auth::user();

            $image = $request->file('eventcategory_image');
            $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(960, 711)->save('upload/eventcategory/' . $namegen);

            $save_url = 'http://127.0.0.1:8000/upload/eventcategory/' . $namegen;

            CategoryEvent::insert([
                'eventcategory_name' => $request->eventcategory_name,
                'eventcategory_description' => $request->eventcategory_description,
                'eventcategory_image' => $save_url,
                'event_id' => $request->event_id,
                'email_organisateur' => $user->email,
            ]);

            $notification = [
                'message' => 'Catégorie créée avec succès',
                'alert-type' => 'success'
            ];

            return redirect()->route('category.all')->with($notification);
        } else {
            // L'utilisateur n'est pas authentifié, gérer ce cas ici
            abort(403, 'Accès non autorisé'); // Ou redirigez vers une page de connexion, etc.
        }
    }

    public function EventCategoryEdit($id)
    {
        $category = CategoryEvent::with('evenement')->findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function EventCategoryUpdate(Request $request)
    {
        // Récupérer l'ID de la catégorie depuis la requête
        $category_id = $request->id;

        // Vérifier si l'utilisateur est authentifié
        if (auth()->check()) {
            $user = Auth::user();

            // Vérifier si une nouvelle image est fournie
            if ($request->hasFile('eventcategory_image')) {
                $image = $request->file('eventcategory_image');

                // Générer un nom unique pour l'image
                $namegen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                // Enregistrer l'image
                Image::make($image)->resize(960, 711)->save('upload/eventcategory/' . $namegen);

                // Construire l'URL de sauvegarde
                // $save_url = url('upload/eventcategory/' . $namegen);
                $save_url = 'http://127.0.0.1:8000/upload/eventcategory/' . $namegen;
            } else {
                // Si aucune nouvelle image n'est fournie, conserver l'URL existante
                $save_url = CategoryEvent::findOrFail($category_id)->eventcategory_image;
            }

            // Mettre à jour la catégorie d'événement
            CategoryEvent::findOrFail($category_id)->update([
                'eventcategory_name' => $request->eventcategory_name,
                'eventcategory_description' => $request->eventcategory_description,
                'eventcategory_image' => $save_url,
                'email_organisateur' => $user->email,
            ]);

            // Notification de mise à jour réussie
            $notification = [
                'message' => 'La Catégorie a été mise à jour avec Succès',
                'alert-type' => 'success'
            ];

            return redirect()->route('category.all')->with($notification);
        } else {
            // L'utilisateur n'est pas authentifié, gérer ce cas ici
            abort(403, 'Accès non autorisé');
        }
    }

    public function EventCategoryDelete($id)
    {
        CategoryEvent::findOrFail($id)->delete();

        $notification = [
            'message' => 'La Catégorie a été Supprimé avec Succès',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
