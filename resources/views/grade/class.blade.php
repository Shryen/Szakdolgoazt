<x-layout>
    <x-admin>
        @foreach($students as $student)
            <a href="/jegyek/{{$student->school_class_id}}/{{$student->id}}">{{$student->first_name . ' ' . $student->last_name}}</a>
        @endforeach
    </x-admin>
</x-layout>