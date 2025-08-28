<?php

namespace App\Console\Commands;

use App\Services\RaceService;
use Illuminate\Console\Command;

class UpdateRaceResultCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-race-result-command {sessionKey}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates race results every 2 hours.';

    public function __construct(protected RaceService $raceService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sessionKey = $this->argument('sessionKey');
        if (!$sessionKey) {
            $sessionKey = 9939;
        }
        $this->raceService->parseResults($sessionKey);
    }
}
