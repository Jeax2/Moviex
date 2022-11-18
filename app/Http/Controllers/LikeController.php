<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentUser;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request) { 
       
        $request->validate(['user_id' => 'required', 'content_id' => 'required']); 
            $like = new ContentUser; 
            $like->user_id = $request->user_id;
            $like->content_id = $request->content_id; 
            $like->save(); 
        
    }

    public function destroy(ContentUser $like) {
        $like->delete();
    }
    public function index() {
        return ContentUser::all();
    }
    public function show($id_user, $id_content) {
        return ContentUser::all()->where('user_id', $id_user)->where('content_id', $id_content);
        //where( 'content_id', 25)->
    }
    public function seeLikeContentUser($id_user, $id_content) {
        return ContentUser::where('user_id', $id_user)->where('content_id', $id_content)->first();
    }
    public function totalContentLike($id_content) {
        return ContentUser::where('content_id', $id_content)->count();
    }
    public function seeContentLikeUser($id_user) {
        $array = ContentUser::where('user_id', $id_user)->get('content_id');
        $array_length = $array->count();
        $arrays = [];
        $i = 0 ;
        for($i = 0; $i < $array_length; $i++) {
            array_push($arrays, $array[$i]['content_id']);
        }
        return $arrays;
    }   
}
