<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a first administrator account';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (User::count() == 0) {
            $admin = new User();
            $admin->firstname = 'Ad';
            $admin->lastname = 'Min';
            $admin->email = 'admin@example.com';
            $password = $this->secret('Pick a password');
            $admin->password = bcrypt($password);
            $admin->save();
        } else {
            $this->error('Unable to create an admin');
        }
    }
}
