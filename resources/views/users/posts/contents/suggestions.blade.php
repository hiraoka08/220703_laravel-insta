@if ($suggested_users)
    <div class="row">
        <div class="col">
            <p class="fw-bold text-secondary">Suggestions For You</p>
        </div>
        <div class="col-auto fw-bold">
            <a href="{{ route('showSuggestedUsers') }}" class="fw-bold text-dark text-decoration-none small">See all</a>
        </div>
    </div>

    @foreach (array_slice($suggested_users, 0, 10) as $suggested_user)
        <div class="row  align-items-center mt-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $suggested_user->id) }}">
                    @if ($suggested_user->avatar)
                        <img src="{{ asset('/storage/avatars/' . $suggested_user->avatar) }}" alt="{{ $suggested_user->avatar }}" class="rounded-circle user-avatar">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary user-icon"></i>
                    @endif
                </a>
            </div>
            <div class="col ps-0 text-truncate">
                <a href="{{ route('profile.show', $suggested_user->id) }}" class="text-decoration-none text-black fw-bold small">{{ $suggested_user->name }}</a>
            </div>
            <div class="col-auto">               
                <form action="{{ route('follow.store', $suggested_user->id) }}" method="post" class="d-inline">
                    @csrf                                            

                    <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                </form>
            </div>
        </div>
    @endforeach
@else
    <p class="fw-bold text-secondary text-center">No more suggestion for you.</p>
@endif


