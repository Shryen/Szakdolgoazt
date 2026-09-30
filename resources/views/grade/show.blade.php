<x-layout>
    @php
        $grades = $gradesByMonthAndSubject['grades']; // jegyek alapján keresünk
        $subjects = $gradesByMonthAndSubject['subjects']; // tantárgyak alapján keresünk
        $cellID = 0;
    @endphp
    
    <h1>Útmutató</h1>
    <p class="grade-alert">Ne felejtsen el a mentés gombra kattintani!</p>
    <p onclick="ShowHelp()" id="helpText">Útmutató megjelenítése</p>
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
                                
                                @forelse ($subjectGrades[$subject->name] ?? [] as $grade)
                                    <span class="grade" 
                                        onclick="SelectCell( 
                                        @js($subject->id), 
                                        @js($subject->name), 
                                        @js($month), 
                                        @js($grade->grade_value) )" id="{{$cellID++}}">{{ $grade->grade_value }}</span>
                                @empty
                                    <span class="no-grade" onclick="SelectCell( @js($subject->id), @js($subject->name), @js($month), @js(0) )" id="{{$cellID++}}">–</span>
                                @endforelse
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-editgrade :id="$student->id"/>
</x-layout>

<script>
    var PopUpWindow = document.getElementById("edit-grade-window");
    var subjectText = document.getElementById("grade-form-subject");
    var monthText = document.getElementById("grade-form-month");
    var gradeInput = document.getElementById("grade-form-value");
    var monthInput = document.getElementById("grade-input-month");
    var subjectIDInput = document.getElementById("grade-form-subject_id");


    function SelectCell(subjectID, subjectName, subjectMonth, grade){
        //TODO: Select the cell and decide what to do, for now just add grades
       AddElementWindow(subjectID, subjectName, subjectMonth, grade);
    }

    function AddElementWindow(subjectID, subjectName, subjectMonth, grade){
        PopUpWindow.style.display = "flex";

        subjectText.textContent = subjectName;
        monthText.textContent = subjectMonth;
        gradeInput.value = "";

        monthInput.value = subjectMonth.toString();
        subjectIDInput.value = subjectID;

        gradeInput.focus();

        if(grade != 0){
            gradeInput.value = grade;
        } 
    }

    function CloseWindow(){
        subjectText.textContent = "";
        monthText.textContent = "";
        gradeInput.value = 0;

        PopUpWindow.style.display = "none";
    }

    var helpIsVisible = false;

    function ShowHelp(){
        var helpText = document.getElementById('helpText');
        var help = document.getElementById('help');
        
        helpIsVisible = !helpIsVisible;

        helpText.textContent = helpIsVisible ? "Útmutató elrejtése" : "Útmutató megjelenítése";

        help.classList.toggle("visible", helpIsVisible);
    }
</script>