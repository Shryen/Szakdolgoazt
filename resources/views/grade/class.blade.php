<x-layout>
    <x-admin>
        <h1>Válassza ki a diákot</h1>
        <div class="student-choose">
            @foreach($students->sortBy(fn ($s) => \Illuminate\Support\Str::ascii($s->first_name . ' ' . $s->last_name), SORT_NATURAL | SORT_FLAG_CASE) as $student)
                <a href="/jegyek/{{ $student->school_class_id }}/{{ $student->id }}">{{ $student->first_name . ' ' . $student->last_name }}</a>
            @endforeach
        </div>
    </x-admin>
</x-layout>