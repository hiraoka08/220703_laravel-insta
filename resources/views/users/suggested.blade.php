@extends('layouts.app')

@section('title', 'Suggestions For You')

@section('content')
    <div class="row justify-content-center"  style="padding-top: 100px">
        <div class="col-5">
            <p class="fw-bold">Suggested</p>

            {{-- show all suggested users --}}
            @foreach ($suggested_users as $suggested_user)
                <div class="row  align-items-center mt-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $suggested_user->id) }}">
                            @if ($suggested_user->avatar)
                                <img src="{{ asset('/storage/avatars/' . $suggested_user->avatar) }}" alt="{{ $suggested_user->avatar }}" class="rounded-circle suggested-avatar">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary suggested-icon"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <div class="row">
                            <a href="{{ route('profile.show', $suggested_user->id) }}" class="text-decoration-none text-black fw-bold small">{{ $suggested_user->name }}</a>
                        </div>
                        <div class="row">
                            <span class="text-muted fs-6">{{ $suggested_user->email }}</span>
                        </div>

                        <div class="row">
                            @if ($suggested_user->isFollowingMe())
                                <span class="text-muted small">Follows you</span>
                            @elseif ($suggested_user->followers->count() == 0)
                                <span class="text-muted small">No followers yet</span>
                            @else
                                <span class="text-muted small">Followed by {{ $suggested_user->followers->count() }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">               
                        <form action="{{ route('follow.store', $suggested_user->id) }}" method="post" class="d-inline">
                            @csrf                                            

                            <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
            
            {{-- 
                SUBTITLE:
                    1. Follows you
                    2. No followers yet
                    3.Followed by /# of followers/
             --}}

        </div>
    </div>
@endsection