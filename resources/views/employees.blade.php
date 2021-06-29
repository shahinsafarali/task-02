@extends('master')

@section('content')

    <div class="row">
        <div class="bb-1 mb-3 page-details">
            @if (session('message'))
                <p class="alert-text">{{ session('message') }}</p>
            @endif
            <form action="{{ route('employees.create') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <label for="employees">Import employees:</label>

                <input type="file"
                       id="employees" name="employees"
                       accept="text/xml">
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
        <div class="d-flex justify-content-between mb-3 align-items-center bb-1 page-details">

            <ul class="clear-list-style d-flex breadcrumbs p-0">
                <li><a href="{{ route('employees.index', ['page' => 1, 'perPage' => $perPage]) }}">All Employees</a></li>
                @if($department)
                    <li><span class="m-0"> ›</span></li>
                    <li><span>{{ $department->name }}</span></li>
                @endif
            </ul>
            <div class="d-flex justify-content-end align-items-center">
                <label for="perPageSelect">Show: &nbsp; </label>
                <select name="perPage" id="perPageSelect" class="form-control width-auto">
                    @foreach($perPageValues as $value)
                        <option
                            value="{{request()->fullUrlWithQuery(['perPage' => $value, 'page' => 1])}}"
                            @if($value == $perPage) selected @endif>
                            {{$value}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Full name</th>
                    <th scope="col">Date of birth</th>
                    <th scope="col">Department</th>
                    <th scope="col">Position</th>
                    <th scope="col">Payment type</th>
                    <th scope="col">Monthly pay</th>
                </tr>
            </thead>
            <tbody>
                @empty($employees->items())
                    <tr>
                        <td colspan="6"> No records found!</td>
                    </tr>
                @endempty

                @foreach($employees as  $employee)
                    <tr>
                        <td>{{ $employee->full_name }}</td>
                        <td>{{ $employee->birth_date->toFormattedDateString() }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{
                                route('employees.index', [
                                        'department' => $employee->department,
                                        'perPage' => $perPage
                                    ])
                            }}">
                                {{ $employee->department->name }}
                            </a>
                        </td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->payment_type_name }}</td>
                        <td>{{ $employee->getTotalPayment('2021-06-01', '2021-06-30') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $employees->onEachSide(1)->links() }}
        </div>
    </div>
@endsection
