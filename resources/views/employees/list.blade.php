@extends('layouts.navbar')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                @can('create employee')
                    <a href="{{ route('employees.create') }}" class="btn btn-dark">Create</a>
                @endcan
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
                    <div class="card-body mx-15">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Salary</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @if ($employees->isNotEmpty())
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>
                                            @if ($employee->image != '')
                                                <img width="115"
                                                    src="{{ asset('uploads/employees/' . $employee->image) }}"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->role }}</td>
                                        <td>{{ $employee->salary }} Rs</td>
                                        <td>{{ \Carbon\Carbon::parse($employee->created_at)->format('d ,M,Y') }}</td>
                                        <td>
                                            @can('edit employee')
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="btn btn-dark">Edit</a>
                                            @endcan
                                            @can('view more info')
                                                <a href="{{ route('datas.index', ['employeeId' => $employee->id]) }}"
                                                    class="btn btn-info">More Info</a>
                                            @endcan
                                            @can('create p~id')
                                                <a href="{{ route('datas.create', ['employeeId' => $employee->id]) }}"
                                                    class="btn btn-primary">Create P~id</a>
                                            @endcan

                                            @can('delete employee')
                                                <a href="#" onclick="deleteEmployee({{ $employee->id }})"
                                                    class="btn btn-danger">Delete</a>
                                            @endcan
                                            <form id="delete-employee-form-{{ $employee->id }}"
                                                action="{{ route('employees.destroy', $employee->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function deleteEmployee(id) {
        if (confirm('Are you sure you want to delete this employee')) {
            document.getElementById("delete-employee-form-" + id).submit();



        }


    }
</script>
