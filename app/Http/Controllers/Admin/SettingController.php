<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function __construct(private SettingService $settingService) {}

    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        $setting = $this->settingService->getSetting();
        return view('admin.setting.index', [
            'setting' => $setting,
        ]);
    }

    public function update(SettingRequest $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        $this->settingService->storeOrUpdate($request);
        return back()->with('success', 'Paramètres mis à jour avec succès.');
    }
}

