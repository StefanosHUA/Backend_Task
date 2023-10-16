<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Company; // Import the Company model

class CompanyController extends Controller
{
    /**
     * Retrieve a list of companies with optional filters.
     *
     * @param Request $request
     * @return JsonResponse
     */


    //Get all companies controller

    public function GetFilteredData(Request $request)
    {
        // Retrieve all companies from the database
        $companies = Company::query();

        // Apply filters if provided in the request
        if ($request->has('city')) {
            $companies->where('city', $request->input('city'));
        }

        if ($request->has('country')) {
            $companies->where('country', $request->input('country'));
        }

        if ($request->has('industry')) {
            $companies->where('industry', $request->input('industry'));
        }

        if ($request->has('funding_state')) {
            $companies->where('funding_state', $request->input('funding_state'));
        }

        $filteredCompanies = $companies->get();

        return response()->json($filteredCompanies);
    }


    //Get company by CompanyID controller

    public function GetCompanyById($company_id)
    {
        // Retrieve the company with the given $company_id
        $company = Company::where('company_id', $company_id)->first();

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json($company);
    }


    public function CreateEntry(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'company_id' => 'required|integer',
            'logo' => 'nullable|string',
            'name' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'webmail' => 'nullable|string',
            'email' => 'required|string',
            'employees' => 'required|integer',
            'funding_state' => 'required|string',
            'industry' => 'required|string',
            'technology' => 'required|string',
            'trl' => 'required|string',
            'business_model' => 'required|string',
            'revenue_model' => 'required|string',
            'funding_sources' => 'required|string',
            'total_funding' => 'required|string',
            'executive_summary' => 'required|string',
        ]);

        // Create and store the new company
        $company = Company::create($validatedData);

        return response()->json(['message' => 'Company created', 'data' => $company], 201);
    }


    //update (PUT) controller
    public function updateCompanyInfo(Request $request, $company_id)
    {
        // Find the company by company_id
        $company = Company::where('company_id', $company_id)->first();

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        // Extract only the fields that are present in the request
        $updateData = $request->only([
            'company_id', 'logo', 'name', 'city', 'country', 'webmail', 'email', 'employees',
            'funding_state', 'industry', 'technology', 'trl', 'business_model',
            'revenue_model', 'funding_sources', 'total_funding', 'executive_summary'
        ]);

        // Update the company data
        $company->update($updateData);
        $company->save();

        return response()->json(['message' => 'Company updated', 'data' => $company]);
    }



    //delete controller

    public function destroy($company_id)
    {
        // Find the company by company_id
        $company = Company::where('company_id', $company_id)->first();

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        // Delete the company
        $company->delete();

        return response()->json(['message' => 'Company removed']);
    }

}
