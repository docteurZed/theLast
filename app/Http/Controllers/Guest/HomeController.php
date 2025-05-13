<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\PageSectionService;
use App\Services\SpecialGuestService;
use App\Services\SponsorService;
use App\Services\TestimonyService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected PageSectionService $service,
                                protected SpecialGuestService $guestService,
                                protected TestimonyService $testimonyService,
                                protected SponsorService $sponsorService,
                                ) {}

    public function index ()
    {
        return view('guest.home.index', [
            'setting' => Setting::where('singleton_key', 'main')->first(),
            'sections' => $this->service->showPageSections('home'),
            'guests' => $this->guestService->list(),
            'testimonies' => $this->testimonyService->list(),
            'sponsors' => $this->sponsorService->list(),
        ]);
    }
}
