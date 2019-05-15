<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $teacher = factory('App\Models\Role')->create([
            'role' => 'Преподаватель'
        ]);

        $student = factory('App\Models\Role')->create([
            'role' => 'Студент'
        ]);

        factory('App\Models\Role')->create([
            'role' => 'Директор'
        ]);

        factory('App\Models\Group')->create([
            'name' => 'group 1'
        ]);

        factory('App\Models\Lesson')->create([
            'name' => 'Lesson 1'
        ]);

        for ($i = 0; $i < 3; $i++) {
            factory('App\Models\User')->create([
                'role_id' => $teacher->getKey()
            ]);

            factory('App\Models\User')->create([
                'role_id' => $student->getKey()
            ]);
        }
    }
}
