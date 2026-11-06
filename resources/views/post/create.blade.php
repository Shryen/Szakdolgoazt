<x-layout>
    <x-admin>
        <x-form action='/hirfolyam'>
            <h1>Hír létrehozása</h1>
            <input type="hidden" name="author_id">
            <input type="text" name="title" placeholder="Hír címe" required>
            <textarea name="content" required></textarea>
            <button type="submit">Poszt</button>
        </x-form>
    </x-admin>
</x-layout>

<style>
    document.getElementById('content').addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.isComposing) {
            e.preventDefault();
            this.setRangeText('<br/>\n', this.selectionStart, this.selectionEnd, 'end');
        }
    });
</style>