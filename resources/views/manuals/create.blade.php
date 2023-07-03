@extends('app')

@section('title', 'Новая инструкция')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>Новая инструкция</h2>
    </div>

    <div>
        <form action="{{ route('manuals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="product" class="form-label">Устройство</label>
                <select name="product" id="product" class="form-select">
                    <option value="" selected disabled>Выберите устройство</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id == old('product')) selected @endif>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="file" class="form-label">Загрузите инструкцию</label>
                <input type="file" id="file" name="file" class="form-control">
            </div>
            @unlessrole('user')
            <div class="form-group mb-3">
                <label for="is_approved" class="form-label">
                    <input type="checkbox" id="is_approved" name="is_approved" class="form-check-input" value="1"
                        @if (old("is_approved") == 1) checked @endif>
                    Утвердить
                </label>
            </div>
            @endunlessrole  
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection