@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Doctor {{ $doctor->name }}
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>

                          <tr>
                            <td>Name</td>
                            <td>{{ $doctor->name }}</td>
                          </tr>
                          <tr>
                            <td>Address</td>
                            <td>{{ $doctor->address }}</td>
                          </tr>
                          <tr>
                            <td>PHone</td>
                            <td>{{ $doctor->phone }}</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>{{ $doctor->email }}</td>
                          </tr>
                            <tr>
                              <td>Start Date</td>
                              <td>{{ $doctor->start_date }}</td>
                            </tr>
                            <tr>
                              <td>User ID</td>
                              <td>{{ $doctor->user_id }}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.doctors.index')}}" class="btn ">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
