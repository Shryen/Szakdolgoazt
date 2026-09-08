<x-layout>
    <div class="post">
        <div class="post-sidebar">
            <div>
                <h1>{{$post->title}}</h1>
                <p>{{$post->author?->first_name}}</p>
                <p class="post-date">{{$post->created_at}}</p>
            </div>
            <div>
                <a href="/hirfolyam">Vissza</a>
                @if($post?->author_id === auth()->id() || auth()?->user()?->role === 'admin')
                    <a href="/hirfolyam/szerkesztes/{{$post->id}}">Szerkesztés</a>
                    <a href="/hirfolyam/torles/{{$post->id}}">Törlés</a>
                @endif
            </div>
        </div>
        <div class="post-content">
            {{$post->content}}
        </div>
    </div>
</x-layout>