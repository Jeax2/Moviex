<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Content::all();
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
        $content = new Content();
        $content->title = $request->title;
        $content->plot = $request->plot;
        $content->runtime = $request->runtime;
        $content->genre = $request->genre;
        $content->released = $request->released;
        $content->actors = $request->actors;
        $content->director = $request->director;
        $content->poster = $request->poster;
        $content->country = $request->country;
        $content->youtube = $request->youtube;
        $content->imdb_rating = $request->imdb_rating;
        $content->category_id = $request->category_id;
        $content->save();
        return ['alert' => 'Content created successfully!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        // SERVE PER ABILITARE LO SHOW ALL'UTENTE FINALE
        //return view('contents.show')->with('content', $content);

        $content = Content::find($content->id);
        return response()->json($content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $content == Content::find($content->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $request->validate(['title'=>'required', 'plot'=>'required', 'runtime'=>'required', 'genre'=>'required', 'released'=>'required', 'actors'=>'required', 'director'=>'required','poster'=>'required', 'country'=>'required', 'youtube'=>'required', 'imdb_rating'=>'required', 'category_id'=>'required']);
        $content->update([
        'title' => $request->title,
        'plot' => $request->plot,
        'runtime' => $request->runtime,
        'genre' => $request->genre,
        'released' => $request->released,
        'actors' => $request->actors,
        'director' => $request->director,
        'poster' => $request->poster,
        'country' => $request->country,
        'youtube' => $request->youtube,
        'imdb_rating' => $request->imdb_rating,
        'category_id' => $request->category_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content = Content::find($content->id);
        if(!$content) return ['error' => 'Content is not present!'];
        $content->delete();
        return ['alert' => 'Content deleted successfully!'];
    }

    public function search($title_search)
    {
        return Content::where('title','LIKE','%' . $title_search . '%')->get();
    }
}
