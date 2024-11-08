<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="{{ route('home') }}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">{{ \App\Configs\AppConfig::SHORT_APP_NAME }}</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            @foreach(\App\Configs\MainNavigationConfig::getMainNavigation() as $routeName => $routeMeta)
                <li class="nav-item">
                    <a href="{{ $routeMeta['route'] }}" class="nav-link align-middle px-0">
                        <i class="fs-4 {{ $routeMeta['icon'] }}"></i> <span class="ms-1 d-none d-sm-inline">{{ $routeName }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
