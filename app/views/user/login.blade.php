@extends('layouts.blank')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-8 col-md-offset-2 col-lg-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ _('Login') }}</h3>
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
                    {{ Former::open()->method('POST')->rules(['email' => 'required|email', 'password' => 'required']) }}
                    <fieldset>
                    <div class="row">
                        <div class="center-block">
                            <img class="profile-img"
                                src="
                                @if ($login_cookie)
                                {{{getGravatar($login_cookie, 96)}}}
                                @else
                                https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120
                                @endif
                                " alt="">
                        </div>
                    </div>
                    @if ($login_cookie)
                        {{ Former::text('cr[email]')->placeholder(_('E-Mail-Adresse'))->readonly()->value($login_cookie) }}
                    @else
                        {{ Former::text('cr[email]')->placeholder(_('E-Mail-Adresse')) }}
                    @endif
                    {{ Former::password('cr[password]')->placeholder(_('Passwort')) }}
                    {{ Former::checkbox('remember')
                          ->text(_('Eingeloggt bleiben')) }}
                    {{ Former::submit('Sign in')->class('btn btn-success col-xs-12') }}
                    </fieldset>
                    {{ Former::close(); }}
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-12 small">
                            @if ($login_cookie)
                                    {{{_v('Nicht %s?', array($login_cookie ))}}} - <a href="{{{URL::route('login')}}}?flush=1">{{{_('Hier klicken')}}}</a> -
                            @endif
                            <a href="{{{URL::route('forget_password')}}}">{{{_('Passwort vergessen?')}}}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop