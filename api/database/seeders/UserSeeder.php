<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        $users = [
            [
                'name' => 'Juan',
                'lastname' => 'Pérez',
                'email' => 'juan.perez@empresa.com',
                'role' => 'agent'
            ],
            [
                'name' => 'María',
                'lastname' => 'González',
                'email' => 'maria.gonzalez@empresa.com',
                'role' => 'agent'
            ],
            [
                'name' => 'Carlos',
                'lastname' => 'Rodríguez',
                'email' => 'carlos.rodriguez@empresa.com',
                'role' => 'agent'
            ],
            [
                'name' => 'Ana',
                'lastname' => 'Martínez',
                'email' => 'ana.martinez@cliente.com',
                'role' => 'requester'
            ],
            [
                'name' => 'Pedro',
                'lastname' => 'López',
                'email' => 'pedro.lopez@cliente.com',
                'role' => 'requester'
            ],
            [
                'name' => 'Laura',
                'lastname' => 'Sánchez',
                'email' => 'laura.sanchez@empresa.com',
                'role' => 'agent'
            ],
            [
                'name' => 'Miguel',
                'lastname' => 'Torres',
                'email' => 'miguel.torres@cliente.com',
                'role' => 'requester'
            ],
            [
                'name' => 'Sofia',
                'lastname' => 'Díaz',
                'email' => 'sofia.diaz@cliente.com',
                'role' => 'requester'
            ],
            [
                'name' => 'Diego',
                'lastname' => 'Ramírez',
                'email' => 'diego.ramirez@empresa.com',
                'role' => 'agent'
            ],
            [
                'name' => 'Carmen',
                'lastname' => 'Flores',
                'email' => 'carmen.flores@cliente.com',
                'role' => 'requester'
            ],
            [
                'name' => 'Ricardo',
                'lastname' => 'Herrera',
                'email' => 'ricardo.herrera@cliente.com',
                'role' => 'requester'
            ],
            [
                'name' => 'Isabel',
                'lastname' => 'Morales',
                'email' => 'isabel.morales@cliente.com',
                'role' => 'requester'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
