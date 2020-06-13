@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 px-5">
            <div class="mt-5"id="app">
                <csvbtn></csvbtn>
            </div>
        </div>
        <div class="col-md-6 mb-5">
             <iframe width="560" height="315" src="https://www.youtube.com/embed/OsqipGUKTVQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Список поступивших запросов</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Email</th>
                                <th>Телефон</th>
                                <th>Дата показа</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{ $record['name'] }}</td>
                                <td>{{ $record['fname'] }}</td>
                                <td>{{ $record['sname'] }}</td>
                                <th>{{ $record['email'] }}</th>
                                <td>{{ $record['phone'] }}</td>
                                <td>{{ $record['show_date'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
