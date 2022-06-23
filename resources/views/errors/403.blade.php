@extends('base.error')

@section('page-title')
    403 - Forbidden | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <x-partials.error statusCode="403" title="Forbidden" description="You are not authorised to view this resource." />
@endsection
