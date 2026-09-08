<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ManageSecurityStaff extends Command
{
    protected $signature = 'security:staff {email : Existing account email} {--revoke : Remove staff access}';

    protected $description = 'Grant or revoke staff access for an existing account';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();
        if (! $user) {
            $this->error('Account not found. Register the account first.');

            return self::FAILURE;
        }

        $user->is_staff = ! $this->option('revoke');
        $user->save();
        $this->info($user->is_staff ? 'Staff access granted.' : 'Staff access revoked.');

        return self::SUCCESS;
    }
}
