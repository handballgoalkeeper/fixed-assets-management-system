<?php

namespace App\Observers;

use App\Facades\AuthUserFacade;
use App\Models\GroupXPermissionModel;
use Illuminate\Support\Facades\Cache;

class GroupXPermissionModelObserver
{
    public function created(GroupXPermissionModel $groupXPermissionModel): void
    {
        Cache::forget(key: AuthUserFacade::AUTH_USER_SESSION_KEY);
    }

    public function updated(GroupXPermissionModel $groupXPermissionModel): void
    {
        Cache::forget(key: AuthUserFacade::AUTH_USER_SESSION_KEY);
    }

    public function deleted(GroupXPermissionModel $groupXPermissionModel): void
    {
        Cache::forget(key: AuthUserFacade::AUTH_USER_SESSION_KEY);
    }
}
