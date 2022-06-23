@extends('base.template')

@section('content')
    <div class="py-16 mx-auto prose prose-lg text-gray-500 prose-indigo">
        {!! $markdown !!}
    </div>
@endsection
