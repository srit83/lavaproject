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

        <!-- CSS are placed here -->
        {{ HTML::style('assets/stylesheets/backend.css') }}

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
                        <li><a href="{{{ URL::to('') }}}"><?= __('Dashboard') ?></a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if(hasAccess(array('admin.users.all', 'admin.users.create', 'admin.users.view', 'admin.users.delete', 'admin.users.edit', 'admin.show')))
                            <li><a href="{{{URL::to('admin')}}}" data-original-title="<?= __('Admin Bereich') ?>" title="<?= __('Admin Bereich') ?>"><i class="glyphicon glyphicon-cog"></i></a></li>
                        @endif
                        <li><a href="{{{URL::to('logout')}}}" data-orinal-title="<?= __('Logout') ?>" title="<?= __('Logout') ?>"><i class="glyphicon glyphicon-log-out"></i></a></li>
                        <li class="hidden-xs">
                            <a href="javascript:void(0);" class="profile-pic"><img alt="<?= __('User') ?>" src="http://www.gravatar.com/avatar/<?= md5(Sentry::getUser()->email) ?>?s=26&d=identicon"></a>
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
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        <p>{{{ Session::get('success') }}}</p>
                    </div>
                @endif
                @if(Session::has('warning'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        <p>{{{ Session::get('warning') }}}</p>
                    </div>
                @endif
                @if(Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        <p>{{{ Session::get('danger') }}}</p>
                    </div>
                @endif
                @if(Session::has('info'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        <p>{{{ Session::get('info') }}}</p>
                    </div>
                @endif
                </div>
                <!-- Content -->
                @yield('content')
            </div>
        </div>

        <!-- Scripts are placed here -->
        {{ HTML::script('assets/javascript/backend.js') }}

    </body>
</html>