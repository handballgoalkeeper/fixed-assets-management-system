<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Services\PermissionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionsController extends Controller
{
    public function __construct(
        protected PermissionService $permissionService
    )
    {
    }

    public function index(): View
    {
        try {
            $permissions = $this->permissionService->findAllPaginated(perPage: 10);
        }
        catch(EntityNotFoundException $exception) {
            return view(view: 'pages.admin.permissions.index', data: [
                'error' => $exception->getMessage(),
                'permissions' => null
            ]);
        }
        catch (Exception) {
            return view(view: 'pages.admin.permissions.index', data: [
                'error' => ErrorMessage::UNHANDLED_EXCEPTION,
                'permissions' => null
            ]);
        }

        return view(view: 'pages.admin.permissions.index', data: [
            'permissions' => $permissions
        ]);
    }
}
