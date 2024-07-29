<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GetAdminUsersCommand extends Command
{
    protected $signature = 'get-admin-user-info';

    public function __construct(
        protected readonly User $user
    )
    {
        parent::__construct();
    }

    /**
     * @throws \JsonException
     */
    public function handle(): void
    {
        $users = User::query()
            ->where('role', User::ROLE_ADMIN)
            ->limit(50)
            ->get();

        if (!$users->count()) {
            $this->info('No users found');
        }

        $resultArr = [];
        foreach ($users as $user) {
            $resultArr[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
        }

        $this->info(json_encode($resultArr, JSON_THROW_ON_ERROR));
    }
}
