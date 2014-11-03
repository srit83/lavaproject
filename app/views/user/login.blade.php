@extends('layouts.blank')
@section('content')
    <div class="col-md-10 col-sm-12">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= __('Login') ?></h3>
            </div>
            <div class="panel-body">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{{ Session::get('success') }}}</p>
                    </div>
                @endif
                @if(Session::has('login_failed'))
                    <div class="alert alert-warning">
                        <p>{{{ Session::get('login_failed') }}}</p>
                    </div>
                @endif
                <?= Former::open()->method('POST')->rules(['email' => 'required|email', 'password' => 'required']) ?>
                <?= Former::text('cr[email]')->placeholder(__('E-Mail-Adresse'))->autofocus(); ?>
                <?= Former::password('cr[password]')->placeholder(__('Passwort')); ?>
                <?= Former::checkbox('remember')
                      ->text(__('Eingeloggt bleiben')) ?>
                <?= Former::actions()->large_primary_submit(__('Login')) ?>
                <?= Former::close(); ?>
            </div>
        </div>
    </div>
@stop