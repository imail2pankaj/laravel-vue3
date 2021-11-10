<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        return response()->json(Company::all());
    }

    public function store(CompanyRequest $request)
    {
        $image = $request->file('logo');
        $input['logo'] = time().'.'.$image->getClientOriginalExtension();
        
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $input['logo']);
        $request->logo = $input['logo'];
        $company = Company::create($request->validated());
        return response()->json($company);
    }

    public function show(Company $company)
    {
        return $company;
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $image = $request->file('logo');
        $input['logo'] = time().'.'.$image->getClientOriginalExtension();
        
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $input['logo']);
        $request->logo = $input['logo'];

        $company->update($request->validated());
        return $company;
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->noContent();
    }
}
