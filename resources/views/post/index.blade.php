<x-layout>
    <h1>Hírfolyam</h1>

    <x-form action="" method="GET">
        <input type="text" id="search" name="q" value="{{ request('q') }}"  placeholder="Keresés posztok között...">
        <button>Keresés</button>    
    </x-form>

       @if(count($posts) <= 0)
            <p>
                @if(request()->filled('q'))
                    Nincs találat a(z) „{{ request('q') }}” keresésre. <a href="/hirfolyam">Összes hír</a>
                 @else
                    Sajnos még nincs semmilyen hír.
                 @endif
            </p>
        @endif

    <div class="posts">
        @foreach($posts as $post)
            <div class="post-card">
                <p class="feed-post-author">{{$post->author?->first_name}}</p>
                <p class="feed-post-title"><a href="/hirfolyam/{{$post->id}}">{{$post->title}}</a></p>
                <p class="feed-post-content">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p> <!-- Maximum 100 karakter -->
            </div>
        @endforeach
    </div>

</x-layout>