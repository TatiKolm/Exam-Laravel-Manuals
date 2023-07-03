@extends('app')

@section('title', $manual->title . ' (ред.)')
@section('content')

    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ $manual->title . ' (ред.)' }}</h2>
    </div>

    <div>
        <form action="{{ route('manuals.update', $manual) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="{{ old('title', $manual->title) }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="product" class="form-label">Устройство</label>
                <select name="product" id="product" class="form-select">
                    <option value="" selected disabled>Выберите устройство</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id == old('product', $manual->product_id)) selected @endif>
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
                @if ($manual->image)
                    <div class="my-3">
                        <img src="{{ $manual->getImage() }}" alt="" style="width:150px">
                    </div>
                    <a href="{{ route('manuals.remove-image', $manual->id) }}" class="btn btn-sm btn-danger">
                        Удалить картинку
                    </a>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="is_approved" class="form-label">
                    <input type="checkbox" id="is_approved" name="is_approved" class="form-check-input" value="1"
                        @if (old('is_approved', $manual->is_published) == 1) checked @endif>
                        Утвердить
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
