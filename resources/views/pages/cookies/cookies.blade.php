@extends('base.template')

@section('page-title')
    Cookies | {{ config('app.name') }}
@endsection

@section('content')
    <script id="CookieDeclaration" src="https://consent.cookiebot.com/{{ config('rox.cookiebot') }}/cd.js"
        type="text/javascript" nonce="{{ csrf_token() }}" async></script>
@endsection
