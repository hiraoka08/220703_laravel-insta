@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5" style="margin-top: 100px">
        <div class="col-8">
            @if ($all_posts->isNotEmpty())
                @foreach ($all_posts as $post)
                    @if ($post->user->isFollowed() || $post->user->id === Auth::user()->id)
                        <div class="card mb-4">
                            @include('users.posts.contents.title')
                            @include('users.posts.contents.body')
                        </div>
                    @endif
                @endforeach
            @else
                <!-- If the site doesn't have any posts yet. -->
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you share photos, they will appear on your profile.</p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first photo</a>
                </div>
            @endif
        </div>
        <div class="col-4">
            <!-- Profile Pverview -->
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/avatars/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->avatar }}" class="rounded-circle overview-avatar">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary overview-icon"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                    <p class="text-muted small">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Suggestions -->
            @include('users.posts.contents.suggestions')
        </div>
    </div>
@endsection
