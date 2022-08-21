@extends('templates.master')

@section('title', 'Kriteria')
@section('pwd', 'WP Product')
@section('sub-pwd', 'Kriteria')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="row render">
    {{--  --}}
</div>
@endsection

@push('script')
<script src="{{asset('functions/kriteria/main.js')}}"></script>
@endpush