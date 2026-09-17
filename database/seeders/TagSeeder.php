<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'nombre' => 'Institucional',
                'color' => '#0d6efd',
            ],
            [
                'nombre' => 'Académico',
                'color' => '#6610f2',
            ],
            [
                'nombre' => 'Comunicados',
                'color' => '#dc3545',
            ],
            [
                'nombre' => 'Eventos',
                'color' => '#198754',
            ],
            [
                'nombre' => 'Reuniones',
                'color' => '#fd7e14',
            ],
            [
                'nombre' => 'Día festivo',
                'color' => '#ffc107',
            ],
            [
                'nombre' => 'Actividades',
                'color' => '#0dcaf0',
            ],
            [
                'nombre' => 'Deportes',
                'color' => '#20c997',
            ],
            [
                'nombre' => 'Cultura',
                'color' => '#d63384',
            ],
            [
                'nombre' => 'Avisos importantes',
                'color' => '#6c757d',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(
                [
                    'slug' => Str::slug($tag['nombre']),
                ],
                [
                    'nombre' => $tag['nombre'],
                    'color' => $tag['color'],
                    'activo' => 1,
                ]
            );
        }
    }
}
