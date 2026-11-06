<x-layout>
    <div class="new-message">

        <header class="new-message-header">
            <a href="/uzenetek" class="btn">← Vissza</a>
            <h1>Új üzenet</h1>
        </header>

        <form class="compose" method="POST" action="/uzenet">
            @csrf

            <label for="receiver_id">Címzett</label>
            <select name="receiver_id" id="receiver_id" required>
                <option value="" disabled {{ old('receiver_id') ? '' : 'selected' }}>Válassz címzettet...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('receiver_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                @endforeach
            </select>

            <label for="content">Üzenet</label>
            <textarea name="content" id="content" rows="6" placeholder="Írj üzenetet..." required>{{ old('content') }}</textarea>

            @if($errors->any())
                <div class="compose-error">{{ $errors->first() }}</div>
            @endif

            <button type="submit" class="btn compose-send">Küldés</button>
        </form>

    </div>
</x-layout>