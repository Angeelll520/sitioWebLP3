<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /* DB::table("productos")->insert([
            "nombre" => "Pañales Huggies",
            "precio" => 60.5,
            "stock" => 70,
        ]);*/
        Producto::factory()->count(50)->create();
    }
}
