@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header text-white bg-dark d-flex justify-content-between">
                  <span>Categories Manager</span>
                  <a class="btn btn-success btn-sm" href="{{ route('admin.categories.create') }}">
                     <i class="fa-solid fa-plus"></i>
                  </a>
               </div>

               <div class="card-body bg-secondary">
                  @if (session('status'))
                     <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                     </div>
                  @endif

                  {{-- CATEGORY TABLE --}}
                  <table class="table table-dark">
                     <thead>
                        <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Category Name</th>
                           <th scope="col">Color</th>
                           <th scope="col">Updated at</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($categories as $category)
                           <tr>
                              <th scope="row">{{ $category->id }}</th>
                              <td class="text-capitalize">{{ $category->name }}</td>
                              <td>
                                 <span style="background-color:{{ $category->color }}"
                                    class="badge badge-pill">{{ $category->color }}
                                 </span>
                              </td>
                              <td>{{ $category->updated_at }}</td>
                              <td>
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center justify-content-between">
                                       {{-- DETAILS --}}
                                       <a class="btn btn-primary btn-sm m-1"
                                          href="{{ route('admin.categories.show', $category->id) }}">
                                          <i class="fa-solid fa-circle-info"></i>
                                       </a>
                                       {{-- EDIT --}}
                                       <a class="btn btn-secondary btn-sm m-1"
                                          href="{{ route('admin.categories.edit', $category->id) }}">
                                          <i class="fa-solid fa-pen-to-square"></i>
                                       </a>
                                    </div>
                                    {{-- DELETE CATEGORY --}}
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-danger btn-sm ml-3" type="submit">
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
            @if ($categories->hasPages())
               {{ $categories->links() }}
            @endif
         </div>
      </div>
   </div>
@endsection
