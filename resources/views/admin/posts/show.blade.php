@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card border-dark">
               <div class="card-header text-white bg-dark">Manage post</div>
               @if ($post->img)
                  <img class="card-img-top" src="{{ asset('storage/' . $post->img) }}" alt="{{ $post->slug }}">
               @endif
               <div class="card-body text-white bg-secondary">
                  <h3 class="card-title d-flex justify-content-between">
                     <span>{{ $post->title }}</span>
                     <sup class="badge badge-pill badge-info"> ID: {{ $post->id }}</sup>
                  </h3>
                  <h4>Post slug: {{ $post->slug }}</h4>
                  <p class="card-text"><strong>Content:</strong> {{ $post->content }}</p>
                  <div>
                     <div>Tags:</div>
                     @foreach ($post->tags as $tag)
                        <span style="background-color: {{ $tag->color }}" class="badge badge-pill text-uppercase">
                           {{ $tag->name }}
                        </span>
                     @endforeach
                  </div>
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item text-white bg-secondary">Creation: {{ $post->created_at }}</li>
                     <li class="list-group-item text-white bg-secondary">Last update: {{ $post->updated_at }}</li>
                  </ul>
                  <hr>
                  <div class="d-flex justify-content-between">
                     <div>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary btn-sm">Go to the posts
                           list</a>
                        {{-- EDIT --}}
                        <a class="btn btn-secondary btn-sm" href="{{ route('admin.posts.edit', $post->id) }}">
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
      </div>
   </div>
@endsection
