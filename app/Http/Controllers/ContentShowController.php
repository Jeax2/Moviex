<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentShowController extends Controller
{
    public function index()
    {
        return Content::all();
    }
    public function show(Content $content)
    {
        return view('contents.show')->with('content', $content);

    }

    
}
