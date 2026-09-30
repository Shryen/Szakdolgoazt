<x-layout>
    <x-admin>
        <h1>Válassza ki az osztályt!</h1>
        <div class="admin-choose">
            @foreach($schoolClasses as $class)
                <a href="/jegyek/{{$class->id}}">{{$class->name}}</a>
            @endforeach
        </div>
    </x-admin>
</x-layout>