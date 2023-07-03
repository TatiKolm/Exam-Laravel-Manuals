@extends('app')

@section('title', __('Права'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __("Права") }}</h2>
        <a href="{{route("permissions.create")}}" class="btn btn-primary">Добавить</a>
    </div>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Право</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $perm)
                    <tr>
                        <td>{{ $perm->name }}</td>
                        <td class="d-flex">
                            <a href="" class="btn btn-sm btn-warning">
                                Ред.
                            </a>
                            <form action="" method="POST" class="mx-3">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
