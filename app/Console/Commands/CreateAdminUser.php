<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Crear el usuario administrador de RICH MUSIC';

    public function handle(): int
    {
        $name = $this->ask('Nombre del administrador');
        $email = $this->ask('Correo electrónico');
        $password = $this->secret('Contraseña');

        if (User::where('email', $email)->exists()) {
            $this->error('Ese correo ya está registrado.');

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('Administrador creado correctamente.');

        return self::SUCCESS;
    }
}