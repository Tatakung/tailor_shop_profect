{{-- @extends('layouts.app')                                 โครงหน้าเดิมสำหรับแอดมิน

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
                    you are admin.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">สวัสดีแอดมิกกกน</h2>


        

    </div>
</div>

@endsection
