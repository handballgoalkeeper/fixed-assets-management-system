<?php

namespace App\Http\Controllers;

use App\Exceptions\EntityNotFoundException;
use App\Services\ManufacturerService;
use Exception;
use Illuminate\View\View;

class ManufacturerController extends Controller
{
    public function __construct(protected ManufacturerService $manufacturerService)
    {
    }

    public function index(): View {
        try {
            $manufacturers = $this->manufacturerService->getAllManufacturers();
        }
        catch (EntityNotFoundException $e) {
            return view(view: 'manufacturers.index', data: [
                'manufacturers' => []
            ])->with('error', $e->getMessage());
        }
        catch(Exception $e) {
            return view(view: 'manufacturers.index', data: [
                'manufacturers' => []
            ])->with('error', "Unhandled exception occurred, please contact support.");
        }

        return view(view: 'pages.manufacturers.index', data: [
            'manufacturers' => $manufacturers
        ]);
    }
}
