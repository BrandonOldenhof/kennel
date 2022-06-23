@extends('base.error')

@section('page-title')
    500 - Server error | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <x-partials.error statusCode="500" title="Server error"
        description="The server encountered an internal error and was unable to complete your request." />
@endsection
