<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Http\Resources\ResourceCategorie;
use Illuminate\Http\Request;
use App\Htpp\Requests;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorie=Categorie::paginate(15);
        return ResourceCategorie::collection($categorie);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorie = $request->isMethod('put') ? Categorie::findOrFail($request->categorie_id) : new Categorie;


        $categorie->libelle=$request->libelle;

        if($categorie->save()){

          return new ResourceCategorie($categorie);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show($categorie)
    {
        $categories=Categorie::findOrFail($categorie);

         return new ResourceCategorie($categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($categorie)
    {
      $categories=Categorie::findOrFail($categorie);
if($categories->delete())
       return new ResourceCategorie($categories);
    }
}
