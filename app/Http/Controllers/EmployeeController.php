<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Mappers\EmployeeMapper;
use App\Models\EmployeeModel;
use App\Services\EmployeeService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $employeeService
    )
    {
    }

    public function index(): View
    {
        try {
            $employees = $this->employeeService->findAllPaginated();
        }
        catch(GeneralException | EntityNotFoundException $e) {
            return view(view: 'pages.employees.index', data: [
                'employees' => null,
                'error' => $e->getMessage()
            ]);
        }
        catch (Exception) {
            return view(view: 'pages.employees.index', data: [
               'employees' => null,
               'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
            ]);
        }

        return view(view: 'pages.employees.index', data: [
            'employees' => $employees
        ]);
    }

    public function create(CreateEmployeeRequest $request): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->employeeService->create(requestData: $requestData);
        }
        catch (GeneralException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch(Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function permalink(EmployeeModel $employee): View
    {
        return view(view: 'pages.employees.permalink', data: [
            'employee' => $employee
        ]);
    }

    public function update(UpdateEmployeeRequest $request, EmployeeModel $employee): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->employeeService->update($employee, $requestData);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch(Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Employee updated successfully.');
    }

}
