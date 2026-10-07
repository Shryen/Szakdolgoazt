<x-layout>
    @php
        $grades = $gradesByMonthAndSubject['grades']; // jegyek alapján keresünk
        $subjects = $gradesByMonthAndSubject['subjects']; // tantárgyak alapján keresünk
        $cellID = 0;
    @endphp
    <h1>{{$student->first_name}} {{$student->last_name}} jegyei</h1>
    <br/>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-error>{{$error}}</x-error>
        @endforeach
    @endif
    <h1>Útmutató</h1>
    <p class="grade-alert">Ne felejtsen el a mentés gombra kattintani!</p>
    <p onclick="Handler.ShowHelp()" id="helpText">Útmutató megjelenítése</p>
    <div class="grade-header" id="help">
        <div>
            <h2>Jegy hozzáadása</h2>
            <hr>
            <p>Jegyek hozzáádasához kattintson a + gombra a táblázaton belül a kívánt tantrágyra és a kívánt hónapra.</p>
            <p>Írja be az értékelést az első mezőbe majd az indoklást a második mezőbe (pl.: Témazáró).</p>
        </div>
        <div>
            <h2>Jegy szerkesztése</h2>
            <hr>
            <p>Jegy szerkesztéséhez kattintson a már meglévő jegyre és válassza ki, hogy szerkeszteni szeretné.</p>
            <p>A mezőben jelen lesz az eredeti jegy, amit át kell írni az új jegyre, majd a mentés gombra kattintani.</p>
        </div>
        <div>
            <h2>Jegy törlése</h2>
            <hr>
            <p>A jegy törléséhez kattintosn a már meglévő jegyre és válassza a törlés gombot.</p>
            <p>Ha bizonyos abban, hogy jó jegyet választott ki, erősítse meg döntését.</p>
        </div>
    </div>

    <div class="grades-table-wrapper">
        <table class="grades-table">
            <thead>
                <tr>
                    <!-- Hónapok fejlécként -->
                    <th class="subject-header">Tantárgy</th>
                    @foreach ($grades as $month => $subjectGrades)
                        <th>{{ $month }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <!-- Tantárgyak bal oldalt első oszlop -->
                        <td class="subject-name">{{ $subject->name }}</td>

                        <!-- Cellák -->
                        @foreach ($grades as $month => $subjectGrades)
                            <td>
                                @foreach ($subjectGrades[$subject->name] ?? [] as $grade)
                                    <span class="grade" 

                                        onclick="Handler.SelectGrade( 
                                        @js($subject->id), 
                                        @js($subject->name), 
                                        @js($month), 
                                        @js($grade->grade_value),
                                        @js($grade->id),
                                        @js($grade->description),
                                        @js($student->id)
                                        )" 

                                        id="{{$cellID++}}"> {{ $grade->grade_value }} </span>
                                @endforeach
                                 <span class="no-grade" 
                                        onclick="Handler.AddGrade( 
                                        @js($subject->id), 
                                        @js($subject->name), 
                                        @js($month), 
                                        @js(0), 
                                        @js($student->id) )" 
                                        id="{{$cellID++}}"> + </span>
                            </td>
                        @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <x-choose />
    <x-editgrade />
    <script type="module" src="{{ asset('js/GradeHandler.js') }}" >
    </script>
</x-layout>