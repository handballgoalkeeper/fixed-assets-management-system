<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\LocationCreateRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\LocationModel;
use App\Services\LocationsService;
use Exception;
use Illuminate\Http\RedirectResponse;
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

    public function create(LocationCreateRequest $request): RedirectResponse {
        $requestData = $request->validated();

        try {
            $this->locationsService->create($requestData);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch(Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    public function permalink(LocationModel $location): View
    {
        return view('pages.locations.permalink', [
            'location' => $location
        ]);
    }

    public function update(LocationUpdateRequest $request, LocationModel $location): RedirectResponse {
        $requestData = $request->validated();

        try {
            $this->locationsService->update(requestData: $requestData, location: $location);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Location updated successfully.');
    }
}
