<?php
declare(strict_types=1);

use App\Model\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Comment::class, 20)->create();
    }
}
