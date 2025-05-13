<?php

namespace App\Services;

use App\Models\Setting;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;

class SettingService
{
    /**
     * Récupère le premier enregistrement des paramètres.
     */
    public function getSetting(): ?Setting
    {
        return Setting::where('singleton_key', 'main')->first();
    }

    /**
     * Met à jour ou crée les paramètres.
     */
    public function storeOrUpdate(Request $request): Setting
    {
        $data = $request->only([
            'name', 'email', 'phone', 'participation_fee', 'decompt_event_date', 'decompt_event_time'
        ]);

        return Setting::updateOrCreate(
            ['singleton_key' => 'main'],
            $data
        );
    }
}
