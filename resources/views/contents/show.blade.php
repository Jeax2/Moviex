@extends('layouts.app')
@section('content')

    <div class="container">
        <show-content content_id={{ $content->id }} user={{ Auth::user()->id }}></show-content>
    </div>
    <div class="container">
    
@endsection