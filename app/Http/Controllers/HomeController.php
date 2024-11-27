<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Services\AssetService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(AssetService $assetService): View
    {
        try {
            $numberOfAssetsPerAssetType = $assetService->getNoOfAssetsPerAssetType();
        }
        catch (Exception) {
            return view('pages.home', [
                'numberOfAssetsPerAssetType' => null,
                'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
            ]);
        }
        return view('pages.home', compact('numberOfAssetsPerAssetType'));
    }
}
