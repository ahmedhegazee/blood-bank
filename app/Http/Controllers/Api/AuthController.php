<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = $this->validateRegister($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        return jsonResponse(1, 'تم الاضافة بنجاح', ['api_token' => $client->api_token, 'client' => $client]);
    }
    public function login(Request $request)
    {

        $validator = $this->validateLogin($request->all());
        // $validator = $this->validateRegister($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        // dd(Auth::guard('clients'));
        $auth = Auth::guard('client')->attempt(['phone' => $request->phone, 'password' => $request->password]);
        if ($auth) {
            $client = Auth::guard('client')->user();
            return jsonResponse(1, 'تم الدخول بنجاح', ['api_token' => $client->api_token, 'client' => $client]);
        } else {
            $msg = 'بيانات المستخدم غير صحيحة';
            return jsonResponse(0, $msg, [], 401);
        }
    }
    public function validateLogin($data)
    {
        $rules = [
            'password' => 'required|string',
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/'],
        ];
        return validator()->make($data, $rules);
    }
    public function validateRegister($data)
    {
        $rules = [
            'name' => 'required|string|min:5',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email|unique:clients',
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', 'unique:clients'],
            'dob' => 'required|date|before: -16 years',
            'last_donation_date' => 'required|date|before_or_equal: -1 days',
            'city_id' => ['required', Rule::in(City::all()->pluck('id')->toArray())],
            'blood_type_id' => ['required', Rule::in(BloodType::all()->pluck('id')->toArray())],
        ];
        return validator()->make($data, $rules);
    }
}
