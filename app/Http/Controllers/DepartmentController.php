<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\DepartmentModel;
use App\Services\DepartmentService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class DepartmentController extends Controller
{
    public function __construct(
        protected DepartmentService $departmentService
    )
    {
    }

    public function index(): View
    {
        try {
            $departments = $this->departmentService->findAllPaginated();
        }
        catch(EntityNotFoundException $e)
        {
            return view(view: 'pages.departments.index', data: [
                'departments' => null,
                'error' => $e->getMessage()
            ]);
        }
        catch (Exception $e)
        {
            return view(view: 'pages.departments.index', data: [
                'departments' => null,
                'error' => ErrorMessage::UNHANDLED_EXCEPTION
            ]);
        }

        return view(view: 'pages.departments.index', data: [
            'departments' => $departments
        ]);
    }

    public function create(DepartmentCreateRequest $request): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->departmentService->create($requestData);
        }
        catch (GeneralException $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch(Exception $e)
        {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->route('departments.index')->with('success', 'Department successfully created.');
    }

    public function permalink(DepartmentModel $department): View
    {
        return view(view: 'pages.departments.permalink', data: [
            'department' => $department
        ]);
    }

    public function update(DepartmentUpdateRequest $request, DepartmentModel $department): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->departmentService->update($requestData, $department);
        }
        catch(GeneralException | ValueNotUniqueException $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->route('departments.index')->with('success', 'Department successfully updated.');
    }
}
