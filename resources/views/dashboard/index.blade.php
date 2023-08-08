@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">welcome back, {{ auth()->user()->name }}</h1>
</div>
<div class="fs-5">
<h4 class="mb-3"> Profile </h4>
<p>
        &emsp;name&emsp;&emsp;: {{ auth()->user()->name }} <br>
        &emsp;username : {{ auth()->user()->username }} <br>
        &emsp;email&emsp;&emsp;: {{ auth()->user()->email }} <br>
</p>
</div>
@endsection