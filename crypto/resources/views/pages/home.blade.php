@extends('layouts.app')

@include('inc.navbar')
<br>
<br>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (Auth::user()->email_verified_at)
                        Your email is verified
                    @else
                        Check your email inbox to verify email
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
