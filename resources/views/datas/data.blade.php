@extends('layouts.navbar')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                {{-- <a href="{{ route('datas.create', ['employeeId' =>$datas->employee_id]) }}" class="btn btn-dark">Create PD</a> --}}
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}


                    </div>
                </div>
            @endif
            <div class="col-md-15">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Employees</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Experience</th>
                                <th>Employee_Id</th>

                                <!-- Add other table headers here -->

                                </tr>
                            @if ($datas->isNotEmpty())
                                @foreach ($datas as $data)
                                       <tr>
                                         <td>{{ $data->id }}</td>
                                         <td>{{ $data->phone }}</td>
                                         <td>{{ $data->email}}</td>
                                         <td>{{ $data->address}}</td>
                                         <td>{{ $data->experience}}</td>
                                         <td>{{ $data->employee_id}}</td>
                                         <td>
                                            <a href="{{ route('datas.edit',$data->id) }}"
                                                class="btn btn-dark">Edit</a>

                                        </td>
                                        </tr>
                                @endforeach

                            @endif
                        </table>
@endsection
