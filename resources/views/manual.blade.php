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

        <div>
            <p>Нашли неточности? Вы можете оставить свои замечания в форме ниже.</p>
            <h5 class="my-5">{{ $manual->title }}</h5>
            <form action="{{route('complaints.store', $manual)}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group mb-3">
                    <label for="complaint" class="form-label">Опишите проблему</label>
                    <textarea type="text" id="complaint" name="complaint" class="form-control"></textarea>
                    @error('description')
                        <small class="text-denger">{{ $message }}</small>
                    @enderror
                </div><button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
        
        
        
</div>
@endsection