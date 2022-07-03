<!-- Clickable image -->
<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
    </a>
</div>
<div class="card-body">
    <!-- heart button + no. of likes + categories -->
    <div class="row align-center">
        <div class="col-auto">
            @if ($post->isLiked())
                <form action="{{ route('like.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    {{-- To keep the location when user press this button --}}
                    {{-- <input type="hidden" name="scroll_top" class="st" value="0"> --}}

                    <button type="submit" class="btn btn-sm shadow-none ps-0"><i class="fa-solid fa-heart text-danger"></i></button>
                    <span>{{ $post->likes->count() }}</span>
                </form>
            @else
                <form action="{{ route('like.store', $post->id) }}" method="post">
                    @csrf

                    <button type="submit" class="btn btn-sm shadow-none ps-0"><i class="fa-regular fa-heart"></i></button>
                    <span>{{ $post->likes->count() }}</span>
                </form>
            @endif
        </div>
        <div class="col text-end">
            @if ($post->categoryPost->count() == 0)
                <div class="badge bg-dark">Uncategorized</div>                
            @endif
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- owner + description -->
    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>

    <!-- Include comments here -->
    @include('users.posts.contents.comments')
</div>