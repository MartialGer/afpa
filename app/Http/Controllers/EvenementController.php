<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Media;
use App\Models\Template;
use App\Models\Visibilite;
use App\Models\Etat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $evenements = Evenement::all();
        $images = Media::all();


        return view('evenements.indexAdminEvenements')
            ->with('images', $images)
            ->with('evenements', $evenements);
    }

    public function indexUser()
    {
        $evenements = Evenement::paginate(5);
        $images = Media::lesImages();


        return view('evenements.indexEvenements')
            ->with('images', $images)
            ->with('evenements', $evenements);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::all();
        $visibilites = Visibilite::all();
        $etats = Etat::all();
        return view('evenements.formulaireEvenement')
            ->with('templates', $templates)
            ->with('visibilites',  $visibilites)
            ->with('etats', $etats);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titre = $request['titre'];
        $slug = Str::slug($titre);
        $resume = $request['resume'];
        $contenu =  $request['contenu'];
        $idEtat =  $request['etat'];
        $idTemplate =  $request['template'];
        $idVisibilite =  $request['visibilite'];

        // --------------------------------------------------

        $evenement = Evenement::create([
            'titre' => $titre,
       
            'resume' => $resume,
            'contenu' => $contenu,
            'etat_id' => $idEtat,
            'template_id' => $idTemplate,
            'visibilite_id' => $idVisibilite,

        ]);

        $id = $evenement['id'];

        if ($request['image'] !== null) {
            $file = $request->file('image');
            $path = $file->store('/public/imagesEvenement');
            Media::create([
                'chemin' => Storage::url($path),
                'titre' => "image",
                'positionnement' => 2,
                'type_media_id' => 2,
                'evenement_id' => $id,
            ]);
        }

        $fullUrl = $request['urlVid'];
        $videoId = str_replace('https://www.youtube.com/watch?v=', '', $fullUrl);

        if ($request['urlVid'] !== null) {
            Media::create([
                'chemin' => $videoId,
                'titre' => "image",
                'positionnement' => 1,
                'type_media_id' => 1,
                'evenement_id' => $id,
            ]);
        }
        return redirect()->route('evenements.index')->with('message', 'nouvel évènement créé !');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $evenement = Evenement::cetEvenement($id);

        $image = Media::cetteImage($id);
        $video = Media::cetteVideo($id);
        $templates = Template::all();
        $visibilites = Visibilite::all();
        $etats = Etat::all();

        return view('evenements.evenement')
            ->with('image', $image)
            ->with('video', $video)
            ->with('evenement', $evenement)
            ->with('templates', $templates)
            ->with('visibilites',  $visibilites)
            ->with('etats', $etats);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evenement = Evenement::cetEvenement($id);
        $image = Media::cetteImage($id);
        $video = Media::cetteVideo($id);
        $templates = Template::all();
        $visibilites = Visibilite::all();
        $etats = Etat::all();

        return view('evenements.formulaireEvenement')
            ->with('image', $image)
            ->with('video', $video)
            ->with('evenement', $evenement)
            ->with('templates', $templates)
            ->with('visibilites',  $visibilites)
            ->with('etats', $etats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $titre = $request['titre'];
        $slug = Str::slug($titre);
        $resume = $request['resume'];
        $contenu =  $request['contenu'];
        $idEtat =  $request['etat'];
        $idTemplate =  $request['template'];
        $idVisibilite =  $request['visibilite'];


        $evenement = Evenement::find($id);

        $evenement->titre = $titre;
 
        $evenement->resume = $resume;
        $evenement->contenu = $contenu;
        $evenement->etat_id = $idEtat;
        $evenement->template_id =  $idTemplate;
        $evenement->visibilite_id = $idVisibilite;
        $evenement->save();

        // ----------------------------------     

        if ($request['imageDeleted'] == 1) {
            Media::where('medias.evenement_id', '=', $id)
                ->where('medias.type_media_id', '=', 2)
                ->delete();
        }

        if ($request['image'] !== null) {
            $file = $request->file('image');
            $path = $file->store('/public/imagesEvenement');
            Media::create([
                'chemin' => Storage::url($path),
                'titre' => "image",
                'positionnement' => 2,
                'type_media_id' => 2,
                'evenement_id' => $id,
            ]);
        }

        $fullUrl = $request['urlVid'];
        $videoId = str_replace('https://www.youtube.com/watch?v=', '', $fullUrl);


        if ($request['videoDeleted'] == 1) {
            Media::where('medias.evenement_id', '=', $id)
                ->where('medias.type_media_id', '=', 1)
                ->delete();
        }

        if ($request['urlVid'] !== null) {
            Media::create([
                'chemin' => $videoId,
                'titre' => "image",
                'positionnement' => 1,
                'type_media_id' => 1,
                'evenement_id' => $id,
            ]);
        }
        return redirect()->route('evenements.index')->with('message', 'Modifications enregistrées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {

        $evenement = Evenement::find($id);
        $evenement->media_evements()->delete();
        $evenement->delete();


        return redirect()->route('evenements.index')->with('message', 'Supression ruéssie');
    }
}
