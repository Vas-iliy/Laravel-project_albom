@extends('layouts.layout')
@section('title', 'Home')
@section('content')
<div class="py-5">
    <div class="container">
        @if($alboms->count())
        <div class="row">
            @foreach($alboms as $albom)
            <div class="col-md-12">
                <div class="card">
                    <img class="card-img-top" src="{{$albom->image}}" alt="Card image cap">
                    <div class="card-body">
                        <p>Альбом:</p>
                        <h2 class="card-title">{{$albom->name}}</h2>
                        <p>Исполнитель:</p>
                        <h4 class="card-title">{{$albom->artist}}</h4>
                        <hr>
                        <p class="card-text">{{$albom->content}}</p>
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="{{route('edit', ['id' => $albom->id])}}" class="btn btn-primary">Редактировать</a>
                            <form action="{{route('destroy', ['id' => $albom->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn badge-danger">Удалить</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <h2>Альбомов пока нет, можете добавить ...)</h2>
            <a href="{{route('create')}}">Добавить альбом</a>
        @endif
    </div>
</div>

@endsection
