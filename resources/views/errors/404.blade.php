@extends('base.error')

@section('page-title')
    404 - Page not found | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <x-partials.error statusCode="404" title="Page not found"
        description="Please check the URL in the address bar and try again." />
@endsection
