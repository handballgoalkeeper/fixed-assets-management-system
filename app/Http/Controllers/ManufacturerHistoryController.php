<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Models\ManufacturerModel;
use App\Services\ManufacturerHistoryService;
use Exception;
use Illuminate\View\View;

class ManufacturerHistoryController extends Controller
{
    public function __construct(
        protected ManufacturerHistoryService $manufacturerHistoryService
    )
    {
    }

    public function history(ManufacturerModel $manufacturer): View {
        try {
            $manufacturerHistory = $this->manufacturerHistoryService->findAllPaginated(perPage: 10, entity: $manufacturer);
        }
        catch (GeneralException $e) {
            return view(view: 'pages.manufacturers.history', data: [
                'manufacturerHistory' => null,
                'error' => $e->getMessage()
            ]);
        }
        catch (Exception $e) {
            return view(view: 'pages.manufacturers.history', data: [
                'manufacturerHistory' => null,
                'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
            ]);
        }

        return view(view: 'pages.manufacturers.history', data: [
            'manufacturerHistory' => $manufacturerHistory,
        ]);
    }
}
