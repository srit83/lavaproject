@extends('layouts.master')
@include('admin.sub_nav', array('active'=>'users'))
@section('content')
    <h2 class="page-title">
        {{ _('Neuen Nutzer anlegen') }}
    </h2>
    <div>
    {{ Former::horizontal_open() }}
    <fieldset>
        <legend>{{ _('Nutzerdaten') }}</legend>
        {{ Former::text('us[first_name]')->label(_('Vorname'))->placeholder(_('Vorname'))->required() }}
        {{ Former::text('us[last_name]')->label(_('Nachname'))->placeholder(_('Nachname'))->required() }}
        {{ Former::text('us[email]')->label(_('E-Mail-Adresse'))->placeholder(_('E-Mail-Adresse'))->required(); }}
    </fieldset>
    <fieldset>
        <legend>{{ _('Passwort') }}</legend>
        <span class="text-info">{{{_('Dem Nutzer wird ein Link zum generieren eines Passwortes zugeschickt.')}}}</span>
    </fieldset>
    <fieldset>
        <legend>{{ _('Rechte') }}</legend>
        {{ Former::select('us[group]')->fromQuery(\Cartalyst\Sentry\Groups\Eloquent\Group::all(), 'name', 'id')->label(_('Gruppe'))->placeholder(_('Gruppe'))->required() }}
        {{ Former::checkbox('us[activated]')->label('&nbsp;')->text(_('Der Nutzer ist aktiv')); }}

    </fieldset>
    <div class="form-actions">
        <input class="btn btn-success" name="commit" type="submit" value="{{ _('Nutzer anlegen') }}">
        <a class="btn btn-default" href="{{{URL::previous()}}}">{{ _('Abbrechen') }}</a>
    </div>
    </div>
@endsection