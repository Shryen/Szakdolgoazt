<x-layout>
    <div class="messages-page">

        <header class="messages-header">
            <a href="/uzenet/uj" class="btn">Új üzenet küldése</a>
            <a href="{{ url()->current() }}" class="btn">Üzenetek frissítése</a>
        </header>

        {{-- Bal oszlop: beszélgetések --}}
        <aside class="message-list">
            @foreach($conversations as $conversation)
                @php
                    $partner = $conversation->sender_id === auth()->id()
                        ? $conversation->receiver
                        : $conversation->sender;
                @endphp
                <a href="/uzenet/{{ $partner->id }}"
                   class="message-list-item {{ isset($otherUser) && $otherUser->id === $partner->id ? 'active' : '' }}">
                    <span class="message-list-name">{{ $partner->first_name }} {{ $partner->last_name }}</span>
                    <span class="message-list-preview">{{ \Illuminate\Support\Str::limit($conversation->body, 40) }}</span>
                </a>
            @endforeach
        </aside>

        {{-- Jobb oszlop: chat --}}
        <section class="chat">
            @isset($otherUser)
                <div class="chat-header">
                    {{ $otherUser->first_name }} {{ $otherUser->last_name }}
                </div>

                {{-- $chatMessages: legújabb elöl (latest()) --}}
                <div class="chat-messages">
                    @foreach($chatMessages as $message)
                        <div class="bubble {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}">
                            {{ $message->content }}
                        </div>
                    @endforeach
                </div>

                <form class="chat-footer" method="POST" action="/uzenet">
                    @csrf
                    <input type="text" name="content" placeholder="Írj üzenetet..." autocomplete="off" required>
                    <input type="hidden" name="receiver_id" value="{{$otherUser->id}}">
                    <button type="submit" class="btn">Küldés</button>
                </form>
            @else
                <div class="chat-empty">Válassz egy beszélgetést a bal oldalon.</div>
            @endisset
        </section>

    </div>
</x-layout>