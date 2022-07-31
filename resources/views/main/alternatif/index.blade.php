@extends('templates.master')

@section('title', 'Alternatif')
@section('pwd', 'Alternatif')
@section('sub-pwd', 'Data')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="row render">
    {{--  --}}
</div>
@endsection

@push('script')
    <script src="{{asset('functions/alternatif/main.js')}}"></script>
@endpush