<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
        $user = [
            'username' => 'admin',
            'password' => password_hash('123456',  PASSWORD_DEFAULT),
        ];

        $this->table('users')
            ->insert([$user])
            ->save();
    }
}
