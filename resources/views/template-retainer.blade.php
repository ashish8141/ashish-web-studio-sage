{{--
  Template Name: WordPress Maintenance
--}}

@extends('layouts.app')

@section('content')
  @include('retainer.welcome')
  @include('retainer.hero')
  @include('retainer.marquee')
  @include('retainer.problems')
  @include('retainer.checklist')
  @include('retainer.included')
  @include('retainer.schedule')
  @include('retainer.pricing')
  @include('retainer.fit')
  @include('retainer.faq')
  @include('retainer.contact')
  @include('retainer.scripts')
  @include('retainer.paypal')
@endsection
