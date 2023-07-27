<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

use App\Http\Resources\Api\V1\CompanyResource;
use App\Http\Resources\Api\V1\CompanyCollection;

use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CompanyCollection(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->all());
        return response()->json(['status' => true, 'message' => "Company data added successfully."], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());
        return response()->json(['status' => true, 'message' => "Company data updated successfully."], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($companyId)
    {
        $company = Company::find($companyId);
        if(empty($company)) {
            return response()->json(['status' => false, 'message' => sprintf("Company with ID: %s not found.", $companyId)], 400);
        }

        $company->delete();
        return response()->json(['status' => true, 'message' => "Company data deleted successfully."], 200);

    }

    /**
     * Get employees that belongs to the specified company
     *
     * @param  mixed $companyId
     * @return Object
     */
    public function getEmployees($companyId)
    {
        $company = Company::find($companyId);
        if(empty($company)) {
            return response()->json(['status' => false, 'message' => sprintf("Nie znaleziono firmy o ID: %s", $companyId)], 400);
        }

        return $company->employees()->get();
    }
}
