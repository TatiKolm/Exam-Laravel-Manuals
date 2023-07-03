@extends('app')

@section('title', 'Жалоба')
@section('content')

<div>
        <h1 class="my-5">Жалоба № {{ $complaint->id }}</h1>

        <div>
            <p>{{ $complaint->complaint }}</p>
        </div>
        <div class="row">
            <div class="col-3">
                <img src="{{ $complaint->manual->getImage() }}" alt="" style="height:200px">
            </div>
            <div class="col">
                <p>Устройство: {{ $complaint->manual->product->name}}</p>
                <a class="btn btn-primary" href="{{$complaint->manual->getFile()}}" download="">Скачать инструкцию</a>
                <a class="btn btn-success" href="{{route('manuals.update', $complaint->manual)}}" >Перейти к редактированию</a>
            </div>
        </div>
        <div class="my-5">
        <iframe src="{{$complaint->manual->getFile()}}" width="100%" height="500"></iframe>
        </div>

       
        
        
        
</div>
@endsection