<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'super_admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Super Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (User::where('role', 'superAdmin')->exists()) {
            $this->error('Super Admin already exists.');
            return;
        }

        $name = $this->ask('Name');
        $username = $this->ask('Username');

        $password = $this->secret('Password');

        User::create([
            'name' => $name,
            'username' => $username,
            'password' => Hash::make($password),
            'role' => 'superAdmin',
            'slug' => Str::slug($username)
        ]);

        $this->info('Super Admin created successfully.');
    }
}
