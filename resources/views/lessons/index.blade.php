@extends('layout')

@section('content')
    <table class="table is-bordered">
        <thead>
            <th>Название дисциплины</th>
            <th>Действие</th>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->name }}</td>
                    <td><a href="{{ route('lessons.destroy', $lesson->getKey()) }}"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
