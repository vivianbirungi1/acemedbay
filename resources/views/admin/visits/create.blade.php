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
                    <label for="duration">Duration</label>
                    <input type="text" class="form-control" name="duration" id="duration" value="{{ old('duration') }}" />
                </div>
                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="text" class="form-control" name="cost" id="cost" value="{{ old('cost') }}" />
                </div>

                <div class="form-group">
                    <label for="doctor_id">Doctor ID</label>
                    <select name="doctor_id">
                      @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ (old('doctor_id') == $doctor->id) ? "selected" : "" }} >{{ $doctor->id }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="patient_id">Patient ID</label>
                    <select name="patient_id">
                      @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}" {{ (old('patient_id') == $patient->id) ? "selected" : "" }} >{{ $patient->id }}</option>
                      @endforeach
                    </select>
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
