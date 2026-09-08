<x-layout>
    <h1>Hírfolyam</h1>
       @if(count($posts) <= 0)
            <p>Sajnos még nincs semmilyen hír.</p>
        @endif
    <div class="posts">
        @foreach($posts as $post)
            <div class="post-card">
                <p>{{$post->title}}</p>
                <p>{{$post->content}}</p>
            </div>
        @endforeach
    </div>

</x-layout>