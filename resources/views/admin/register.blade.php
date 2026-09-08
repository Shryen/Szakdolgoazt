<x-layout>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('username'))
        <p>Felhasználónév: {{ session('username') }}</p>
        <p>Jelszó: {{ session('password') }}</p>
    @endif

    <x-form action="/register"> <!-- a form komponensünk alapjáraton post methodot használ így azt nem írjuk felül -->
        <h1>Diák felvétele</h1>
        <input type="text" name="last_name" placeholder="Vezetéknév" required>
        <input type="text" name="first_name" placeholder="Keresztnév" required>
        <input type="text" name="mothers_name" placeholder="Anyja neve" required>
        <input type="text" name="address" placeholder="Lakcím" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Felvétel</button>
    </x-form>
</x-layout>