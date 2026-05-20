<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class BrochureController extends Controller
{
    /**
     * Display the brochure page.
     */
    public function index()
    {
        $brochurePath = Setting::getValue('school_brochure');
        return view('brochure', compact('brochurePath'));
    }
}
