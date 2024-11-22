<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Services\UserService;
use Exception;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {
    }

    public function index(): View
    {
        try {
            $users = $this->userService->findAllPaginated(perPage: 10);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            return view(view: 'pages.admin.users.index', data: [
                'error' => $e->getMessage(),
                'users' => null
            ]);
        }
        catch (Exception) {
            return view(view: 'pages.admin.users.index', data: [
                'error' => ErrorMessage::UNHANDLED_EXCEPTION->value,
                'users' => null
            ]);
        }

        return view('pages.admin.users.index', data: [
            'users' => $users
        ]);
    }
}
