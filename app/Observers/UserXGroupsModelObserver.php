<?php

namespace App\Observers;

use App\Facades\AuthUserFacade;
use App\Models\UserXGroupModel;
use Illuminate\Support\Facades\Cache;

class UserXGroupsModelObserver
{
    public function created(UserXGroupModel $userXGroupModel): void
    {
        Cache::forget(key: AuthUserFacade::AUTH_USER_SESSION_KEY);
    }

    public function updated(UserXGroupModel $userXGroupModel): void
    {
        Cache::forget(key: AuthUserFacade::AUTH_USER_SESSION_KEY);
    }

    public function deleted(UserXGroupModel $userXGroupModel): void
    {
        Cache::forget(key: AuthUserFacade::AUTH_USER_SESSION_KEY);
    }
}
