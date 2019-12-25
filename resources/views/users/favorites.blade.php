@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            <div>{{ $favorites }}</div>
            @include('users.navtabs', ['user' => $user])
            @if (count($favorites) > 0)
                <ul class="list-unstyled">
                    @foreach ($favorites as $favorite)
                        <li class="media">
                            <img class="mr-2 rounded" src="{{ Gravatar::src($favorite->user->email, 50) }}" alt="">
                            <div class="media-body">
                                <div>
                                    {!! link_to_route('users.show', $favorite->user->name, ['id' => $favorite->user_id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
                                </div>
                                <div>
                                    postID:{{ $favorite->pivot->micropost_id }}
                                </div>
                                <div>
                                    <p class="mb-2">{{ $favorite->content }}</p>
                                </div>
                                <div class="row ml-1 mr-1 mb-2">
                                    @if (Auth::id() == $favorite->user_id)
                                        {!! Form::open(['route' => ['microposts.destroy', $favorite->pivot->micropost_id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                    
                                    @if (Auth::user()->is_favorite($favorite->pivot->micropost_id))
                                      {!! Form::open(['route' => ['favorites.unfavorite', $favorite->pivot->micropost_id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Unfavorite', ['class' => "btn btn-warning btn-sm"]) !!}
                                      {!! Form::close() !!}
                                    @else
                                      {!! Form::open(['route' => ['favorites.favorite', $favorite->pivot->micropost_id]]) !!}
                                        {!! Form::submit('favorite', ['class' => "btn btn-primary btn-sm"]) !!}
                                      {!! Form::close() !!}
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{ $favorites->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection