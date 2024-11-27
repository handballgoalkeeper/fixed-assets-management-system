<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\CreateAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\AssetModel;
use App\Models\EmployeeModel;
use App\Services\AssetDetailsService;
use App\Services\AssetService;
use App\Services\EmployeeService;
use App\Services\LocationsService;
use App\Services\ManufacturerService;
use App\Services\SupplierService;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AssetsController extends Controller
{
    public function __construct(
        protected AssetService $assetService,
        protected ManufacturerService $manufacturerService,
        protected AssetDetailsService $assetDetailsService,
        protected EmployeeService $employeeService,
    )
    {
    }

    public function index(): View
    {
        $assets = AssetModel::paginate(perPage: 10);
        return view('pages.assets.index', [
            'assets' => $assets
        ]);
    }

    public function renderCreate(): View | RedirectResponse
    {
        try {
            $manufacturers = $this->manufacturerService->getAllActiveManufacturers();
        } catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return view(view: 'pages.assets.createForm', data: [
            'manufacturers' => $manufacturers
        ]);
    }

    public function create(CreateAssetRequest $request): RedirectResponse
    {
        $requestData = $request->validated();
        try {
            $this->assetService->create(requestData: $requestData);
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Asset created successfully.');
    }

    public function permalink(AssetModel $asset, SupplierService $supplierService, LocationsService $locationsService): View | RedirectResponse
    {
        try {
            $manufacturers = $this->manufacturerService->findAllActive();
            $suppliers = $supplierService->findAllActive();
            $employees = $this->employeeService->findAllActive();
            $locations = $locationsService->findAllActive();
        }
        catch (GeneralException | EntityNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return view('pages.assets.permalink', [
            'asset' => $asset,
            'manufacturers' => $manufacturers,
            'suppliers' => $suppliers,
            'employees' => $employees,
            'locations' => $locations
        ]);
    }

    public function update(UpdateAssetRequest $request, AssetModel $asset): RedirectResponse
    {
        try {
            $this->assetService->update(model: $asset, requestData: $request->validated());
            $this->assetDetailsService->update(model: $asset->getAttribute('assetDetails'), requestData: $request->validated());
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Asset updated successfully.');
    }
}
