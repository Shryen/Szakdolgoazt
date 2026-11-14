<x-layout>
    <div class="student-page">
        <div class="student-page-header">
            <a href="/profil" class="btn">← Profil</a>
            <h1>{{ now()->locale('hu')->isoFormat('YYYY. MMMM D., dddd') }}</h1>
        </div>

        @if($grid->isEmpty())
            <p class="student-empty">
                @if($isStudent && ! $classId)
                    Nem vagy osztályba sorolva, ezért nincs órarended.
                @else
                    Még nincs órarend felvéve.
                @endif
            </p>
        @else
            <div class="student-table-wrapper">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Hétfő</th>
                            <th>Kedd</th>
                            <th>Szerda</th>
                            <th>Csütörtök</th>
                            <th>Péntek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grid as $row)
                            <tr>
                                <th>
                                    {{ $row->first()->start_time->format('G:i') }}&nbsp;-&nbsp;{{ $row->first()->end_time->format('G:i') }}
                                </th>
                                @foreach(range(0, 4) as $day)
                                    @php($lesson = $row->get($day))
                                    <td>
                                        @if($lesson)
                                            <span class="timetable-subject">{{ $lesson->subject?->name }}</span>
                                            @unless($isStudent)
                                                <span class="timetable-class">{{ $lesson->schoolClass?->name }}</span>
                                            @endunless
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>