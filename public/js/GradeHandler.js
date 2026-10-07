class GradeHandler{
    subjectId = null;
    subjectName = '';
    subjectMonth = '';
    selectedGrade = null;
    gradeId = null;
    gradeDescription = null;
    studentId = null;

    constructor(){
        // Ablak és űrlap
        this.GradeWindow = document.getElementById('edit-grade-window')
        this.gradeform = document.getElementById('grade-form');

        // űrlapon belüli szövegek
        this.subjectText = document.getElementById("grade-form-subject");
        this.monthText = document.getElementById("grade-form-month");
        
        // űrlapon belüli inputok
        this.gradeDescriptionInput = document.getElementById("grade-form-description");
        this.gradeInput = document.getElementById("grade-form-value");
        this.monthInput = document.getElementById("grade-input-month");

        this.subjectIDInput = document.getElementById("grade-form-subject_id");
        this.studentIDInput = document.getElementById("grade-form-student_id");
        
        // Egyéb
        this.gradeSaveButton = document.getElementById("grade-form-save");
        this.helpIsVisible = false;

        // Jegy kiválsztásával kapcsolatos dolgok
        this.chooseWindow = document.getElementById("chooseWindow");
        this.deleteButton = document.getElementById("deleteButton");
        this.editButton = document.getElementById("editButton");   
        this.closeButton = document.getElementById("closeButton");

        // event listenerek, nem tudom a nevét magyarul
        this.deleteButton.addEventListener('click', () => {
            this.RemoveGrade(this.subjectName, this.subjectMonth, this.gradeId, this.selectedGrade);
        });
        
        this.editButton.addEventListener('click', () => {
            this.chooseWindow.style.display = "none";
            this.EditGrade(this.subjectId, this.subjectName, this.subjectMonth, this.selectedGrade, this.gradeId, this.gradeDescription);
        });

        this.closeButton.addEventListener('click', () => {
            this.ClearGradeValues();
            this.chooseWindow.style.display = "none";
        });
    };

    SelectGrade(subjectID, subjectName, subjectMonth, grade, gradeID, description, studentID){
        this.AssignGradeValues(subjectID, subjectName, subjectMonth, grade, gradeID, description, studentID);
        this.chooseWindow.style.display = "flex";
    }

    AssignGradeValues(subjectID, subjectName, subjectMonth, grade, gradeID, description, studentID) {
        this.subjectId = subjectID;
        this.subjectName = subjectName;
        this.subjectMonth = subjectMonth;
        this.selectedGrade = grade;
        this.gradeId = gradeID;
        this.gradeDescription = description;
        this.studentId = studentID;
    }

    ClearGradeValues(){
        this.subjectId = null;
        this.subjectName = "";
        this.subjectMonth = "";
        this.selectedGrade = null;
        this.gradeId = null;
        this.gradeDescription = "";
    }

    AddGrade(subjectID, subjectName, subjectMonth, grade, studentID){
        this.GradeWindow.style.display = "flex";
        this.gradeform.action = `/jegyek/${studentID}`

        this.subjectText.textContent = subjectName;
        this.monthText.textContent = subjectMonth;
        this.gradeInput.value = "";

        this.monthInput.value = subjectMonth.toString();
        this.subjectIDInput.value = subjectID;
        this.studentIDInput.value = studentID;

        this.gradeInput.focus();

        if(grade != 0){
            this.gradeInput.value = grade;
        } 

        this.ClearGradeValues();
    }

    EditGrade(subjectID, subjectName, subjectMonth, grade, gradeID, gradeDescription){
        this.GradeWindow.style.display = "flex";
        this.gradeSaveButton.textContent = "Változtatás mentése";
        this.gradeform.action = `/jegyek/edit/${gradeID}`

        const methodInput = document.createElement("input");

        methodInput.type = "hidden";
        methodInput.name = "_method";
        methodInput.value = "PUT";

        this.gradeform.appendChild(methodInput);    

        this.subjectText.textContent = subjectName;
        this.monthText.textContent = subjectMonth;
        this.gradeInput.value = grade != 0 ? grade : "";
        this.gradeDescriptionInput.value = gradeDescription;
        this.studentIDInput.value = this.studentId;

        this.monthInput.value = subjectMonth.toString();
        this.subjectIDInput.value = subjectID;

        this.ClearGradeValues();
    }

    RemoveGrade(subjectName, subjectMonth, gradeID, grade){
        const deleteForm = document.getElementById('delete-form');
        if(!deleteForm){ 
            console.log('No delete log Found'); 
            alert('Rendszerhiba! Kérjük próbáld újra később!');
            return 
        }
        const confirmed = window.confirm('Biztos benne, hogy ki szeretné törölni a jegyet?\n Ekkor: ' + subjectMonth + '\n Tantárgy: ' + subjectName + '\n Értékelés: ' + grade);

        if(confirmed){
            deleteForm.action=`/jegyek/delete/${gradeID}`;
            deleteForm.submit();
        }

        this.ClearGradeValues();
    }

    CloseWindow(){
        this.subjectText.textContent = "";
        this.monthText.textContent = "";
        this.gradeInput.value = 0;

        this.GradeWindow.style.display = "none";
    }

    ShowHelp(){
        var helpText = document.getElementById('helpText');
        var help = document.getElementById('help');
        
        this.helpIsVisible = !this.helpIsVisible;

        helpText.textContent = this.helpIsVisible ? "Útmutató elrejtése" : "Útmutató megjelenítése";

        help.classList.toggle("visible", this.helpIsVisible);
    }
}

const Handler = new GradeHandler();
window.Handler = Handler;