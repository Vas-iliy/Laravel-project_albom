@extends('layouts.layout')
@section('title', 'Create')
@section('content')
    <div class="py-5">
        <div class="container">
            <form action="{{route('create.albom')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Выберите альбом из списка</label>
                    <select name="albom" class="form-control" id="exampleFormControlSelect1">
                        @foreach($alboms as $albom)
                            <option value="{{$albom['name'] . '___' . $albom['artist']}}">Albom: {{$albom['name']}} | Artist: {{$albom['artist']}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
