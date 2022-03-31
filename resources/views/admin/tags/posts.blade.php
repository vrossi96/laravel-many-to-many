@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header text-white bg-dark">
                  Tag: <span class="text-capitalize">{{ $tag->name }}</span>
               </div>
               <div class="card-body bg-secondary">
                  <div class="row">
                     @foreach ($tag->posts as $post)
                        <div class="col">
                           <div class="card my-3 text-white border-dark" style="width: 18rem;">
                              {{-- TITLE --}}
                              <div class="card-header bg-dark">
                                 <h5 class="card-title">{{ $post->title }}</h5>
                              </div>
                              <img class="card-img-top" src="{{ $post->img }}" alt="{{ $post->slug }}">
                              {{-- CONTENT --}}
                              <div class="card-body bg-secondary">
                                 <p class="card-text">{{ $post->trunText(75) }}</p>
                              </div>
                              {{-- ACTIONS --}}
                              <div class="card-footer bg-dark">
                                 <div class="d-flex justify-content-between">
                                    <div class="mr-3">
                                       {{-- DETAILS --}}
                                       <a class="btn btn-primary btn-sm"
                                          href="{{ route('admin.posts.show', $post->id) }}">
                                          <i class="fa-solid fa-circle-info"></i>
                                       </a>
                                       {{-- EDIT --}}
                                       <a class="btn btn-warning btn-sm"
                                          href="{{ route('admin.posts.edit', $post->id) }}">
                                          <i class="fa-solid fa-pen-to-square"></i>
                                       </a>
                                    </div>
                                    {{-- DELETE POST --}}
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
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
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
