<?php
use Phinx\Seed\AbstractSeed;

class PostSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Blog #1',
                'text' => 'Welcome to my first blog post'
            ],
            [
                'title' => 'Blog #2',
                'text' => 'Welcome to my second blog post'
            ],
            [
                'title' => 'Blog #3',
                'text' => 'Welcome to my third blog post'
            ],
            [
                'title' => 'Blog #4',
                'text' => 'Welcome to my fourth blog post'
            ],
            [
                'title' => 'Blog #5',
                'text' => 'Welcome to my fifth blog post'
            ],
        ];

        $posts = $this->table('posts');
        $posts->insert($data)->save();
    }
}
