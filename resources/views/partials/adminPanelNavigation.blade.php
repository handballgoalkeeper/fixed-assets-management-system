@php use App\Configs\AdminPanelNavigationConfig;use App\Configs\AppConfig; @endphp
<div class="container-flow">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-success fs-4 mx-4" href="{{ route('admin.index') }}">
                <img src="{{ asset('images/main-brand.png') }}" width="40" alt="BrandLogo">
                {{ AppConfig::SHORT_APP_NAME }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse container" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach(AdminPanelNavigationConfig::getAdminPanelNavigation() as $routeName => $routeMeta)
                        @if(is_null($routeMeta['permissionNeeded']) or \App\Facades\AuthUserFacade::hasPermission($routeMeta['permissionNeeded']))
                            <li class="nav-item">
                                <a href="{{ $routeMeta['route'] }}" class="nav-link">
                                    <i class="fs-4 {{ $routeMeta['icon'] }}"></i> <span>{{ $routeName }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link text-danger fw-bolder">
                            <i class="fs-4"></i> <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
