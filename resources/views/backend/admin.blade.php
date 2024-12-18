@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @if(auth()->check())
                        @role('admin')
                            <p>You have admin access!</p>
                        @else
                            <p>You do not have admin access.</p>
                        @endrole
                    @else
                        <p>Please log in to see your access level.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
