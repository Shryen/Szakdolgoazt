<x-layout>
    <x-admin>
        <h1>Válassza ki az osztályt!</h1>
        <div class="admin-choose">
           @foreach($schoolClasses->sortBy('name', SORT_NATURAL)->groupBy(fn ($c) => \Illuminate\Support\Str::before($c->name, '/')) as $classes)
                <div class="admin-column">
                    @foreach($classes as $class)
                        <a href="/jegyek/{{ $class->id }}">{{ $class->name }}</a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </x-admin>
</x-layout>