<?php

namespace App\Http\Controllers;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Http\Requests\ManufacturerRequest;
use App\Models\ManufacturerModel;
use App\Services\ManufacturerHistoryService;
use App\Services\ManufacturerService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ManufacturerController extends Controller
{
    public function __construct(
        protected ManufacturerService $manufacturerService
    )
    {
    }

    public function index(): View
    {
        try {
            $manufacturers = $this->manufacturerService->getAllManufacturersPaginated(perPage: 10);
        }
        catch (EntityNotFoundException $e) {
            return view(view: 'pages.manufacturers.index', data: [
                'manufacturers' => []
            ])->with('error', $e->getMessage());
        }
        catch(Exception $e) {
            return view(view: 'pages.manufacturers.index', data: [
                'manufacturers' => []
            ])->with('error', "Unhandled exception occurred, please contact support.");
        }

        return view(view: 'pages.manufacturers.index', data: [
            'manufacturers' => $manufacturers
        ]);
    }

    public function permalink(ManufacturerModel $manufacturer): View
    {
        return view(view: 'pages.manufacturers.permalink', data: [
            'manufacturer' => $manufacturer
        ]);
    }

    public function update(ManufacturerRequest $request, ManufacturerModel $manufacturer): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->manufacturerService->update($requestData, $manufacturer);
        }
        catch (GeneralException $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        catch (Exception $e) {
            return redirect()->back()->with("error", "Unhandled exception occurred, please contact support.");
        }

        return redirect()->route('manufacturers.index')->with("success", "Manufacturer successfully updated.");
    }
}
