<x-layout>
    <x-form action='/hirfolyam'>
        <h1>Hír létrehozása</h1>
        <input type="hidden" name="author_id">
        <input type="text" name="title" placeholder="Hír címe" required>
        <textarea name="content" required></textarea>
        <button type="submit">Poszt</button>
    </x-form>
</x-layout>