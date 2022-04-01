<div class="card">
   <div class="card-body">
      @if ($post->exists)
         <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
         @else
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
      @endif
      @csrf
      @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>
                     {{ $error }}
                  </li>
               @endforeach
            </ul>
         </div>
      @endif
      {{-- FORM TITLE POST --}}
      <div class="row">
         <div class="col-10">
            <div class="form-group">
               <label for="title">Title</label>
               <input name="title" type="text" class="form-control" id="title" placeholder="Enter title"
                  value="{{ old('title', $post->title) }}">
               <small class="form-text text-muted">Post title</small>
            </div>
         </div>
         {{-- FORM CATEGORY --}}
         <div class="col-2">
            <div class="form-group">
               <label for="category">Category</label>
               <select class="custom-select" name="category_id" id="category">
                  <option value>Select a category</option>
                  @foreach ($categories as $category)
                     <option class="text-capitalize" value="{{ $category->id }}"
                        @if (old('category_id', $post->category_id) == $category->id) selected @endif>{{ $category->name }}
                     </option>
                  @endforeach
               </select>
            </div>
         </div>
         {{-- FORM CONTENT --}}
         <div class="col-12">
            <div class="form-group">
               <label for="content">Content</label>
               <textarea class="w-100" name="content" id="content" rows="9">{{ old('content', $post->content) }}</textarea>
            </div>
         </div>
         {{-- FORM IMAGE --}}
         <div class="col-12">
            <div class="form-group">
               <label for="img">Image</label>
               <input class="d-block" type="file" name="img" id="img">
            </div>
         </div>
         <div class="col-12">
            {{-- CHECKBOX TAGS --}}
            <div class="form-check form-check-inline">
               @foreach ($tags as $tag)
                  {{-- name="tags[]" da alla request un array di valori --}}
                  <input type="checkbox" class="form-check-input" name="tags[]" id="tag-{{ $loop->iteration }}"
                     value="{{ $tag->id }}" @if (in_array($tag->id, old('tags', $selected_ids ?? []))) checked @endif>
                  <label class="form-check-label text-capitalize mr-2" for="tag-{{ $loop->iteration }}">
                     {{ $tag->name }}
                  </label>
               @endforeach
            </div>
         </div>
         <div class="col-12">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i></button>
         </div>
      </div>
      </form>
   </div>
</div>
