@extends('layouts.layout')
@section('title', 'Create')
@section('content')
    <div class="py-5">
        <div class="container">
            <form action="{{route('albom')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Название альбома</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
