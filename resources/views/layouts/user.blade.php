@extends('layouts.base')

@section('sidebar')
    @include('components.sidebar', ['role' => 'user'])
@endsection

@section('header')
    @include('components.header', ['role' => 'user'])
@endsection

@section('dashboard')
    @include('components.dashboard', ['role' => 'user'])
@endsection
