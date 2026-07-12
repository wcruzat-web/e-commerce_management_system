@extends('errors.layout')

@section('title', 'Forbidden')
@section('code', '403')
@section('image', asset('images/errors/403.webp'))
@section('message', $exception->getMessage() ?: 'You don\'t have permission to access this page.')
