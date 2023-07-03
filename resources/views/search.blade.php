@extends('app')

@section('title', 'Инструкции')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>Совпадения по запросу</h2>
    </div>
    

    <div>
        @if ($manuals->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Изображение</th>
                        <th>Заголовок</th>
                        <th>Устройство</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manuals as $manual)
                        <tr>
                            <td>
                                <img src="{{ $manual->getImage() }}" alt="" style="height:100px">
                            </td>
                            <td>
                                <a href="{{ route('app.manual-page', $manual->slug) }}">
                                    {{ $manual->title }}
                                </a>
                            </td>
                            <td>{{ $manual->product->name }}</td>
                            <td>
                            <a class="btn btn-success" href="{{$manual->getFile()}}" download="">Скачать инструкцию</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="my-4">Пока нет инструкций</p>
        @endif
    </div>
@endsection