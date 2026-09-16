<?php

namespace Database\Seeders;

use App\Models\Entidad;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Entidad::updateOrCreate(
            [
                'id' => 1,
            ],
            [
                'nombre' => 'Nombre de la Escuela',
                'lema' => 'Educando para construir un futuro mejor',

                'descripcion' => 'Institución educativa comprometida con la formación integral de sus estudiantes, promoviendo el conocimiento, los valores y la participación de toda la comunidad educativa.',

                'mision' => 'Brindar una educación de calidad que contribuya al desarrollo académico, personal y social de nuestros estudiantes, fortaleciendo los valores, la responsabilidad y el compromiso con la comunidad.',

                'vision' => 'Ser una institución educativa reconocida por su excelencia académica, innovación y formación integral, preparando estudiantes capaces de enfrentar los desafíos del futuro.',

                'email' => 'contacto@escuela.edu.py',
                'celular' => '0981 000 000',
                'whatsapp' => '595981000000',
                'direccion' => 'Asunción, Paraguay',

                'instagram' => null,
                'facebook' => null,
                'x_url' => null,
                'youtube' => null,
                'tiktok' => null,
                'sitio_web' => null,
                'mapa_url' => null,

                'logo' => null,
                'favicon' => null,
                'imagen_portada' => null,

                'activo' => true,
            ]
        );
    }
}
