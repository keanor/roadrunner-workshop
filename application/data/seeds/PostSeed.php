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
                'title' => 'Как проводить Code Review по версии Google',
                'text' => file_get_contents(__DIR__ . '/posts/1.html'),
            ],
            [
                'title' => 'Каково это, когда 75% ваших сотрудников — аутисты',
                'text' => file_get_contents(__DIR__ . '/posts/2.html'),
            ],
            [
                'title' => 'IT Релокация. Из Бангкока в Сидней',
                'text' => file_get_contents(__DIR__ . '/posts/3.html'),
            ],
            [
                'title' => 'Прощай HTML, привет QML',
                'text' => file_get_contents(__DIR__ . '/posts/4.html'),
            ],
            [
                'title' => 'Деревья квадрантов и распознавание коллизий',
                'text' => file_get_contents(__DIR__ . '/posts/5.html'),
            ],
        ];

        $posts = $this->table('posts');
        $posts->insert($data)->save();
    }
}
