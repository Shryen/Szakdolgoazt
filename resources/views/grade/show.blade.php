<x-layout>
    @php
        $grades = $gradesByMonthAndSubject['grades'];
        $subjects = $gradesByMonthAndSubject['subjects'];
        $cellID = 0;
    @endphp

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
       PopUpWindow(subjectID, subjectName, subjectMonth, grade);
    }

    function PopUpWindow(subjectId, subjectName, subjectMonth, grade){
        PopUpWindow.style.display = "flex";

        subjectText.textContent = subjectName;
        monthText.textContent = subjectMonth;
        gradeInput.value = "";

        monthInput.value = subjectMonth.toString();
        subjectIDInput.value = subjectID;

        gradeInput.focus();

        if(grade != 0){
            gradeValue.value = grade;
        } 
    }

    function CloseWindow(){
        subjectText.textContent = "";
        monthText.textContent = "";
        gradeInput.value = 0;

        PopUpWindow.style.display = "none";
    }
</script>