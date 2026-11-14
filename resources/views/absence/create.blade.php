<x-layout>
    <x-admin>
        @php($days = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek'])

        <div class="absence-table">

            @if($currentWeek)
                <div class="absence-table-time">
                    <strong>{{ $currentWeek->week_number }}. hét</strong>
                    <span>{{ $currentWeek->start_date->format('Y.m.d.') }} - {{ $currentWeek->end_date->format('Y.m.d.') }}</span>
                </div>
            @endif

            @if($lessons->isEmpty())
                <p class="error">Úgy tűnik, ezen a héten nincsenek óráid.</p>
            @else
                @php($byDay = $lessons->groupBy('day_of_week'))

                <div class="absence-week">
                    @foreach($days as $i => $name)
                        <div @class(['absence-day', 'today' => now()->dayOfWeekIso - 1 === $i])>
                            <h3 class="absence-day-name">{{ $name }}</h3>

                            @forelse(($byDay->get($i) ?? collect())->sortBy(fn ($l) => $l->start_time->format('H:i')) as $lesson)
                                <a href="/hianyzas/{{ $lesson->id }}" class="absence-table-lessons">
                                    <span class="absence-lesson-time">
                                        {{ $lesson->start_time->format('G:i') }}&nbsp;-&nbsp;{{ $lesson->end_time->format('G:i') }}
                                    </span>
                                    <span class="absence-lesson-subject">{{ $lesson->subject->name }}</span>
                                    <span class="absence-lesson-class">{{ $lesson->schoolClass->name }}</span>
                                </a>
                            @empty
                                <p class="absence-day-empty">–</p>
                            @endforelse
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </x-admin>
</x-layout>