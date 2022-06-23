@extends('base.error')

@section('page-title')
    405 - Method not allowed | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <x-partials.error statusCode="405" title="Method not allowed" description="Sorry the requested URL caused an error." />
@endsection
