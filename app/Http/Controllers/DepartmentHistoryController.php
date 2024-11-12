<?php

namespace App\Http\Controllers;


use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Models\DepartmentHistoryModel;
use App\Models\DepartmentModel;
use App\Services\DepartmentHistoryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentHistoryController extends Controller
{
    public function __construct(
        protected DepartmentHistoryService $departmentHistoryService
    )
    {
    }

    public function index(DepartmentModel $department): View | RedirectResponse
    {
        try {
            $departmentHistory = $this->departmentHistoryService->findAllPaginated(perPage: 10, entity: $department);
        }
        catch (GeneralException $e) {
            return redirect()->route('departments.index')->with('error', $e->getMessage());
        }
        catch(Exception $e) {
            return redirect()->route('departments.index')->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return view(view: 'pages.departments.history', data: [
            'departmentHistory' => $departmentHistory,
        ]);
    }
}
