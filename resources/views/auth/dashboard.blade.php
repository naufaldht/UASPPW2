@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-house-door"></i> Dashboard
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-person-check me-2"></i>
                        Selamat datang! Anda berhasil masuk.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
