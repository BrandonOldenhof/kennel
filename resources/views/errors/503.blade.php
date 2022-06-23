@extends('base.error')

@section('page-title')
    503 - Under maintenance | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <x-partials.error statusCode="503" title="Under maintenance"
        description="Sorry. The site is currently under maintenance." :withButton="false" />
@endsection
