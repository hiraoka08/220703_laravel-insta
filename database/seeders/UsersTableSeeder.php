<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersTableSeeder extends Seeder
{

    private $user;
   
    public function __construct(User $user){
        $this->user = $user;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #1
        $admin = [
            [
                'name'       => 'Admin',
                'email'      => 'admin@admin.com',
                'password'   => Hash::make('12345678'),
                'role_id'    => 1,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]      
        ];

        $this->user->insert($admin);


        // #2 
        // $this->user->name = 'admin';
        // $this->user->email = 'admin@admin.com',
        // ......
        // $this->user->save();

    }
}
