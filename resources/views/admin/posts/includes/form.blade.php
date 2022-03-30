<div class="card">
   <div class="card-body">
      @if ($post->exists)
         <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
            @method('PUT')
         @else
            <form action="{{ route('admin.posts.store') }}" method="POST">
      @endif
      @csrf
      <div class="row">
         <div class="col-12">
            <div class="form-group">
               <label for="title">Title</label>
               <input name="title" type="text" class="form-control" id="title" placeholder="Enter title"
                  value="{{ old('title', $post->title) }}">
               <small class="form-text text-muted">Post title</small>
            </div>
         </div>
         <div class="col-12">
            <div class="form-group">
               <label for="content">Content</label>
               <textarea class="w-100" name="content" id="content" rows="9">{{ old('content', $post->content) }}</textarea>
            </div>
         </div>
         <div class="col-12">
            <div class="form-group">
               <label for="img">Image</label>
               <input class="w-100" type="text" name="img" id="img" value="{{ old('img', $post->img) }}">
            </div>
         </div>
         <div class="col-12">
            {{-- CHECKBOX TAGS --}}
            <div class="form-check form-check-inline">
               @foreach ($tags as $tag)
                  <input type="checkbox" class="form-check-input" id="tag-{{ $loop->iteration }}">
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
