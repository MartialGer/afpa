<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRCS;
use App\Models\ModelRCS;
use Illuminate\Support\Facades\Storage;

class CtrlRCS extends Controller
{
    public function indexRCS()
    {
        try {
            $reglements = ModelRCS::whereNull('deleted_at')->get();
        } catch (\Exception $e) {
            return view('rcs.indexRCS')->with('error', 'Désolé, la base de données n\'est pas disponible.')
                ->with('reglements', []);
        }

        return view('rcs.indexRCS', ['reglements' => $reglements]);
    }
    public function indexAdminRCS()
    {
        try {
            $reglements = ModelRCS::whereNull('deleted_at')->get();
        } catch (\Exception $e) {
            return view('rcs.indexAdminRCS')->with('error', 'Désolé, la base de données n\'est pas disponible.')
                ->with('reglements', []);
        }
        return view('rcs.indexAdminRCS', [
            'reglements' => $reglements,
        ]);
    }
    public function afficherFormulaireRCS(RequestRCS $request)
    {
        try {
            $titre = $request->input('titre');
        } catch (\Exception $e) {
            return view('rcs.indexAdminRCS')->with('error', 'Désolé, la base de données n\'est pas disponible.')
                ->with('reglements', []);
        }
        return view('rcs.formulaireRCS')->with('titre', $titre);
    }
    public function pageRCS($slug)
    {
        try {
            $titre = str_replace('_', ' ', $slug);
            $reglement = ModelRCS::where('titre', $titre)->firstOrFail();
        } catch (\Exception $e) {
            return view('rcs.indexRCS')->with('error', 'Désolé, la base de données n\'est pas disponible.')
                ->with('reglement', []);
        }
        return view('rcs.pageRCS', ['reglement' => $reglement]);
    }
    
    public function nouveauRCS(RequestRCS $request)
    {
        try {
            $pdf = $request->file('pdf');
            $pdfName = $pdf->getClientOriginalName();
            $pdfPath = $pdf->storeAs('public/RCS', $pdfName);

            $reglement = new ModelRCS();
            $reglement->titre = $request->input('titre');
            $reglement->pdf = $pdfPath;
            $reglement->visibilite_id = 3;
            $reglement->etat_id = 2;
            $reglement->save();

        } catch (\Exception $e) {
            return view('rcs.indexAdminRCS')->with('error', 'Désolé, la base de données n\'est pas disponible.')
                ->with('reglements', []);
        }

        return redirect()->route('indexAdminRCS')->with('success', 'Le fichier "' . $reglement->titre . '" a été ajouté avec succès.');
    }
    public function selectRCS($slug)
    {
        try {
            $titre = str_replace('_', ' ', $slug);
            $reglement = ModelRCS::where('titre', $titre)->firstOrFail();
        } catch (\Exception $e) {
            return view('rcs.indexAdminRCS')->with('error', 'Désolé, la base de données n\'est pas disponible.')
                ->with('reglement', []);
        }
        return view('rcs.formulaireRCS', ['reglement' => $reglement, 'titre' => $titre]);
    }
    public function editRCS(RequestRCS $request, $slug)
    {
        try {
            $titre = str_replace('_', ' ', $slug);
            $reglement = ModelRCS::where('titre', $titre)->firstOrFail();

            $pdfPath = $reglement->pdf;

            if ($request->hasFile('pdf')) {
                $pdf = $request->file('pdf');
                $pdfName = $pdf->getClientOriginalName();
                $pdfPath = $pdf->storeAs('public/RCS', $pdfName);

                Storage::delete($reglement->pdf);
            }

            $reglement->pdf = $pdfPath;
            $reglement->save();
        } catch (\Exception $e) {
            return redirect('/admin/reglements')->with('error', 'Désolé, la base de données n\'est pas disponible.')
                ->with('reglements', []);
        }

        return redirect('/admin/reglements')->with('success', 'Le fichier "' . $reglement->titre . '" a été modifié avec succès.');
    }
}