@extends('layouts.base')

@section('sidebar')
    @include('components.sidebar', ['role' => 'admin'])
@endsection

@section('header')
    @include('components.header', ['role' => 'admin'])
@endsection

@section('dashboard')
    @include('components.dashboard', ['role' => 'admin'])
@endsection
