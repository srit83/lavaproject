@extends('layouts.master')
@include('admin.sub_nav', array('active'=>'admin'))
@section('content')
    <h2>
        <?= __('Admin Bereich') ?>
    </h2>
    <p class="light">
        <?= __('Du kannst von hier aus Nutzer uvm. managen.') ?>
    </p>
    <hr>
    <div class="admin-dashboard">
        <div class="row">
            @if(hasAccess('users.all'))
            <div class="col-sm-4">
                <div class="light-well">
                    <h3>
                        <?= __('Nutzer') ?>
                    </h3>
                    <div class="data">
                        <a href="{{{URL::to('admin/users')}}}">
                            <h1>{{{Cartalyst\Sentry\Users\Eloquent\User::count()}}}</h1>
                        </a>
                        @if(hasAccess('users.create'))
                        <hr>
                        <a class="btn btn-success" href="{{{URL::to('admin/users/create')}}}"><i class="glyphicon glyphicon-plus"></i> <?= __('Neuen Nutzer anlegen') ?></a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection