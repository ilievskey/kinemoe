<?php

namespace App\Console\Commands;

use App\Models\Content;
use Illuminate\Console\Command;

class UpdateScheduledContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-scheduled-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update scheduled content visibility';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contents = Content::whereNotNull('scheduled_for')
                           ->where('scheduled_for', '<=', now())
                           ->update(['scheduled_for' => null]);

        $this->info("Scheduled content visibility updated.");
    }
}
