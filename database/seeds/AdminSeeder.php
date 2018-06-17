<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    DB::table('admin_users')->insert(['username'=>'admin','password'=>bcrypt('admin'),'name'=>'admin']);
	    DB::table('admin_menu')->insert([
		    ["parent_id"=>0,"order"=>1,"title"=>"Index","icon"=>"fa-bar-chart","uri"=>"/"],
		    ["parent_id"=>0,"order"=>2,"title"=>"Admin","icon"=>"fa-tasks","uri"=>""],
		    ["parent_id"=>2,"order"=>3,"title"=>"Users","icon"=>"fa-users","uri"=>"auth/users"],
		    ["parent_id"=>2,"order"=>4,"title"=>"Roles","icon"=>"fa-user","uri"=>"auth/roles"],
		    ["parent_id"=>2,"order"=>5,"title"=>"Permission","icon"=>"fa-ban","uri"=>"auth/permissions"],
		    ["parent_id"=>2,"order"=>6,"title"=>"Menu","icon"=>"fa-bars","uri"=>"auth/menu"],
		    ["parent_id"=>2,"order"=>7,"title"=>"Operation log","icon"=>"fa-history","uri"=>"auth/logs"]
	    ]);
	    DB::table('admin_permissions')->insert([
		    ['name' => 'All permission','slug'=> '*','http_method'=> '','http_path'=> '*'],
		    ['name' => 'Dashboard','slug'=> 'dashboard','http_method'=> 'GET','http_path'=> '/'],
		    ['name' =>'Login','slug'=> 'auth.login','http_method'=> '','http_path'=> '/auth/login\r\n/auth/logout'],
		    ['name' =>'User setting', 'slug'=>'auth.setting', 'http_method'=>'GET,PUT','http_path'=> '/auth/setting'],
		    ['name' =>'Auth management', 'slug'=>'auth.management','http_method'=> '','http_path'=> '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs']
	    ]);
	    DB::table('admin_role_menu')->insert(['role_id'=>1,'menu_id'=>2]);
	    DB::table('admin_role_permissions')->insert(['role_id'=>1,'permission_id'=>1]);
	    DB::table('admin_role_users')->insert(['role_id'=>1,'user_id'=>1]);
    }
}
