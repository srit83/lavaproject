@extends('layouts.blank')
@section('content')
    <div class="col-md-10 col-sm-12">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ _('Neues Passwort vergeben') }}</h3>
            </div>
            <div class="panel-body">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{{ Session::get('success') }}}</p>
                    </div>
                @endif
                @if(Session::has('warning'))
                    <div class="alert alert-warning">
                        <p>{{{ Session::get('warning') }}}</p>
                    </div>
                @endif
                {{ Former::open()->method('POST')->rules(['cr[email]' => 'required|email']) }}
                <fieldset>

                <p class="text-info">{{{_('Bitte gebe deine E-Mail-Adresse an.')}}}</p>

                {{ Former::email('cr[email]')->placeholder(_('E-Mail-Adresse')); }}
                {{ Former::actions()->large_primary_submit(_('Passwort setzen')) }}
                </fieldset>
                {{ Former::close(); }}
            </div>

        </div>
    </div>
@stop