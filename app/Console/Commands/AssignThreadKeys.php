<?php

namespace App\Console\Commands;

use App\Models\ParticipantMessage;
use Illuminate\Console\Command;

class AssignThreadKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:assign-thread-keys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigner un thread_key à tous les messages existants';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = ParticipantMessage::whereNull('thread_key')->get();
        $bar = $this->output->createProgressBar(count($messages));
        $bar->start();

        foreach ($messages as $message) {
            $message->thread_key = ParticipantMessage::generateThreadKey(
                $message->sender_id,
                $message->receiver_id,
                $message->is_anonymous
            );

            $message->save();
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nTous les thread_key ont été assignés.");
    }
}
