<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i
                            class="glyphicon glyphicon-info-sign text-success"></i> {{ trans('simple-cms::generic.online') }}
                </a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">{{ trans('simple-cms::generic.main_navigation') }}</li>
            <li class="{{ $controller == 'DashboardController' ? 'active' : '' }}">
                <a href="{{ route('manage.dashboard.index') }}">
                    <i class="glyphicon glyphicon-dashboard"></i>
                    <span>{{ trans('simple-cms::dashboard.title') }}</span>
                </a>
            </li>
            <li class="{{ $controller == 'ContentController' ? 'active' : '' }}">
                <a href="{{ route('manage.contents.index') }}">
                    <i class="glyphicon glyphicon-duplicate"></i>
                    <span>{{ trans('simple-cms::sites.title') }}</span>
                </a>
            </li>
            <li class="{{ $controller == 'MediaController' ? 'active' : '' }}">
                <a href="{{ route('manage.media.index') }}">
                    <i class="glyphicon glyphicon-picture"></i>
                    <span>{{ trans('simple-cms::media.title') }}</span>
                </a>
            </li>
            <li class="{{ $controller == 'ContactController' ? 'active' : '' }}">
                <a href="{{ route('manage.contacts.edit', array('id' => $contact->id)) }}">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>{{ trans('simple-cms::contact.title') }}</span>
                </a>
            </li>
            <li class="{{ $controller == 'SettingController' ? 'active' : '' }}">
                <a href="{{ route('manage.settings.edit', array('id' => $settings->id)) }}">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>{{ trans('simple-cms::settings.title') }}</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
