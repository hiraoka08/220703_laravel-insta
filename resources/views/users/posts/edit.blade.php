@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="category" class="form-label fw-bold d-block"  style="padding-top: 100px">
            Category <span class="text-muted fw-normal">(Up to 3)</span>
        </label>

        @foreach($all_categories as $category)
            <div class="form-check form-check-inline">
                @if (in_array($category->id, $selected_categories))
                    <input type="checkbox" name="category[]" id="{{ $category->name }}" class="form-check-input" value="{{ $category->id }}" checked>
                @else
                    <input type="checkbox" name="category[]" id="{{ $category->name }}" class="form-check-input" value="{{ $category->id }}">
                @endif
                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
        @endforeach
        
        @error('category')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-bold d-block">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description' ,$post->description) }}</textarea>
        @error('description')
            <p class="text-danger small">{{ $message }}</p>
        @enderror    
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="img-thumbnail w-100">
            <input type="file" name="image" class="form-control mt-1">

            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-warning px-5">Save</button>
</form>
@endsection