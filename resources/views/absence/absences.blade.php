<x-layout>
    <x-admin>
        <div class="absence-content">
    
            <div class="absence-header">
                    <strong>Osztály</strong>
                    <strong>Diák neve</strong>
                    <strong>Óra kezdete</strong>
                    <strong>Óra vége</strong>
                    <strong>Törlés/Szerkesztés</strong>
            </div>
    
            <div class="absence-list">
                @foreach($absences as $absence)
                    <p>{{$absence->lesson->schoolClass->name}}</p>
                    <p>{{$absence->student->first_name}} {{$absence->student->last_name}}</p>
                    <p>{{$absence->lesson->start_time->format("Y.m.d H:i")}}</p>
                    <p>{{$absence->lesson->end_time->format("Y.m.d H:i")}}</p>

                <div>
                    <x-form action="/hianyzas/torles/{{$absence->id}}" method="POST" class="hidden-form">
                        @csrf
                        <button> X </button>
                    </x-form>
                    
                    <a href="/hianyzas/szerkeszt/{{$absence->id}}"> / </a>
                </div>

                @endforeach
            </div>

        </div>
    </x-admin>
</x-layout>