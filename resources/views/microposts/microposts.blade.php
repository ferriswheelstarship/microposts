<ul class="list-unstyled">
    @foreach ($microposts as $micropost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                </div>
                <div>postID:{{ $micropost->id }}</div>
                <div>
                    <p class="mb-2">{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                <div class="row ml-1 mr-1 mb-2">
                    @if (Auth::id() == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                    
                    @if (Auth::user()->is_favorite($micropost->id))
                      {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Unfavorite', ['class' => "btn btn-warning btn-sm"]) !!}
                      {!! Form::close() !!}
                    @else
                      {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
                        {!! Form::submit('favorite', ['class' => "btn btn-primary btn-sm"]) !!}
                      {!! Form::close() !!}
                    @endif
                    
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $microposts->links('pagination::bootstrap-4') }}