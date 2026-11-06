@props(['href', 'match' => null])

<a href="{{ $href }}" {{ $attributes->class(['active' => request()->is($match ?? ltrim($href, '/'))]) }}>{{ $slot }}</a>