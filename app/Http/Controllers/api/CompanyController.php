<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * This function is used to return data for company datatable in Json format
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $companies = Company::getDataTable();
        if ($companies) {
            return $this->successResponse($companies, 'Companies retrieved successfully.');
        } else {
            return $this->errorResponse($message = 'An error occurred.', 403);
        }
    }
    /**
     * This function is used to store company data
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $company = Company::createOrUpdateCompany($request);
        if ($company['success']) {
            return $this->successResponse([], $company['message']);
        }
        return $this->errorResponse($company['message'], $company['code']);
    }

    public function edit($id)
    {
        $company = Company::getCompanyData($id);
        if ($company['status'] == 'success') {
            return $this->successResponse($company['data'], $company['message']);
        }
        return $this->errorResponse($company['message'], $company['code']);
    }

    public function delete($id): JsonResponse
    {
        // $companies = Company::deleteRecord($id);
        // if ($companies) {
        return $this->successResponse(null, 'Companies retrieved successfully.');
        // } else {
        //     return $this->errorResponse($message = 'An error occurred.', 403);
        // }
    }
}
