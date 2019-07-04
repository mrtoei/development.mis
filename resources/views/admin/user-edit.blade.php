@extends('admin/admin-layouts') 
@section('title','MIS') 
@section('content')​
   <div id="app">
        <users-edit id="{!!$id!!}"></users-edit>
       
   </div>
   <script src="{{asset('js/app.js')}}"></script>
@stop