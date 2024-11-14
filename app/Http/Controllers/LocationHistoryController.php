<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Models\LocationModel;
use App\Services\LocationHistoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationHistoryController extends Controller
{
    public function __construct(
        protected LocationHistoryService $locationHistoryService
    )
    {
    }

    public function history(LocationModel $location): View {
        try {
            $locationHistory = $this->locationHistoryService->findAllByLocationPaginated(perPage: 10, location: $location);
        }
        catch (GeneralException $e) {
            return view('pages.locations.history', [
                'locationHistory' => null,
                'error' => $e->getMessage()
            ]);
        }
        catch (Exception) {
            return view('pages.locations.history', [
                'locationHistory' => null,
                'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
            ]);
        }

        return view('pages.locations.history', [
            'locationHistory' => $locationHistory
        ]);
    }
}
