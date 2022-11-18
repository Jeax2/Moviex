@extends('layouts.app')

@section('content')
<div class="container">
    <board user_id="{{  Auth::user()->id  }}"></board>
</div>
@endsection
