<x-layout>
    <div class="student-page">
        <div class="student-page-header">
            <a href="/profil" class="btn">← Profil</a>
            <h1>Hiányzásaim</h1>
        </div>

        @if($absences->isEmpty())
            <p class="student-empty">Nincs rögzített hiányzásod.</p>
        @else
            <div class="student-table-wrapper">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th>Dátum</th>
                            <th>Óra</th>
                            <th>Tantárgy</th>
                            <th>Tanár</th>
                            <th>Igazolt</th>
                            <th>Indoklás</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absences as $absence)
                            <tr>
                                <td>{{ $absence->date->format('Y.m.d.') }}</td>
                                <td>
                                    @if($absence->lesson)
                                        {{ $absence->lesson->start_time->format('G:i') }}&nbsp;-&nbsp;{{ $absence->lesson->end_time->format('G:i') }}
                                    @else
                                        –
                                    @endif
                                </td>
                                <td>{{ $absence->lesson?->subject?->name ?? '–' }}</td>
                                <td>{{ $absence->teacher?->first_name }} {{ $absence->teacher?->last_name }}</td>
                                <td>{{ $absence->is_justified ? 'Igen' : 'Nem' }}</td>
                                <td>{{ $absence->justification_reason ?? '–' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>