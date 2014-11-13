@extends('layouts.master')
@include('admin.sub_nav', array('active'=>'users'))
@section('content')
<div class="row">
@include('widgets.filter_sidebar', array('all_filters'=>$all_filters, 'filter' => $filter))
<div class="col-md-9 col-sm-12">
    @if($user_cnt > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{{_v('Nutzer (%d)', array($user_cnt))}}}
                <div class="panel-head-actions">
                    <a class="btn btn-success" href="{{{URL::route('users_create')}}}">{{{_('Neuen Nutzer anlegen')}}}</a>
                </div>
            </div>
            <ul class="well-list">
                @foreach($users as $oUser)
                    <li>
                        <div class="list-item-name">
                            <i class="fa fa-user">&nbsp;</i>
                            <a href="{{{URL::route('users_show', ['email' => $oUser->email])}}}">{{{$oUser}}}</a>
                            @if($oUser->email === Sentry::getUser()->email)
                                <span class="text-danger">{{{_('Dein Account')}}}</span>
                            @endif
                        </div>

                        @if(hasAccess(array('admin.users.edit', 'admin.users.delete', 'admin.users.block')) ||  $oUser->email === Sentry::getUser()->email)
                        <div class="pull-right">
                            @if(hasAccess(array('admin.users.edit')) || $oUser->email === Sentry::getUser()->email)
                                <a class="btn btn-xs btn-default" href="{{{URL::route('users_edit', ['email' => $oUser->email])}}}">{{{_('Bearbeiten')}}}</a>
                            @endif
                            @if(hasAccess(array('admin.users.block')) &&  $oUser->email !== Sentry::getUser()->email)
                                {? $oThrottleUser = Sentry::findThrottlerByUserId($oUser->id); ?}
                                @if($oThrottleUser->isBanned())
                                    <a class="btn btn-xs btn-success" href="{{{URL::route('users_unblock', ['email' => $oUser->email])}}}" data-method="put" data-confirm="{{{_v('Willst du den Account von %s wirklich wieder freigeben?', [$oUser->email])}}}">{{{_('Freigeben')}}}</a>
                                @else
                                    <a class="btn btn-xs btn-danger" href="{{{URL::route('users_block', ['email' => $oUser->email])}}}" data-method="put" data-confirm="{{{_v('Soll %s wirklich geblockt werden?', [$oUser->email])}}}">{{{_('Blocken')}}}</a>
                                @endif
                            @endif
                            @if(hasAccess(array('admin.users.delete')) &&  $oUser->email !== Sentry::getUser()->email)
                                <a class="btn btn-xs btn-danger" href="{{{URL::route('users_delete', ['email' => $oUser->email])}}}" data-method="delete" data-confirm="{{{_v('Der Nutzer %s wird dabei komplett gelöscht. Bist du dir sicher, das du das tun möchtest?', [$oUser->email])}}}">{{{_('Löschen')}}}</a>
                            @endif
                        </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-info">{{{_('Leider keine Daten verfügbar')}}}</p>
    @endif
</div>
</div>
@endsection