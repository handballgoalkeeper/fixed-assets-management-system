<?php

namespace App\Http\Controllers;

use App\Enums\ErrorMessage;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierRequest;
use App\Models\SupplierModel;
use App\Services\SupplierService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierService $supplierService
    )
    {
    }

    public function index(): View {
        try {
            $suppliers = $this->supplierService->findAllPaginated();
        }
        catch (EntityNotFoundException $e) {
            return view(
                view: 'pages.suppliers.index',
                data: [
                    'suppliers' => null,
                    'error' => $e->getMessage()
                ]
            );
        }
        catch (Exception $e) {
            return view(
                view: 'pages.suppliers.index',
                data: [
                    'suppliers' => null,
                    'error' => ErrorMessage::UNHANDLED_EXCEPTION->value
                ]
            );
        }

        return view(
            view: 'pages.suppliers.index',
            data: [
                'suppliers' => $suppliers
            ]
        );
    }

    public function permalink(SupplierModel $supplier): View
    {
        return view(
            view: 'pages.suppliers.permalink',
            data: [
                'supplier' => $supplier
            ]
        );
    }

    public function update(SupplierRequest $request, SupplierModel $supplier): RedirectResponse
    {

        $request = $request->validated();

        try {
            $this->supplierService->update(requestData: $request, current: $supplier);
        }
        catch (ValueNotUniqueException | GeneralException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (Exception $e) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->back()->with('success', 'Supplier updated successfully.');
    }

    public function create(SupplierCreateRequest $request): RedirectResponse
    {
        $request = $request->validated();

        try {
            $this->supplierService->create($request);
        }
        catch (ValueNotUniqueException | GeneralException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch(Exception $e) {
            return redirect()->back()->with('error', ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    }
}
