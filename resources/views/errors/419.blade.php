@extends('base.error')

@section('page-title')
    419 - Session expired | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <x-partials.error statusCode="419" title="Session expired" description="Please clear your cookies and log back in." />
@endsection
