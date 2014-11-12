@extends('layouts.master')
@include('admin.sub_nav', array('active'=>'users'))
@section('content')
    <h2 class="page-title">
        {{ _v('%s ändern', array('ich')) }}
    </h2>
    @include('users._partials.form', array('user' => $user))
@endsection