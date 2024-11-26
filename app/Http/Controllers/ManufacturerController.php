<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\ManufacturerCreateRequest;
use App\Http\Requests\ManufacturerRequest;
use App\Models\ManufacturerModel;
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
        } catch (EntityNotFoundException $e) {
            return view(view: 'pages.manufacturers.index', data: [
                'manufacturers' => null
            ])->with('error', $e->getMessage());
        } catch (Exception $e) {
            return view(view: 'pages.manufacturers.index', data: [
                'manufacturers' => null
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
        } catch (GeneralException|ValueNotUniqueException $e) {
            return redirect()->back()->with("error", $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with("error", "Unhandled exception occurred, please contact support.");
        }

        return redirect()->route('manufacturers.index')->with("success", "Manufacturer successfully updated.");
    }

    public function create(ManufacturerCreateRequest $request): RedirectResponse
    {
        $requestData = $request->validated();

        try {
            $this->manufacturerService->create($requestData);
        } catch (GeneralException|ValueNotUniqueException $e) {
            return redirect()->back()->with("error", $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with("error", ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->route(route: 'manufacturers.index')->with("success", "Manufacturer successfully created.");
    }
}
