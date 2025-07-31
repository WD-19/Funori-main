
@extends('client.layout.client')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Thanh toán thất bại!</h4>
                </div>
                <div class="card-body">
                    @if(isset($error))
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endif
                    <a href="{{ route('client.checkout.index') }}" class="btn btn-primary">Thử lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection