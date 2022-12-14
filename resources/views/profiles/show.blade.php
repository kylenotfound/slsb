@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-2">
                <div class="card shadow p-3 rounded border border-3 border-dark">
                    <div class="card-body">
                        <div class="col text-end">
                            @if(auth()->id() != $user->getId())
                                <follow
                                    user-id="{{ $user->getId() }}"
                                    state="{{ auth()->user()->isFollowing($user) }}"
                                    followers-count="{{ count($user->followers) }}"
                                    following-count="{{ count($user->following) }}"
                                />
                            @endif
                        </div>
                        <div class="col tex-start">
                            @inject('userTypes', 'App\Models\UserType')
                            @if ($user->isAdmin() && $user == auth()->user())
                                <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill border border-2 border-dark">Dashboard</a>
                            @endif
                        </div>
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ $user->profile->avatar }}" alt="Admin" class="rounded-circle border border-5 border-dark" width="110">
                            <div class="mt-3">
                                <h3>{{ $user->username }}</h3>
                                <div class="row d-flex justify-content-center m-0 p-0">
                                    @if($user->twitch_name)
                                        <div class="mb-2 mt-1 d-inline">
                                            <a target="_blank" href="https://www.twitch.tv/{{$user->twitch_name}}" class="fw-bold m-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M2.149 0l-1.612 4.119v16.836h5.731v3.045h3.224l3.045-3.045h4.657l6.269-6.269v-14.686h-21.314zm19.164 13.612l-3.582 3.582h-5.731l-3.045 3.045v-3.045h-4.836v-15.045h17.194v11.463zm-3.582-7.343v6.262h-2.149v-6.262h2.149zm-5.731 0v6.262h-2.149v-6.262h2.149z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                                            </a>
                                            <i class="fa-solid fa-check-circle"></i>
                                        </div>
                                    @endif
                                </div>
                                <span class="fw-bold">{{ $user->getFullNameAttribute() != '' ? $user->getFullNameAttribute() : '' }}</span>
                                <span class="text-muted font-size-sm">{{ $user->profile->location }}</span>
                                <p class="mb-2">{{ $user->profile->bio }}</p>
                                <div class="row">
                                    <div class="col">
                                        @if(auth()->id() == $user->getId())
                                            <a class="btn btn-sm btn-primary border border-2 border-dark mx-1"
                                              href="{{ route('profile.edit', ['id' => $user->username]) }}">
                                              <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-sm btn-secondary border border-2 border-dark"
                                                href="{{ route('user.settings', ['id' => auth()->user()->username ])}}">
                                                <i class="fa-solid fa-gear"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row d-flex justify-content-center">
                            <div class="col text-center m-0 p-0">
                                <followcounter
                                    followers-count="{{ count($user->followers) }}"
                                    following-count="{{ count($user->following) }}"
                                    followers-list="{{ route('user.follower_list', ['id' => $user->username]) }}"
                                    following-list="{{ route('user.following_list', ['id' => $user->username]) }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-2">
                <div class="card card-body border border-3 border-dark">
                    <h2 class="mt-2 mb-1">Featured Post &#128204;</h2>
                </div>
                @if ($featuredPost)
                    <div class="border border-3 border-dark mt-2 rounded">
                        @include('includes.markdown_content', ['post' => $featuredPost])
                    </div>
                @else
                    <div class="card card-body border border-3 border-dark mt-2 rounded h-50">
                        <h5 class="mx-2 mt-2 mb-0">{{ $user->username }} has no featured post.</h5 >
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card shadow p-3 rounded border border-3 border-dark">
                    @include('profiles.partials.tabs.root')
                </div>
            </div>
        </div>
    </div>
@endsection
