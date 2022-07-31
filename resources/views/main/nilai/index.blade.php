@extends('templates.master')

@section('title', 'Nilai Alternatif')
@section('pwd', 'Nilai Alternatif')
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
    <script src="{{asset('functions/nilai/main.js')}}"></script>
@endpush