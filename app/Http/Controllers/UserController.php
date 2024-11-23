<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\GroupAlreadyGranted;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\GrantGroupToUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\GroupModel;
use App\Models\User;
use App\Models\UserXGroupModel;
use App\Services\GroupService;
use App\Services\UserService;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
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

    public function create(CreateUserRequest $request): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->userService->createNewUser(requestData: $requestData);
        }
        catch (GeneralException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function permalink(User $user): View {
        return view(view: 'pages.admin.users.permalink', data: [
            'user' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $requestData = $request->validated();
        try {
            $this->userService->updateUser(requestData: $requestData, current: $user);
        }
        catch (GeneralException  | ValueNotUniqueException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch(Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function groups(User $user, GroupService $groupsService): View | RedirectResponse
    {
        try {
            $allGroups = $groupsService->findAll();
            $assignedGroups = $this->userService->getAssignedGroups(user: $user, perPage: 10);
        }
        catch(GeneralException | EntityNotFoundException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return view(view: 'pages.admin.users.groups', data: [
            'allGroups' => $allGroups,
            'assignedGroups' => $assignedGroups,
            'user' => $user
        ]);
    }

    public function grantGroup(GrantGroupToUserRequest $request, User $user): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->userService->assignGroupToUser(user: $user, requestData: $requestData);
        }
        catch (GeneralException | GroupAlreadyGranted $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'User granted successfully.');
    }

    public function revokeGroup(User $user, UserXGroupModel $group): RedirectResponse
    {
        try {
            $this->userService->revokeGroup(model: $group);
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Permission revoked successfully.');
    }
}
