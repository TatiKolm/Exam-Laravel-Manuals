@extends('app')

@section('title', 'Устройства')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>Устройства</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить новое</a>
    </div>

    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Устройства</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            {{__("Edit")}}
                            </a>
                            <form action="{{ route('products.delete', $product->id) }}" method="POST" class="mx-3">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                {{__("Delete")}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
