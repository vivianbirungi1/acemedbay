@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Patient {{ $patient->name }}
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td>Name</td>
                            <td>{{ $patient->user->name }}</td>
                          </tr>
                          <tr>
                            <td>Address</td>
                            <td>{{ $patient->user->address }}</td>
                          </tr>
                          <tr>
                            <td>Phone</td>
                            <td>{{ $patient->user->phone }}</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>{{ $patient->user->email }}</td>
                          </tr>
                          <tr>
                            <td>Medical Insurance</td>
                            <td>{{ $patient->medical_insurances->insurance_company }}</td>
                          </tr>
                            <tr>
                              <td>User ID</td>
                              <td>{{ $patient->user_id }}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.patients.index')}}" class="btn ">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
