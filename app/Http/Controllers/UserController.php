<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Add/edit handler
    public function manage(Request $request, $id = false, $view = true)
    {
        $data = json_decode($request->data);

        // Rules for validator
        $validatorRules = [
            'id' => 'integer',
            'name' => 'required|string|max:120',
            'email' => ['required', 'email', $id ? Rule::unique('users')->ignore($id) : 'unique:users,email'],
            'company_id' => 'required'
        ];

        // Make validation
        $validator = Validator::make((array) $data, $validatorRules);

        if (!$validator->fails())
        {
            // If validator doesn't have errors
            $user = $id ? User::findOrFail($id) : new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->company_id = $data->company_id;
            $user->password = bcrypt('secret');
            $user->save();

            if ($view) {
                $companies = Company::all();
                return view('rows.user', compact('user', 'companies'));
            } else {
                return json_encode($user);
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
        User::destroy($id);
        return 1;
    }
}