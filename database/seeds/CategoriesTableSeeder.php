<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            "Lv1Id" => "100371",
            "Lv1Name" => "レディース",
            "Lv2Id" => "555086",
            "Lv2Name" => "トップス",
            "Lv3Id" => "303656",
            "Lv3Name" => "Tシャツ・カットソー",
            "cateId" => "1",
            "cateJp" => "トップス",
            "cateEn" => "Tops",
            "created_at" => new DateTime(),
            "updated_at" => new DateTime()

        ]);
        
        
        
        
        
        
        
        
        
    }
}





