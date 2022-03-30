@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            @include('admin.posts.includes.form')
         </div>
      </div>
   </div>
@endsection
