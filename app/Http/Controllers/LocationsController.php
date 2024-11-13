<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Services\LocationsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationsController extends Controller
{
    public function __construct(
        protected LocationsService $locationsService
    )
    {
    }

    public function index(): View
    {
        try {
            $locations = $this->locationsService->findAllPaginated(perPage: 10);
        }
        catch (GeneralException | EntityNotFoundException $e) {
            return view(view: 'pages.locations.index', data: [
                'locations' => null,
                'error' => $e->getMessage()
            ]);
        }
        catch (Exception) {
            return view(view: 'pages.locations.index', data: [
                'locations' => null,
                'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
            ]);
        }

        return view(view: 'pages.locations.index', data: [
            'locations' => $locations
        ]);
    }
}
