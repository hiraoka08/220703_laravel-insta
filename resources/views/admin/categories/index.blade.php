@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post" class="mb-4">
        @csrf

        <div class="row gx-2"  style="margin-top: 100px">
            <div class="col-4">
                <input type="text" name="name" class="form-control" placeholder="Add a category..." autofocus>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> ADD</button>
            </div>
            {{-- ERROR --}}
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>

    <div class="row">
        <div class="col-8">
            <table class="table tavle-hover align-middle bg-white border table-sm text-secondary text-center">
                <thead class="table-warning small text-secondary mb-3">
                    <th>#</th>
                    <th>NAME</th>
                    <th>COUNT</th>
                    <th>LAST UPDATED</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="text-dark">{{ $category->name }}</td>
                            <td>{{ $category->categoryPost->count() }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                {{-- Edit Button --}}
                                <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                
                                {{-- Delete Button --}}
                                <button class="btn btn-outline-danger btn-sm me-2" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Edit">
                                    <i class="fa-solid fa-trash"></i>
                                </button>                                
                            </td>
                        </tr>
                        
                        {{-- Include modal here --}}
                        @include('admin.categories.modal.action')
                    @endforeach
                    <tr>
                        <td></td>
                        <td class="text-dark">Uncategorized</td>
                        <td>{{ $uncategorized_count }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection