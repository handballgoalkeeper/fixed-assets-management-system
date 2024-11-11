<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Services\DepartmentService;
use Exception;
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
}
