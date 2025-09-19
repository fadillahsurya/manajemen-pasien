@extends('layouts.app')

@section('content')
<h2>Profile User</h2>
<div class="row mt-4">
    <div class="col-md-4">
        <img src="{{ $user->profile_photo 
              ? asset('storage/'.$user->profile_photo) 
              : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
     alt="Avatar" class="img-fluid rounded-circle">
    </div>
    <div class="col-md-8">
        <table class="table table-borderless">
            <tr><th>Nama:</th><td>{{ Auth::user()->name }}</td></tr>
            <tr><th>Email:</th><td>{{ Auth::user()->email }}</td></tr>
            </table>
    </div>
</div>
@endsection
