@extends('layout')

@section('content')
    <div class="columns">
        <div class="column is-one-third">
            <form action="{{ route('lessons.store') }}" method="post">
                @csrf
                <div class="field">
                    <label class="label">Название дисциалины</label>
                    <div class="control">
                        <input class="input" type="text" name="name">
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Сохранить</button>
                    </div>
                    <div class="control">
                        <button class="button is-text">Сбросить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
