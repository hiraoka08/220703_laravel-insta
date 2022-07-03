@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3"  style="padding-top: 100px">
            <label for="category" class="form-label fw-bold d-block">
                Category <span class="text-muted fw-normal">(Up to 3)</span>
            </label>

            @foreach($all_categories as $category)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="category[]" id="{{ $category->name }}" class="form-check-input" value="{{ $category->id }}">
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
            @error('category')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
        
        
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind">{{ old('description') }}</textarea>

            @error('description')
                <p class="text-danger small">{{ $message }}</p>
            @enderror

        </div>

        <div class="mb-4">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
            <div id="image-info" class="form-text">
                Acceptable format: jpeg, jpg, png, gif only<br>
                Max file size is 1048KB
            </div>

            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary px-5">Post</button>
            
            <!-- <div class="row"></div> -->
            
            
        
    </form>
@endsection