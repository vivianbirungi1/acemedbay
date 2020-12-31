@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
     <div class="card">
       <div class="card-header">
         Edit patient
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
        <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name' , $patient->name) }}" />
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address' , $patient->address) }}" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="name" value="{{ old('phone' , $patient->phone) }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email' , $patient->email) }}" />
                </div>

                <div class="form-group">
                    <label for="medical_insurance">Medical Insurance</label>
                    <select name="medical_insurance_id">
                      @foreach ($medical_insurances as $medical_insurance)
                        <option value = " {{ $medical_insurance->id }}" {{ (old('medical_insurance_id', $patient->medical_insurance->id) == $medical_insurance->id) ? "selected" : "" }} >{{ $medical_insurance->insurance_company }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="policy_number">Policy Number</label>
                    <input type="text" class="form-control" name="policy_number" id="policy_number" value="{{ old('policy_number' , $patient->policy_number) }}" />
                </div>

                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="text" class="form-control" name="user_id" id="user_id" value="{{ old('user_id', $patient->user_id) }}" />
                </div>
                <div>
                  <a href="{{ route('admin.patients.index') }}" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </form>
           </div>
        </div>
      </div>
   </div>
</div>
@endsection
