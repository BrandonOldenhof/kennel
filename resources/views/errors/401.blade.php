@extends('base.error')

@section('page-title')
    401 - Unauthorized | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <x-partials.error statusCode="401" title="Unauthorized"
        description="The request has not been completed because your authentication credentials are invalid." />
@endsection
