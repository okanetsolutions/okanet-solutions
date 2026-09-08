<?php

namespace App\Http\Controllers;

use App\Models\EmailScan;
use App\Models\SecurityAssessment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SecurityController extends Controller
{
    public function index(Request $request): View
    {
        return view('security.dashboard', [
            'scan' => EmailScan::whereBelongsTo($request->user())->first(),
            'assessments' => SecurityAssessment::whereBelongsTo($request->user())->latest('id')->paginate(10),
            'scanAvailable' => config('services.breachsense.enabled') && filled(config('services.breachsense.key')),
        ]);
    }
}
