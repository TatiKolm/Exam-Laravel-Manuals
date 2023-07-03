@extends('app')

@section('title', 'Жалобы')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>Жалобы</h2>
    </div>

    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Инструкция</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->id }}</td>
                        <td>{{ $complaint->manual->title }}</td>
                        <td>
                            <form action="{{route('complaint.change-status', $complaint)}}" method="GET">
                                <select name="status" class="change-status form-control">
                                    <option value="in_process" @if($complaint->status == 'in_process') selected @endif>На рассмотрении</option>
                                    <option value="finished" @if($complaint->status == 'finished') selected @endif>Завершен</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{route('complaints.show', $complaint)}}">Перейти к жалобе</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection