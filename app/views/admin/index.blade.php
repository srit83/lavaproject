@extends('layouts.master')
@include('admin.sub_nav', array('active'=>'admin'))
@section('content')
    <h2>
        {{ _('Admin Bereich') }}
    </h2>
    <p class="light">
        {{ _('Du kannst von hier aus Nutzer uvm. managen.') }}
    </p>
    <hr>
    <div class="admin-dashboard">
        <div class="row">
            @if(hasAccess('users.all'))
            <div class="col-sm-4">
                <div class="light-well">
                    <h3>
                        {{ _('Nutzer') }}
                    </h3>
                    <div class="data">
                        <a href="{{{URL::route('users_all')}}}">
                            <h1>{{{Cartalyst\Sentry\Users\Eloquent\User::count()}}}</h1>
                        </a>
                        @if(hasAccess('users.create'))
                        <hr>
                        <a class="btn btn-success" href="{{{URL::route('users_create')}}}"><i class="glyphicon glyphicon-plus"></i> {{ _('Neuen Nutzer anlegen') }}</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection