@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Doctor {{ $doctor->user->name }}
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>

                          <tr>
                            <td>Name</td>
                            <td>{{ $doctor->user->name }}</td>
                          </tr>
                          <tr>
                            <td>Address</td>
                            <td>{{ $doctor->user->address }}</td>
                          </tr>
                          <tr>
                            <td>Phone</td>
                            <td>{{ $doctor->user->phone }}</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>{{ $doctor->user->email }}</td>
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
                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
                    <form style="display:inline-block" method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="form-control btn btn-danger">Delete</a>
                    </form>


                  <!-- </br>
              </br>
              <h2>
                Visits

                <a href="{{ route('admin.doctors.create', $doctor->id) }}" class="btn btn-primary ">Add</a>

              </h2>

              <ul>
                @if (count($doctor->visits) == 0)
                  <p>There are no visits for this doctor</p>
                @else
                  @foreach ($doctor->visits as $visit)
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
          @if (count($doctor->visits) == 0)
          <p>There are no visits for this doctor.</p>
          @else
          <table class="table">
              <thead>
                  <th>Date</th>
                  <th>Start Time</th>
                  <th>Patient ID</th>
                  <th>Actions</th>
              </thead>
              <tbody>
                  @foreach ($doctor->visits as $visit)
                  <tr>
                      <th>{{ $visit->date }}</th>
                      <th>{{ $visit->start_time }}</th>
                      <th>{{ $visit->patient_id }}</th>
                      <th>
                          <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', [ 'id' => $doctor->id, 'rid' => $visit->id]) }}">
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
