@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header text-white bg-dark">
                  Tag: <span class="text-capitalize">{{ $tag->name }}</span>
               </div>
               <div class="card-body text-white bg-secondary">
                  <ul>
                     @foreach ($tag->posts as $post)
                        <li>
                           <div class="d-flex">
                              <p>
                                 {{ $post->title }}
                              </p>
                              <div class="mx-3">
                                 {{-- DETAILS --}}
                                 <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.show', $post->id) }}">
                                    <i class="fa-solid fa-circle-info"></i>
                                 </a>
                                 {{-- EDIT --}}
                                 <a class="btn btn-warning btn-sm" href="{{ route('admin.posts.edit', $post->id) }}">
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
                        </li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
