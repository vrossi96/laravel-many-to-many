@if ($category->exists)
   <form class="row" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
      @method('PUT')
   @else
      <form class="row" action="{{ route('admin.categories.store') }}" method="POST">
@endif
@csrf
{{-- FORM NAME CATEGORY --}}
<div class="form-group col-md-10">
   <label for="name">Category Name</label>
   <input name="name" type="text" class="form-control" id="name" placeholder="Enter a name for the category"
      value="{{ old('title', $category->name) }}">
   <small class="form-text text-muted">Category name</small>
</div>
{{-- FORM COLOR --}}
<div class="form-group col-md-2">
   <label for="color">Category</label>
   <input class="form-control" type="color" id="color" name="color" value="{{ old('title', $category->color) }}">
</div>
{{-- <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
   </div> --}}
<div class="col-md-12">
   <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i></button>
</div>
</form>
