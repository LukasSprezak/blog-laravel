<?php
declare(strict_types=1);

use App\Model\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class)->state('admin')->create();
        factory(User::class, 1)->create();
    }
}
