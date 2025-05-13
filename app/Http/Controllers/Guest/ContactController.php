<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestMessageRequest;
use App\Models\GuestMessage;
use App\Models\Setting;
use App\Services\GuestMessageService;
use App\Services\PageSectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function __construct(protected GuestMessageService $service, protected PageSectionService $pageService)
    {
    }

    public function index ()
    {
        return view('guest.contact.index', [
            'setting' => Setting::where('singleton_key', 'main')->first(),
            'sections' => $this->pageService->showPageSections('contact'),
        ]);
    }

    public function show ()
    {
        if (!Session::has('message_sent')) {
            abort(403);
        }

        return view('guest.contact.message');
    }

    public function store (GuestMessageRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()->route('contact.message')->with('message_sent', true);
    }
}
