@extends('layouts.about')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <img src="assets/img/guest.png" class="img-fluid" alt="...">

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Ace MedBay Medical Centre</h2>
                    <p>Ace MedBay Medical Centre is a safe and friendly medical centre in the heart of Dublin. We have a range of top,
                      world renowned doctors here to help you with any medical needs 24 hours of the day.
                      We make it easy to view your appointments and cancel any appointments within the site.
                      <br>
                      <b>Please note:</b> If you have contracted the Corona virus or have come into close contact with someone who has, we urge you to
                      please cancel your appointment at your earliest convenience and stay at home in order to help stop the spread of the virus.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
