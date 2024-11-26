<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Services\EmployeeService;
use Exception;
use Illuminate\Http\Request;
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
}
