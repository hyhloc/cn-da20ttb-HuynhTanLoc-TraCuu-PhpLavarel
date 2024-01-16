<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Username: dev, Password: eN^e8f!G58Cy
    public function run()
    {
        $created_at = $updated_at = date('Y-m-d H:i:s');
    	$password = passwordGenerate();
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'dev',
            'email' => 'hloc0944@gmail.com',
            'password' => bcrypt($password),
            'status' => 1,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ]);
        $this->command->info('Tai khoan quan tri da duoc tao tu dong. Username: dev, Password: '.$password);
    }
}
