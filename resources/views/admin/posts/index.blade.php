@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card border-dark">
               <div class="card-header text-white bg-dark d-flex justify-content-between">
                  <span>Posts Manager</span>
                  <a class="btn btn-success btn-sm" href="{{ route('admin.posts.create') }}">
                     <i class="fa-solid fa-plus"></i>
                  </a>
               </div>

               <div class="card-body bg-secondary">
                  @if (session('status'))
                     <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                     </div>
                  @endif

                  {{-- POSTS TABLE --}}
                  <table class="table table-dark">
                     <thead>
                        <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Title</th>
                           <th scope="col">Category</th>
                           <th scope="col">Tags</th>
                           <th scope="col">Slug</th>
                           <th scope="col">Updated at</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($posts as $post)
                           <tr>
                              <th scope="row">{{ $post->id }}</th>
                              <td>{{ $post->title }}</td>
                              <td>
                                 <span style="background-color: {{ $post->category->color }}"
                                    class="badge badge-pill text-uppercase">{{ $post->category->name }}</span>
                              </td>
                              {{-- TAGS --}}
                              <td>
                                 <div class="d-flex flex-column align-items-start">
                                    @forelse ($post->tags as $tag)
                                       <a href="{{ route('admin.tags.posts', $tag->id) }}" type="button"
                                          style="background-color: {{ $tag->color }}"
                                          class="badge badge-pill text-uppercase my-1">
                                          {{ $tag->name }}
                                       </a>
                                    @empty
                                       <span>- - -</span>
                                    @endforelse
                                 </div>
                              </td>
                              <td>{{ $post->slug }}</td>
                              <td>{{ $post->itaDate() }}</td>
                              <td>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex mr-3">
                                       {{-- DETAILS --}}
                                       <a class="btn btn-primary btn-sm mr-2"
                                          href="{{ route('admin.posts.show', $post->id) }}">
                                          <i class="fa-solid fa-circle-info"></i>
                                       </a>
                                       {{-- EDIT --}}
                                       <a class="btn btn-secondary btn-sm mr-2"
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
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            @if ($posts->hasPages())
               {{ $posts->links() }}
            @endif
         </div>
      </div>
   </div>
@endsection
