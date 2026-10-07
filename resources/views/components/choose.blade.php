<div id="chooseWindow" class="popup">
    <x-form action="" id="delete-form" :delete="true" :errorNeeded="false">
        <input type="hidden" name="gradeID" id="delete-gradeID">
        <button id="editButton" type="button">Szerkesztés</button>
        <button id="deleteButton" type="button">Törlés</button>
        <a id="closeButton">Bezárás</a>
    </x-form>
</div>