<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use App\Services\PageSectionService;
use App\Services\SpecialGuestService;
use App\Services\SponsorService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct(protected PageSectionService $service,
                                protected SpecialGuestService $guestService,
                                protected SponsorService $sponsorService,
                                protected EventService $eventService,
                                ) {}

    public function index ()
    {
        return view('guest.about.index', [
            'sections' => $this->service->showPageSections('about'),
            'guests' => $this->guestService->list(),
            'sponsors' => $this->sponsorService->list(),
            'events' => $this->eventService->list(),
        ]);
    }
}
