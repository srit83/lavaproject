@section('sub_nav')
<nav class="sub-nav navbar-collapse collapse">
    <div class="container">
        <ul>
            @if(hasAccess('admin.show'))
            <li
                @if($active == 'admin')
                    class="active"
                @endif
                >
                <a href="{{{URL::route('admin')}}}" title="{{ _('Überblick') }}"> {{ _('Überblick') }}</a>
            </li>
            @endif
            @if(hasAccess('users.all'))
            <li
                @if($active == 'users')
                    class="active"
                @endif
            >
                <a href="{{{URL::route('users_all')}}}" title="{{ _('Nutzer') }}"> {{ _('Nutzer') }}</a>
            </li>
            @endif
        </ul>
    </div>
</nav>
@append