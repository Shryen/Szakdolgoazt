<x-layout>
    <div class="grades-table-wrapper">
        <table class="grades-table">

            <thead>
                <tr>
                    <th class="subject-header">Tantárgy</th>

                    @foreach ($gradesByMonthAndSubject['grades'] as $month => $grades)
                        <th>{{ $month }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>

                @foreach ($gradesByMonthAndSubject['subjects'] as $subject)

                    <tr>
                        <th class="subject-name">
                            {{ $subject->name }}
                        </th>

                        @foreach ($gradesByMonthAndSubject['grades'] as $month => $grades)

                            <td class="grade-cell">

                                @if (isset($grades[$subject->name]))

                                    @foreach ($grades[$subject->name] as $grade)
                                        <span class="grade">
                                            {{ $grade->grade }}
                                        </span>
                                    @endforeach

                                @else
                                    <span class="no-grade">—</span>
                                @endif

                            </td>

                        @endforeach
                    </tr>

                @endforeach

            </tbody>

        </table>
    </div>

</x-layout>