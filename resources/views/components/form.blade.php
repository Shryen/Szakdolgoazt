@props(
['action' => '', 
'method' => 'POST', 
'delete' => false, 
'edit' => false, 
'errorNeeded' => true,
'class' => ''
]) <!-- Action üres string, hogy teszt közben ne bassza fel az agyamat -->

<form {{$attributes->merge(
    ['action' => $action, 
    'method' => $method, 
    'errorNeeded' => $errorNeeded,
    'class' => $class
    ]
    
    )}}>
    @if($errors->any() && $errorNeeded)
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif
    
    @csrf
    @if($delete == true)
        @method('DELETE')
    @endif

    @if($edit == true)
        @method('PUT')
    @endif
    {{$slot}}
</form>
