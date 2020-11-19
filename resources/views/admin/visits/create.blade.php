@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
     <div class="card">
       <div class="card-header">
         Add new visit
       </div>

       <div class="card-body">
         @if($errors->any())
             <div class="alert alert-danger">
               <ul>
                 @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                 @endforeach
               </ul>
             </div>
         @endif
        <form action="{{ route('admin.visits.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{ old('date') }}" />
                </div>
                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="time" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}" />
                </div>
                <div class="form-group">
                    <label for="end_time">End TIme</label>
                    <input type="time" class="form-control" name="end_time" id="end_time" value="{{ old('end_time') }}" />
                </div>
                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="text" class="form-control" name="cost" id="cost" value="{{ old('cost') }}" />
                </div>
                <div class="form-group">
                    <label for="doctor_id">Doctor ID</label>
                    <input type="text" class="form-control" name="doctor_id" id="doctor_id" value="{{ old('doctor_id') }}" />
                </div>
                <div class="form-group">
                    <label for="patient_id">Patient ID</label>
                    <input type="text" class="form-control" name="patient_id" id="patient_id" value="{{ old('patient_id') }}" />
                </div>
                <div>
                  <a href="{{ route('admin.visits.index') }}" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </form>
           </div>
        </div>
      </div>
   </div>
</div>
@endsection
