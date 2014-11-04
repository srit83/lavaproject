@extends('layouts.master')
@include('admin.sub_nav', array('active'=>'users'))
@section('content')
    <h2 class="page-title">
        <?= __('Neuen Nutzer anlegen') ?>
    </h2>
    <div>
    <?= Former::horizontal_open() ?>
    <fieldset>
        <legend><?= __('Nutzerdaten') ?></legend>
        <?= Former::text('us[first_name]')->label(__('Vorname'))->placeholder(__('Vorname'))->required() ?>
        <?= Former::text('us[last_name]')->label(__('Nachname'))->placeholder(__('Nachname'))->required() ?>
        <?= Former::text('us[email]')->label(__('E-Mail-Adresse'))->placeholder(__('E-Mail-Adresse'))->required(); ?>
    </fieldset>
    <fieldset>
        <legend><?= __('Passwort') ?></legend>
        <?= Former::password('us[password]')->label(__('Passwort'))->placeholder(__('Passwort'))->required(); ?>
    </fieldset>
    <fieldset>
        <legend><?= __('Rechte') ?></legend>
        <?= Former::select('us[group]')->fromQuery(\Cartalyst\Sentry\Groups\Eloquent\Group::all(), 'name', 'id')->label(__('Gruppe'))->placeholder(__('Gruppe'))->required() ?>
        <?= Former::checkbox('us[activated]')->label('&nbsp;')->text(__('Der Nutzer ist aktiv')); ?>

    </fieldset>
    <div class="form-actions">
        <input class="btn btn-success" name="commit" type="submit" value="<?= __('Nutzer anlegen') ?>">
        <a class="btn btn-default" href="{{{URL::to('admin/users')}}}"><?= __('Abbrechen') ?></a>
    </div>
    </div>
@endsection