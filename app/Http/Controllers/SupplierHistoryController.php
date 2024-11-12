<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Models\SupplierModel;
use App\Services\SupplierHistoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierHistoryController extends Controller
{
    public function __construct(protected SupplierHistoryService $supplierHistoryService)
    {
    }

    public function history(SupplierModel $supplier): View {
        try {
            $supplierHistory = $this->supplierHistoryService->findAllPaginated(perPage: 10, entity: $supplier);
        } catch (GeneralException $e) {
            return view(view: 'pages.suppliers.history', data: [
                'supplierHistory' => null,
                'error' => $e->getMessage()
            ]);
        } catch (Exception $e) {
            return view(view: 'pages.suppliers.history', data: [
                'supplierHistory' => null,
                'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
            ]);
        }

        return view(view: 'pages.suppliers.history', data: [
            'supplierHistory' => $supplierHistory,
        ]);
    }
}
