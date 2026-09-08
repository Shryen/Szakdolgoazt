<x-layout>
    <h1>Hírfolyam</h1>
       @if(count($posts) <= 0)
            <p>Sajnos még nincs semmilyen hír.</p>
        @endif
    <div class="posts">
        @foreach($posts as $post)
            <div class="post-card">
                <p class="feed-post-author">{{$post->author?->first_name}}</p>
                <p class="feed-post-title"><a href="/hirfolyam/{{$post->id}}">{{$post->title}}</a></p>
                <p class="feed-post-content">{{$post->content}}</p>
            </div>
        @endforeach
    </div>

</x-layout>