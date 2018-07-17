<?php

use App\Models\User;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$professions = DB::select('SELECT id FROM professions WHERE title = ?', ['Diseñador web']);

        //$professions = DB::table('professions')->select('id')->take(1)->get();
//        $profession = DB::table('professions')
//            ->select('id')
//            ->where('title','=','Diseñador web')
//            ->first();
//
//        $professionID = DB::table('professions')
//            ->where('title', 'Diseñador web')
//            ->value('id');

//        $professionID = DB::table('professions')
//            ->whereTitle('Diseñador web')
//            ->value('id');

        $professionID = Profession::where('title', 'Diseñador web')->value('id');

//        DB::insert('INSERT INTO users (name,email,password,profession_id) VALUES (:name,:email,:password,:profession_id)',[
//           'name' => 'Alex Ortega',
//           'email' => 'alex@alex.es',
//           'password' => bcrypt('secret'),
//           'profession_id' => $professionID
//        ]);
//
//        DB::table('users')->insert([
//           'name' => 'Artu Ortega',
//           'email' => 'arturo@arturo.es',
//           'password' => bcrypt('secret'),
//            'profession_id' => $professionID
//        ]);

        User::create([
            'name' => 'Alex Ortega',
            'email' => 'alex@alex.es',
            'password' => bcrypt('secret'),
            'profession_id' => $professionID
        ]);

        User::create([
            'name' => 'Artu Ortega',
            'email' => 'arturo@arturo.es',
            'password' => bcrypt('secret'),
            'profession_id' => $professionID
        ]);

        factory(User::class,50)->create();

    }
}
