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
                            <td>{{ $patient->medical_insurance->insurance_company }}</td>
                          </tr>
                            <tr>
                              <td>User ID</td>
                              <td>{{ $patient->user_id }}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.patients.index')}}" class="btn ">Back</a>
                    <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
                    <form style="display:inline-block" method="POST" action="{{ route('admin.patients.destroy', $patient->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="form-control btn btn-danger">Delete</a>
                    </form>

                  <!-- </br>
              </br>
              <h2>
                Visits

                <a href="{{ route('admin.visits.create', $patient->id) }}" class="btn btn-primary ">Add</a>

              </h2>

              <ul>
                @if (count($patient->visits) == 0)
                  <p>There are no visits for this patient</p>
                @else
                  @foreach ($patient->visits as $visit)
                    <li>{{ $visit->date }}</li>
                  @endforeach
                @endif
              </ul> -->

                </div>
            </div>

            <div class="card">
        <div class="card-header">
          Visits

          <a href="{{ route('admin.visits.create', $visit->id) }}" class="btn btn-primary ">Add</a>

        </div>
        <div class="card-body">
          @if (count($patient->visits) == 0)
          <p>There are no visits for this patient.</p>
          @else
          <table class="table">
              <thead>
                  <th>Date</th>
                  <th>Start Time</th>
                  <th>Doctor ID</th>
                  <th>Actions</th>
              </thead>
              <tbody>
                  @foreach ($patient->visits as $visit)
                  <tr>
                      <th>{{ $visit->date }}</th>
                      <th>{{ $visit->start_time }}</th>
                      <th>{{ $visit->doctor_id }}</th>
                      <th>
                          <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', [ 'id' => $patient->id, 'rid' => $visit->id]) }}">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button type="submit" class="form-control btn btn-danger">Delete</a>
                          </form>
                      </th>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          @endif
        </div>
      </div>

        </div>
    </div>
</div>
@endsection
