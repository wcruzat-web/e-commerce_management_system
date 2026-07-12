@extends('errors.layout')

@section('title', 'Unauthorized')
@section('code', '401')
@section('image', asset('images/errors/401.webp'))
@section('message', 'You are not authorized to access this page.')
