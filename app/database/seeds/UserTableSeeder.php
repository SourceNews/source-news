<?php
class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array('email' => 'user@test.com', 'username' => 'usertest', 'password' => Hash::make('usertest'), 'confirmed' => 1));
	}

}
