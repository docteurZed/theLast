<?php

namespace App\Console\Commands;

use App\Models\PageSection;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class DefaultAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un admin par défaut';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            User::create([
                'name'          => env('APP_NAME'),
                'first_name'    => env('APP_NAME'),
                'phone'         => env('APP_PHONE_NUMBER'),
                'email'         => env('MAIL_FROM_ADDRESS'),
                'password'      => Hash::make('password'),
                'role'          => 'admin',
                'is_active'     => true,
            ]);
        }

        $setting = Setting::all();

        if($setting->isEmpty()) {
            Setting::create([
                'singleton_key' => 'main',
                'name' => env('APP_NAME'),
                'phone' => env('APP_PHONE_NUMBER'),
                'email' => env('MAIL_FROM_ADDRESS'),
                'participation_fee' => env('APP_PARTICIPATION_FEE'),
                'decompt_event_date' => env('APP_EVENT_DATE'),
                'decompt_event_time' => env('APP_EVENT_TIME'),
            ]);
        }

        $pages = [
            'home' => [
                'hero' => 'theLast',
                'about' => 'A propos',
                'cta' => 'Confirmation',
                'guest' => 'Invité',
                'galerie' => 'Galerie',
                'testimony' => 'Témoignage',
                'sponsor' => 'Sponsor',
            ],
            'about' => [
                'about' => 'A propos',
                'info' => 'Information',
                'dress' => 'Dress Code',
                'cta' => 'Confirmation',
                'guest' => 'Invité',
                'sponsor' => 'Sponsor',
            ],
            'contact' => [
                'contact' => 'Contact'
            ]
        ];

        foreach ($pages as $page => $sections) {

            foreach ($sections as $section => $title) {

                PageSection::firstOrCreate([
                    'page' => $page,
                    'section' => $section,
                ],[
                    'name' => $title,
                    'title' => 'Titre de section ' . $title,
                    'description' => 'Lorem impsum dolor, sibit quaet impsum city, lorem chetat',
                ]);

            }

        }

        $this->info("✅ Données par défaut créées avec succès.");
        return Command::SUCCESS;
    }
}
