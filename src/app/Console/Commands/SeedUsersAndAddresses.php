<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Style\SymfonyStyle;

class SeedUsersAndAddresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-users-and-addresses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed users and their addresses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $io = new SymfonyStyle($this->input, $this->output);

        DB::transaction(function () use ($io) {
            $numUsers = $io->ask('How many users do you want to create?', 10);
            $addressesPerUser = $io->ask('How many addresses per user?', 1);

            // Input Validation (Example)
            if (!is_numeric($numUsers) || $numUsers <= 0) {
                $io->error('Invalid number of users. Please enter a positive integer.');
                return;
            }
            if (!is_numeric($addressesPerUser) || $addressesPerUser <= 0) {
                $io->error('Invalid number of addresses per user. Please enter a positive integer.');
                return;
            }

            $users = User::factory()->count($numUsers)->create();

            $users->each(function (User $user) use ($addressesPerUser) {
                Address::factory()->count($addressesPerUser)->create([
                    'user_id' => $user->id,
                ]);
            });

            $io->success("Successfully created $numUsers users with $addressesPerUser addresses each.");
        });
    }
}
