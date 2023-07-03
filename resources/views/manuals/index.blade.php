@extends('app')

@section('title', 'Инструкции')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>Инструкции</h2>
        <form class="d-flex col-8" action="" method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Введите запрос" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Поиск</button>
      </form>
        <a href="{{ route('manuals.create') }}" class="btn btn-primary">Добавить</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div>
        @if ($manuals->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Устройство</th>
                        <th>Утверждено модератором</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manuals as $manual)
                        <tr>
                            <td>
                                <a href="{{ route('manuals.show', $manual->slug) }}">
                                    {{ $manual->title }}
                                </a>
                            </td>
                            <td>{{ $manual->product->name }}</td>
                            <td>{{ $manual->getApprovedStatus() }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('manuals.edit', $manual) }}" class="btn btn-sm btn-warning">
                                ред.
                                </a>
                                <form action="{{ route('manuals.delete', $manual) }}" method="POST" class="mx-3">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick='event.preventDefault();if(confirm("Запись будет удалена. Продолжить?")){this.closest("form").submit();}'>
                                        удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="my-4">Пока нет инструкции</p>
        @endif
    </div>
@endsection