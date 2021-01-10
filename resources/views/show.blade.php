@extends('layout')

@section('body')
    <div class="list-group">
        @foreach($events as $id => $date)
            <a href="/events/{{ $id }}" class="list-group-item list-group-item-action">
                <b>{{ $id }}: </b> {{ $date }}
            </a>
        @endforeach
    </div>
@endsection
