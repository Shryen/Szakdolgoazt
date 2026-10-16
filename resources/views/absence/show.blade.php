<x-layout>
    <x-admin>  
        <div class="student-list">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            @endif
            <h2>{{$lesson->start_time->format("Y.m.d H:i")}}</h2>
            <h3>Válaszd ki a hiányzó diákot:</h3>
            @foreach ($students as $student)
           
            <form action="/hianyzas/{{$lesson->id}}" method="POST" onsubmit="return confirm('Biztosan be szertnéd írni hiányzónak?')">
                @csrf
                <input type="hidden" value="{{$student->id}}" name="student_id">
                <input type="hidden" value="{{$subject->id}}" name="subject_id">
                <input type="hidden" value="{{$lesson->start_time->format("Y-m-d")}}" name="date">
                <input type="hidden" value=0 name="is_justified">
                <input type="hidden" name="justification_reason">
                <input type="hidden" value="{{$lesson->id}}" name="lesson_id">
                <button>{{$student->first_name}} {{$student->last_name}}</button>
            </form>
             @endforeach
        </div>
    </x-admin>
</x-layout>