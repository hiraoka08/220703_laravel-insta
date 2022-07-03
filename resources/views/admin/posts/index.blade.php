@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')

        <table class="table table-hover align-middle bg-white border text-secondary" style="margin-top: 100px">
            <thead class="small table-primary text-secondary">
                <tr>
                    <th></th>
                    <th></th>
                    <th>CATEGORY</th>
                    <th>OWNER</th>
                    <th>CREATED AT</th>
                    <th>STATUS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($all_posts->isNotEmpty())
                    @foreach ($all_posts as $post)
                        <tr>
                            <td class="text-center">{{ $post->id }}</td>
                            <td>
                                <a href="{{ route('post.show', $post->id) }}">
                                    <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="d-block mx-auto admin-posts-image">
                                </a>
                                
                            </td>
                            <td>
                                @if ($post->categoryPost->count() == 0)
                                    <div class="badge bg-dark">Uncategorized</div>                
                                @endif
                                @foreach ($post->categoryPost as $category_post)
                                    <div class="badge bg-secondary bg-opacity-50">
                                        {{ $category_post->category->name }}
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
                            </td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                @if ($post->trashed())
                                    <i class="fa-solid fa-circle-minus text-secondary"></i></i>&nbsp; Hidden
                                @else
                                    <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>

                                    @if ($post->trashed())
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post-{{ $post->id }}">
                                                <i class="fa-solid fa-eye"></i> Unhide Post #{{ $post->id }}
                                            </button>
                                        </div>
                                    @else                                  
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                                                <i class="fa-solid fa-eye-slash"></i> Hide Post #{{ $post->id }}
                                            </button>
                                        </div>
                                    @endif
                                </div>
                        
                                {{-- {{ Include modal here }} --}}
                                @include('admin.posts.modal.status')
                            </td>
                        </tr>    
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="lead text-muted text-center">No posts yets.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- Paginate --}}
        {{ $all_posts->links() }}

    
@endsection

