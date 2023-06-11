@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2 mb-3">
            <ul class="list-group custom-card">
                <li class="list-group-item active" aria-current="true">Home</li>
                <li class="list-group-item">Jadwal</li>
                <li class="list-group-item">Artikel</li>
                <li class="list-group-item"><a href="{{ route('faq.index') }}" style="color: black; text-decoration: none;">FAQ</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    Anda adalah {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection