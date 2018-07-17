<?php

use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::insert('INSERT INTO professions (title) VALUES (:title)',[
//            'title' => 'Desarrollador web'
//        ]);

//        DB::table('professions')->insert([
//            'title' => 'Desarrolador back-end'
//        ]);
//        DB::table('professions')->insert([
//            'title' => 'Desarrolador front-end'
//        ]);
//        DB::table('professions')->insert([
//            'title' => 'Diseñador web'
//        ]);
//
//        //DB::delete('professions')->whereTitle('Diseñador web');
//        DB::table('professions')->whereTitle('Diseñador web')->delete();

        Profession::create([
            'title' => 'Desarrolador back-end'
        ]);
        Profession::create([
            'title' => 'Desarrolador front-end'
        ]);
        Profession::create([
            'title' => 'Diseñador web'
        ]);

        factory(Profession::class,50)->create();
    }
}
