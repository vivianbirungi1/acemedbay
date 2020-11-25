@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Patient {{ $patient->policy_number }}
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>
                            <tr>
                              <td>Policy Number</td>
                              <td>{{ $patient->policy_number }}</td>
                            </tr>
                            <tr>
                              <td>Insurance Company</td>
                              <td>{{ $patient->insurance_company }}</td>
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
