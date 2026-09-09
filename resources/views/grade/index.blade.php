<x-layout>
    <x-admin>
        @foreach($schoolClasses as $class)
            <a href="/jegyek/{{$class->id}}">{{$class->name}}</a>
        @endforeach
    </x-admin>
</x-layout>