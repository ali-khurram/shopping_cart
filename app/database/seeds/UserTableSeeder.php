<?php

    class UserTableSeeder extends Seeder {

        public function run() {

            $users = array(
                array('email' => 'user1@email.com',
                    'password' => Crypt::encrypt('Testing123'),
                    'name' => 'Dummy',
                    'surname' => 'User1',
                    'address' => 'Address 1'),
                array('email' => 'user2@email.com',
                    'password' => Crypt::encrypt('Testing123'),
                    'name' => 'Dummy',
                    'surname' => 'User2',
                    'address' => 'Address 2'),
                array('email' => 'user3@email.com',
                    'password' => Crypt::encrypt('Testing123'),
                    'name' => 'Dummy',
                    'surname' => 'User3',
                    'address' => 'Address 3'),
            );

            User::truncate();

            foreach($users as $user) {
                User::create ($user);
            }
        }
    }