<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class GenerateDashboardPassword extends Command
{
    protected $signature = 'dashboard:password {password? : Plain text password to encrypt}';
    protected $description = 'Generate an encrypted dashboard password for .env';

    public function handle(): int
    {
        $plain = $this->argument('password');

        if (!$plain) {
            $plain = $this->secret('Enter the dashboard password');
        }

        if (blank($plain)) {
            $this->error('Password cannot be empty.');
            return self::FAILURE;
        }

        $encrypted = Crypt::encryptString($plain);

        $this->info('Encrypted password:');
        $this->line($encrypted);
        $this->newLine();
        $this->warn('Add this to your .env file:');
        $this->line("DASHBOARD_PASSWORD={$encrypted}");

        return self::SUCCESS;
    }
}
