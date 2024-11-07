<?php

namespace App\Http\Controllers;

use App\Exceptions\EntityNotFoundException;
use App\Services\ManufacturerService;
use Exception;
use Illuminate\View\View;

class ManufacturerController extends Controller
{
    public function index(ManufacturerService $service): View {
        try {
            $manufacturers = $service->getAllManufacturers();
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

        return view(view: 'manufacturers.index', data: [
            'manufacturers' => $manufacturers
        ]);
    }
}
