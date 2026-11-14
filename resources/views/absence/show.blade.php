<x-layout>
    <x-admin>
        <div class="absence-pick">
            <div class="absence-pick-header">
                <h2>{{ $subject->name }}</h2>
                <p>
                    {{ now()->format('Y.m.d.') }} ·
                    {{ $lesson->start_time->format('G:i') }}&nbsp;-&nbsp;{{ $lesson->end_time->format('G:i') }}
                </p>
            </div>

            @foreach($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach

            <h3>Válaszd ki a hiányzó diákot:</h3>

            <form action="/hianyzas/{{ $lesson->id }}" method="POST">
                @csrf
                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                <input type="hidden" name="date" value="{{ $lesson->start_time->format('Y-m-d') }}">
                <input type="hidden" name="is_justified" value="0">
                <input type="hidden" name="justification_reason">
                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

                <div class="absence-pick-list">
                    @foreach($students as $student)
                        <button type="submit" name="student_id" value="{{ $student->id }}"
                                onclick="return confirm(@js('Biztosan be szeretnéd írni hiányzónak: ' . $student->first_name . ' ' . $student->last_name . '?'))">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
    </x-admin>
</x-layout>