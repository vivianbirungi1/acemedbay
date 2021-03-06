@extends('layouts.patient')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Visit {{ $visit->date }}
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>
                            <tr>
                              <td>Date</td>
                              <td>{{ $visit->date }}</td>
                            </tr>
                            <tr>
                              <td>Start Time</td>
                              <td>{{ $visit->start_time }}</td>
                            </tr>
                            <tr>
                              <td>End Time</td>
                              <td>{{ $visit->end_time }}</td>
                            </tr>
                            <tr>
                              <td>Duration</td>
                              <td>{{ $visit->duration }}</td>
                            </tr>
                            <tr>
                              <td>Cost</td>
                              <td>{{ $visit->cost }}</td>
                            </tr>
                            <tr>
                              <td>Doctor ID</td>
                              <td>{{ $visit->doctor_id }}</td>
                            </tr>
                            <tr>
                              <td>Doctor Name</td>
                              <td>{{ $visit->doctor->user->name }}</td>
                            </tr>
                            <tr>
                              <td>Patient ID</td>
                              <td>{{ $visit->patient_id }}</td>
                            </tr>

                            <tr>
                              <td>Patient Name</td>
                              <td>{{ $visit->patient->user->name }}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('patient.visits.index')}}" class="btn ">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
