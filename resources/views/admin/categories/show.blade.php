@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header">Manage category</div>
               <div class="card-body">
                  <h3 class="card-title d-flex justify-content-between">
                     {{ $category->name }}
                  </h3>
                  <h4 style="background-color: {{ $category->color }}" class="badge badge-pill">{{ $category->color }}
                  </h4>
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">Creation: {{ $category->created_at }}</li>
                     <li class="list-group-item">Last update: {{ $category->updated_at }}</li>
                  </ul>
                  <hr>
                  <div class="d-flex justify-content-between">
                     <div>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">Go to the
                           categories
                           list
                        </a>
                        {{-- EDIT --}}
                        <a class="btn btn-secondary btn-sm" href="{{ route('admin.categories.edit', $category->id) }}">
                           <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                     </div>
                     {{-- DELETE CATEGORY --}}
                     <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">
                           <i class="fa-solid fa-trash-can"></i>
                        </button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
