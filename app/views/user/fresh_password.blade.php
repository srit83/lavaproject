@extends('layouts.blank')
@section('content')
    <div class="col-md-10 col-sm-12">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ _('Login') }}</h3>
            </div>
            <div class="panel-body">
                @if(Session::has('warning'))
                    <div class="alert alert-warning">
                        <p>{{{ Session::get('warning') }}}</p>
                    </div>
                @endif
                {{ Former::open()->method('POST')->rules(['cr[password]' => 'required', 'cr[password_confirmation]' => 'required|confirmed']) }}
                <fieldset>

                <p class="text-info">{{{_('Bitte vergebe hier ein neues Passwort, für deinen Account.')}}}</p>

                {{ Former::password('cr[password]')->placeholder(_('Passwort')); }}
                {{ Former::password('cr[password_confirmation]')->placeholder(_('Passwort')); }}
                {{ Former::submit(_('Neues Passwort setzen'))->class('btn btn-success col-xs-12') }}
                </fieldset>
                {{ Former::close(); }}
            </div>

        </div>
    </div>
@stop