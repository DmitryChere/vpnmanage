<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    // Add/edit handler
    public function manage(Request $request, $id = false, $view = true)
    {
        $data = json_decode($request->data);

        // Rules for validator
        $validatorRules = [
            'id' => 'integer',
            'name' => 'required|string|max:100',
            'quota' => 'required|numeric'
        ];

        // Make validation
        $validator = Validator::make((array) $data, $validatorRules);

        if (!$validator->fails())
        {
            // If validator doesn't have errors
            $company = $id ? Company::findOrFail($id) : new Company();
            $company->name = $data->name;
            $company->quota = $data->quota;
            $company->save();

            if ($view) {
                return view('rows.company', compact('company'));
            } else {
                return json_encode($company);
            }
        }
        else
        {
            // If validator has errors
            // Return all error messages as string
            $errors = implode($validator->errors()->all());
            return ['error' => true, 'content' => $errors];
        }
    }
    
    // Remove handler
    public function remove($id)
    {
        Company::destroy($id);
        return 1;
    }
}
