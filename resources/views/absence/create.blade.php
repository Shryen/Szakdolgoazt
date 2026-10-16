<x-layout>
    <x-admin>  
        <div class="absence-table">

        @if($currentWeek)
            <div class="absence-table-time">
                <strong>{{ $currentWeek->week_number }}. hét</strong>
                {{ $currentWeek->start_date->format('Y.m.d') }} - {{ $currentWeek->end_date->format('Y.m.d') }}
            </div>
        @else
            <div class="error">
                Úgy tűnik ezen a héten nincsenek óráid.
            </div>
        @endif


            @forelse($lessons as $lesson)
                <div class="absence-table-lessons">
                    <a href="/hianyzas/{{$lesson->id}}">
                        <p>{{ $lesson->subject->name }}</p>
                           <p>
                                <strong>Osztály:</strong> {{ $lesson->schoolClass->name }}<br>
                                <strong>Nap:</strong>
                                @php
                                    $days = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap'];
                                @endphp
                                {{ $days[$lesson->day_of_week] }}<br>
                                <strong>Idő:</strong> {{ $lesson->start_time->format('H:i') }} - {{ $lesson->end_time->format('H:i') }}
                            </p>
                    </a>
                </div>
            @empty
                <p>Úgy tűnik ezen a héten nincsenek óráid</p>
            @endforelse
        </div>    
    </x-admin>
</x-layout>