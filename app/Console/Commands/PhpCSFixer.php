<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PhpCSFixer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:php-cs-fixer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes coding style inconsistencies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): string
    {
        $command = 'vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix';
        exec("{$command} 2>&1 &", $output);
        foreach ($output as $line) {
            echo "${line}\n";
        }
        return 'Fixed formatting PHP files';
    }
}
