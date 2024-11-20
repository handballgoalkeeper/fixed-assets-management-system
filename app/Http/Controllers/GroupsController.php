<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Models\GroupModel;
use App\Services\GroupService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GroupsController extends Controller
{
    public function __construct(
        protected GroupService $groupService
    )
    {
    }

    public function index(): View
    {
        try {
            $groups = $this->groupService->findAllPaginated(perPage: 10);
        }
        catch (EntityNotFoundException $exception) {
            return view(view: 'pages.admin.groups.index', data: [
                'error' => $exception->getMessage(),
                'groups' => null
            ]);
        }
        catch(Exception) {
            return view(view: 'pages.admin.groups.index', data: [
                'error' => ErrorMessage::UNHANDLED_EXCEPTION,
                'groups' => null
            ]);
        }
        return view(view: 'pages.admin.groups.index', data: [
            'groups' => $groups
        ]);
    }

    public function create(GroupCreateRequest $request): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->groupService->create($requestData);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Group created successfully.');
    }

    public function permalink(GroupModel $group): View
    {
        return view(view: 'pages.admin.groups.permalink', data: [
            'group' => $group
        ]);
    }

    public function update(GroupUpdateRequest $request, GroupModel $group): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->groupService->update(requestData: $requestData, currentModel: $group);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Group updated successfully.');
    }
}
