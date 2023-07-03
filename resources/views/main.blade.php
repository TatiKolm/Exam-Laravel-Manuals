@extends('app')

@section('title', 'Инструкции')
@section('content')

@if (session('success_complaint'))
        <div class="alert alert-success">
            {{ session('success_complaint') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>Поиск инструкции</h2>
    </div>

   <div>
    <form class="d-flex col-8" action="{{route('app.search-page')}}" method="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Введите запрос" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Поиск</button>
        </form>
   </div>

   

   <div class="my-5 col-8">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Устройства</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('app.productManuals', $product)}}">{{ $product->name }} </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

   </div>

    

@endsection