@extends('app')

@section('title', 'Инструкция')
@section('content')

<div>
        <h1 class="my-5">{{ $manual->title }}</h1>
        <div class="row">
            <div class="col-3">
                <img src="{{ $manual->getImage() }}" alt="" style="height:200px">
            </div>
            <div class="col">
                <p>Устройство: {{ $manual->product->name}}</p>
                <a class="btn btn-success" href="{{$manual->getFile()}}" download="">Скачать инструкцию</a>
            </div>
        </div>
        <div class="my-5">
        <iframe src="{{$manual->getFile()}}" width="100%" height="500"></iframe>
        </div>
        
        
        
</div>
@endsection
