@extends('layout')

@section('body')
    <div class="list-group">
        @foreach($shows as $id => $name)
            <a href="/shows/{{ $id }}" class="list-group-item list-group-item-action">
                {{ $name }}
            </a>
        @endforeach
    </div>
@endsection
