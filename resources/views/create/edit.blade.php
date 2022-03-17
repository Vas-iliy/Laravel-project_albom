@extends('layouts.layout')
@section('title', 'Create')
@section('content')
    <div class="py-5">
        <div class="container">
            <form action="{{route('update', ['id' => $albom->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Название альбома</label>
                    <input name="name" value="{{$albom->name}}" type="text" class="form-control" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Исполнитель</label>
                    <input name="artist" value="{{$albom->artist}}" type="text" class="form-control" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Описание альбома</label>
                    <textarea name="content" cols="30" rows="10" class="form-control">{{$albom['content']}}</textarea>
                </div>
                <input type="hidden" name="image" value="{{$albom->image}}">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
@endsection
