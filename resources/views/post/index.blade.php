<x-layout>
    <h1>Hírfolyam</h1>
    <input type="text" id="search" placeholder="Keresés posztok között...">
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

    <script defer>
    document.getElementById('search').addEventListener('input', function (e) {
        const query = e.target.value.toLowerCase().trim();
        const posts = document.querySelectorAll('.post-card'); // Use your post card class name

    posts.forEach(post => {
        const text = post.textContent.toLowerCase();
        // Toggle visibility based on match
            post.style.display = text.includes(query) ? '' : 'none';
        });
    });
    </script>
</x-layout>