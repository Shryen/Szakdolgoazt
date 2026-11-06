<x-layout>
    <x-admin>

        <x-form action="/hianyzas/szerkeszt/{{$absence->id}}" :edit="true" >
            <strong>{{$absence->student->first_name}} {{$absence->student->last_name}}</strong>
            <label for="date">Időpont</label>
            <input type="date" value="{{$absence->date->format('Y-m-d')}}" name="date">

            <select name="is_justified">
                <option value="0" @selected(!$absence->is_justified)>Igazolatlan</option>
                <option value="1" @selected($absence->is_justified)>Igazolt</option>
            </select>

            <button>Szerkeszt</button>
        </x-form>
    
    </x-admin>
</x-layout>