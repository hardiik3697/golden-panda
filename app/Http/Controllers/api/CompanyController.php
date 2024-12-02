<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
