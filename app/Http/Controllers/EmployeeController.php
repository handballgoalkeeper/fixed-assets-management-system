<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Http\Requests\CreateEmployeeRequest;
use App\Mappers\EmployeeMapper;
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

}
