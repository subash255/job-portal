@extends('layouts.company')
@section('title', 'Company Dashboard - Job Point')
@section('content')

@php
    $section = $section ?? 'dashboard';
@endphp

@if($section === 'dashboard')
    @include('company.sections.dashboard')
@elseif($section === 'jobs')
    @include('company.sections.jobs')
@elseif($section === 'applications')
    @include('company.sections.applications')
@elseif($section === 'profile')
    @include('company.sections.profile')
@elseif($section === 'settings')
    @include('company.sections.settings')
@endif

@endsection