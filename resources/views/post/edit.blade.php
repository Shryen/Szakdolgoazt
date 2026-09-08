<x-layout>
    <x-form action="/hirfolyam/szerkeszt/{{$post->id}}">
        @method('PUT')
        <h1>Hír szerkesztése: {{$post->title}}</h1>
        <input type="text" name="title" value="{{$post->title}}">
        <textarea name="content" id="" cols="30" rows="10">{{$post->content}}</textarea>
        <button type="submit">Szerkesztés</button>
    </x-form>
</x-layout>