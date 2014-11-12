<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            Alpha Projects
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @section('css')
        <!-- CSS are placed here -->
        {{ HTML::style('assets/stylesheets/backend.css') }}
        @show

        <style>
        @section('styles')
            body {
                padding-top: 60px;
            }
        @show
        </style>
    </head>

    <body>
    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="#">Alpha Projects</a>
                </div>
                <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{{ URL::route('root') }}}">{{ _('Dashboard') }}</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if(hasAccess(array('admin.users.all', 'admin.users.create', 'admin.users.show', 'admin.users.delete', 'admin.users.edit', 'admin.show')))
                            <li><a href="{{{URL::route('admin')}}}" data-original-title="{{ _('Admin Bereich') }}" title="{{ _('Admin Bereich') }}"><i class="glyphicon glyphicon-cog"></i></a></li>
                        @endif
                        <li><a href="{{{URL::route('logout')}}}" data-orinal-title="{{ _('Logout') }}" title="{{ _('Logout') }}"><i class="glyphicon glyphicon-log-out"></i></a></li>
                        <li class="hidden-xs">
                            <a href="javascript:void(0);" class="profile-pic"><img alt="{{ _('User') }}" src="{{{getGravatar(Sentry::getUser()->email, 26)}}}"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
    @section('sub_nav')

    @show
        <!-- Container -->
        <div class="container">
            <div class="content">
                <div class="flash-container">
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
                @if(Session::has('danger'))
                    <div class="alert alert-danger">
                        <p>{{{ Session::get('danger') }}}</p>
                    </div>
                @endif
                @if(Session::has('info'))
                    <div class="alert alert-info">
                        <p>{{{ Session::get('info') }}}</p>
                    </div>
                @endif
                </div>
                <!-- Content -->
                @yield('content')
            </div>
        </div>

        @section('javascript')
            <!-- Scripts are placed here -->
            {{ HTML::script('assets/javascript/backend.js') }}
        @show




    </body>
</html>