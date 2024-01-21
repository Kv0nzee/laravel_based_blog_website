<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::truncate();
        // \App\Models\Blog::truncate();
        // \App\Models\Category::truncate();

        $kzh = \App\Models\User::factory()->create(['username'=>'kzh', 'name'=>'kaung']);
        $brnyr = \App\Models\User::factory()->create(['username'=>'brnyr', 'name'=>'brnyr']);
        $test = \App\Models\User::factory()->create(['username'=>'test', 'name'=>'Dr.test']);

        $frontend = \App\Models\Category::factory()->create(['name'=>'frontend', 'slug'=>'frontend']);
        $backend = \App\Models\Category::factory()->create(['name'=>'backend', 'slug' => 'backend']);
        $devops = \App\Models\Category::factory()->create(['name'=>'devops', 'slug' => 'devops']);


        \App\Models\Blog::factory(20)->create(['category_id'=>$devops->id, 'user_id'=>$test->id]);
        \App\Models\Blog::factory(20)->create(['category_id'=>$frontend->id, 'user_id'=>$kzh->id]);
        \App\Models\Blog::factory(10)->create(['category_id'=>$backend->id, 'user_id'=>$brnyr->id]);

        // $frontend = \App\Models\Category::create([
        //     'name'=>'frontend',
        //     'slug'=>'frontend'
        // ]);
        // $backend = \App\Models\Category::create([
        //     'name'=>'backend',
        //     'slug'=>'backend'
        // ]);

        // \App\Models\Blog::create([
        //     'title'=>'html',
        //     'category_id'=>$frontend->id,
        //     'slug'=>'html',
        //     'intro'=>'this is html intro',
        //     'body'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae libero omnis rem? Mollitia exercitationem placeat molestiae provident nihil aliquid est recusandae! Nihil, doloremque ut maxime sapiente mollitia pariatur rem est.'
        // ]);

        // \App\Models\Blog::create([
        //     'title'=>'frontend',
        //     'category_id'=>$frontend->id,
        //     'slug'=>'frontend',
        //     'intro'=>'this is frontend intro',
        //     'body'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae libero omnis rem? Mollitia exercitationem placeat molestiae provident nihil aliquid est recusandae! Nihil, doloremque ut maxime sapiente mollitia pariatur rem est.'
        // ]);

        // \App\Models\Blog::create([
        //     'title'=>'backend',
        //     'category_id'=>$backend->id,
        //     'slug'=>'backend',
        //     'intro'=>'this is backend intro',
        //     'body'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae libero omnis rem? Mollitia exercitationem placeat molestiae provident nihil aliquid est recusandae! Nihil, doloremque ut maxime sapiente mollitia pariatur rem est.'
        // ]);
    }
}
