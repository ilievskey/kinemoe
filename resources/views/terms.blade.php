@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Terms of use</h3>
    <p>{!! nl2br(e($settings->site_tos)) !!}</p>
</div>
@endsection
