<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Services\SupplierService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierService $supplierService
    )
    {
    }

    public function index(): View {
        try {
            $suppliers = $this->supplierService->findAllPaginated();
        }
        catch (EntityNotFoundException $e) {
            return view(
                view: 'pages.suppliers.index',
                data: [
                    'suppliers' => null,
                    'error' => $e->getMessage()
                ]
            );
        }
        catch (Exception $e) {
            return view(
                view: 'pages.suppliers.index',
                data: [
                    'suppliers' => null,
                    'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
                ]
            );
        }

        return view(
            view: 'pages.suppliers.index',
            data: [
                'suppliers' => $suppliers
            ]
        );
    }
}
