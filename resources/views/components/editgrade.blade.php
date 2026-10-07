@props(["method" => ""])

<div id="edit-grade-window" class="popup">
    <x-form action="" :errorNeeded="false" id="grade-form">
        <h2 id="grade-form-subject"></h2>
        <h2 id="grade-form-month"></h2>

        <input type="text" id="grade-form-value" name="grade_value" placeholder="Értékelés..."> <!-- adott jegy -->
        <input type="text" name="description" placeholder="Indoklás..." id="grade-form-description"> <!-- pl Témazáró vagy tudja tököm -->

        <input type="hidden" name="month" id="grade-input-month">
        <input type="hidden" name="student_id" id="grade-form-student_id">
        <input type="hidden" name="subject_id" id="grade-form-subject_id">
        <input type="hidden" name="grade_id" id="grade-form-grade_id">

        <button id="grade-form-save">Jegy rögzítése</button>
        <button id="grade-form-cancel" onclick="Handler.CloseWindow()" type="button">Mégsem</button>
    </x-form>
</div>