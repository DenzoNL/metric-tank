<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

    {{--<!-- Sidebar user panel (optional) -->--}}
    {{--@if (! Auth::guest())--}}
    {{--<div class="user-panel">--}}
    {{--<div class="pull-left image">--}}
    {{--<img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />--}}
    {{--</div>--}}
    {{--<div class="pull-left info">--}}
    {{--<p>{{ Auth::user()->name }}</p>--}}
    {{--<!-- Status -->--}}
    {{--<a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endif--}}

    {{--<!-- search form (Optional) -->--}}
    {{--<form action="#" method="get" class="sidebar-form">--}}
    {{--<div class="input-group">--}}
    {{--<input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>--}}
    {{--<span class="input-group-btn">--}}
    {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--<!-- /.search form -->--}}

    <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
        {{--<li class="header">{{ trans('adminlte_lang::message.header') }}</li>--}}
        <!-- Optionally, you can add icons to the links -->
            <li {{ (request()->is('home') ? 'class=active' : '') }}><a href="{{ url('home') }}"><i class='fa fa-home'></i>
                    <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li {{ (request()->is('games') ? 'class=active' : '') }}><a href="{{ url('games') }}"><i class='fa fa-gamepad'></i>
                    <span>Games</span></a></li>
            <li {{ (request()->is('categories') ? 'class=active' : '') }}><a href="{{ url('categories') }}"><i class='fa fa-tags'></i>
                    <span>Metric Categories</span></a></li>
            <li {{ (request()->is('names') ? 'class=active' : '') }}><a href="{{ url('names') }}"><i class='fa fa-th-list'></i>
                    <span>Metric Names</span></a></li>
            <li {{ (request()->is('platforms') ? 'class=active' : '') }}><a href="{{ url('platforms') }}"><i class='fa fa-database'></i>
                    <span>Platforms</span></a></li>
            <li {{ (request()->is('sessions') ? 'class=active' : '') }}><a href="{{ url('sessions') }}"><i class='fa fa-clock-o'></i>
                    <span>Sessions</span></a></li>
            <li {{ (request()->is('devices') ? 'class=active' : '') }}><a href="{{ url('devices') }}"><i class='fa fa-laptop'></i>
                    <span>Devices</span></a></li>

            {{--<li><a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.anotherlink') }}</span></a></li>--}}
            {{--<li class="treeview">--}}
            {{--<a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>--}}
            {{--<li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
