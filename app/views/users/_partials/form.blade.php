<div>
@if(isset($user) && $user)
    {{ Former::populate($user) }}
    {{ Former::populateField('group', $user->getGroups()->first()->id) }}
@endif
    {{ Former::horizontal_open() }}
    <fieldset>
        <legend>{{ _('Nutzerdaten') }}</legend>
        {{ Former::text('first_name')->label(_('Vorname'))->placeholder(_('Vorname'))->required() }}
        {{ Former::text('last_name')->label(_('Nachname'))->placeholder(_('Nachname'))->required() }}
        {{ Former::text('email')->label(_('E-Mail-Adresse'))->placeholder(_('E-Mail-Adresse')); }}
    </fieldset>
    <fieldset>
        <legend>{{ _('Passwort') }}</legend>
        <span class="text-info">
            @if(isset($user) && $user)
                {{{_('Lass das Passwort den Nutzer bittte ändern.')}}}
            @else
                {{{_('Dem Nutzer wird ein Link zum generieren eines Passwortes zugeschickt.')}}}
            @endif
        </span>
    </fieldset>
    <fieldset>
        <legend>{{ _('Rechte') }}</legend>
        {{ Former::select('group')->fromQuery(\Cartalyst\Sentry\Groups\Eloquent\Group::all(), 'name', 'id')->label(_('Gruppe'))->placeholder(_('Gruppe'))->required() }}
        {{ Former::checkbox('activated')->label('&nbsp;')->text(_('Der Nutzer ist aktiv')); }}

    </fieldset>
    <div class="form-actions">


        <input class="btn btn-success" name="commit" type="submit" value="
        @if(isset($user))
            {{ _('Nutzer ändern') }}
        @else
            {{ _('Nutzer anlegen') }}
        @endif
        ">
        <a class="btn btn-default" href="{{{URL::previous()}}}">{{ _('Abbrechen') }}</a>
    </div>
</div>