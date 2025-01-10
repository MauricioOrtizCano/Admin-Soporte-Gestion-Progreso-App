<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            [
                'support_case_id' => 1,
                'agent_id' => 1,
                'comments' => [
                    [
                        'text' => "Iniciando revisión del caso reportado",
                        'timestamp' => Carbon::now()->subHours(5)->toDateTimeString()
                    ],
                    [
                        'text' => "Trabajando en la implementación de la solución",
                        'timestamp' => Carbon::now()->subHours(3)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 2,
                'agent_id' => 2,
                'comments' => [
                    [
                        'text' => "Analizando el problema reportado",
                        'timestamp' => Carbon::now()->subHours(8)->toDateTimeString()
                    ],
                    [
                        'text' => "Caso cerrado satisfactoriamente",
                        'timestamp' => Carbon::now()->subHours(2)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 4,
                'agent_id' => 3,
                'comments' => [
                    [
                        'text' => "Comenzando análisis inicial",
                        'timestamp' => Carbon::now()->subHours(6)->toDateTimeString()
                    ],
                    [
                        'text' => "Identificado el origen del problema",
                        'timestamp' => Carbon::now()->subHours(4)->toDateTimeString()
                    ],
                    [
                        'text' => "Procediendo con la resolución",
                        'timestamp' => Carbon::now()->subHours(2)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 5,
                'agent_id' => 1,
                'comments' => [
                    [
                        'text' => "Evaluando el reporte recibido",
                        'timestamp' => Carbon::now()->subHours(7)->toDateTimeString()
                    ],
                    [
                        'text' => "Aplicando solución estándar",
                        'timestamp' => Carbon::now()->subHours(4)->toDateTimeString()
                    ],
                    [
                        'text' => "Caso resuelto exitosamente",
                        'timestamp' => Carbon::now()->subHours(2)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 6,
                'agent_id' => 6,
                'comments' => [
                    [
                        'text' => "Iniciando diagnóstico del problema",
                        'timestamp' => Carbon::now()->subHours(6)->toDateTimeString()
                    ],
                    [
                        'text' => "En proceso de implementación de solución",
                        'timestamp' => Carbon::now()->subHours(4)->toDateTimeString()
                    ],
                    [
                        'text' => "Realizando verificación final",
                        'timestamp' => Carbon::now()->subHours(2)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 7,
                'agent_id' => 9,
                'comments' => [
                    [
                        'text' => "Revisión inicial completada",
                        'timestamp' => Carbon::now()->subHours(6)->toDateTimeString()
                    ],
                    [
                        'text' => "Implementando solución propuesta",
                        'timestamp' => Carbon::now()->subHours(4)->toDateTimeString()
                    ],
                    [
                        'text' => "Caso cerrado con éxito",
                        'timestamp' => Carbon::now()->subHours(2)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 8,
                'agent_id' => 2,
                'comments' => [
                    [
                        'text' => "Iniciando revisión del caso",
                        'timestamp' => Carbon::now()->subHours(5)->toDateTimeString()
                    ],
                    [
                        'text' => "Aplicando correcciones necesarias",
                        'timestamp' => Carbon::now()->subHours(3)->toDateTimeString()
                    ],
                    [
                        'text' => "En fase final de pruebas",
                        'timestamp' => Carbon::now()->subHours(1)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 10,
                'agent_id' => 3,
                'comments' => [
                    [
                        'text' => "Iniciando análisis del caso",
                        'timestamp' => Carbon::now()->subHours(6)->toDateTimeString()
                    ],
                    [
                        'text' => "Implementando solución propuesta",
                        'timestamp' => Carbon::now()->subHours(2)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 11,
                'agent_id' => 6,
                'comments' => [
                    [
                        'text' => "Evaluando el problema reportado",
                        'timestamp' => Carbon::now()->subHours(6)->toDateTimeString()
                    ],
                    [
                        'text' => "Solución aplicada exitosamente",
                        'timestamp' => Carbon::now()->subHours(4)->toDateTimeString()  
                    ],
                    [
                        'text' => "Verificación final completada",
                        'timestamp' => Carbon::now()->subHours(2)->toDateTimeString()
                    ]
                ]
            ],
            [
                'support_case_id' => 12,
                'agent_id' => 9,
                'comments' => [
                    [
                        'text' => "Comenzando revisión del ticket",
                        'timestamp' => Carbon::now()->subHours(5)->toDateTimeString()
                    ],
                    [
                        'text' => "Progreso en la implementación",
                        'timestamp' => Carbon::now()->subHours(3)->toDateTimeString()
                    ]
                ]
            ]
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
