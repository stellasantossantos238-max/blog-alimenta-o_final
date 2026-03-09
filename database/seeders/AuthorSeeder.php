<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['nome' => 'Dra. Ana Silva', 'especialidade' => 'Nutricionista', 'bio' => 'Especialista em nutrição clínica com mais de 10 anos de experiência em alimentação saudável e bem-estar.'],
            ['nome' => 'Prof. João Ferreira', 'especialidade' => 'Dietista', 'bio' => 'Professor universitário e investigador na área de dietética e saúde pública.'],
            ['nome' => 'Marta Costa', 'especialidade' => 'Chef Saudável', 'bio' => 'Chef especializada em gastronomia saudável e sustentável, autora de vários livros de culinária.'],
            ['nome' => 'Dr. Rui Oliveira', 'especialidade' => 'Médico Nutricional', 'bio' => 'Médico especializado em nutrição e medicina preventiva, defensor da alimentação como medicina.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
