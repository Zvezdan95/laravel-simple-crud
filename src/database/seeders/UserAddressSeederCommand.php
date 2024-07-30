<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserAddressSeederCommand extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $output = new ConsoleOutput();

        $numUsers = $output->ask('How many users do you want to create?', 10);
        $addressesPerUser = $output->ask('How many addresses per user?', 1);

        $users = User::factory()->count($numUsers)->create();

        $users->each(function (User $user) use ($addressesPerUser) {
            Address::factory()->count($addressesPerUser)->create(['user_id' => $user->id]);
        });
    }
}
