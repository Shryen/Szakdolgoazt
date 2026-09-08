@props(['action' => '', 'method' => 'POST']) <!-- Action üres string, hogy teszt közben ne bassza fel az agyamat -->

<form action="{{ $action }}" method="{{ $method }}">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif
    {{$slot}}
    @csrf
</form>
