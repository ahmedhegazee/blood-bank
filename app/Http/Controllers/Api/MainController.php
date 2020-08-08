<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Government;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGovernments()
    {
        $governments = Government::all(['id', 'name']);
        return jsonResponse(1, 'success', $governments);
    }
    public function getCities(Request $request)
    {
        $cities = City::govern($request->govern)->get(['name', 'id']);
        return jsonResponse(1, 'success', $cities);
    }
    public function getBloodTypes()
    {
        $bloodTypes = BloodType::all(['id', 'name']);
        return jsonResponse(1, 'success', $bloodTypes);
    }
    public function getPostsCategories()
    {
        $postsCategories = Category::all(['id', 'name']);
        return jsonResponse(1, 'success', $postsCategories);
    }
    public function getSettings()
    {
        $settings = Settings::all(['name', 'value']);
        return jsonResponse(1, 'success', $settings);
    }
}
