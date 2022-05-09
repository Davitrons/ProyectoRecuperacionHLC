<?php

namespace App\DataFixtures;

use App\Factory\HistorialFactory;
use App\Factory\LocalizacionFactory;
use App\Factory\MaterialFactory;
use App\Factory\PersonaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        LocalizacionFactory::createMany(30, function (){
            return[
                'padre' => LocalizacionFactory::faker()->boolean() ? LocalizacionFactory::random() : null
            ];
        });

        MaterialFactory::createMany(40, function (){
            return[
                'padre' => MaterialFactory::faker()->boolean() ? MaterialFactory::random() : null,
                'localizacion' => LocalizacionFactory::random(),
                'persona' => MaterialFactory::faker()->boolean() ? PersonaFactory::random() : null,
                'prestadoPor' => MaterialFactory::faker()->boolean() ? PersonaFactory::random() : null,
                'responsable' => MaterialFactory::faker()->boolean() ? PersonaFactory::random() : null,
            ] ;
        });

        $administrador = PersonaFactory::new()->create([
            'nombre' => 'Administrador',
            'apellidos' => 'admin',
            'administrador' => 'true',
            'gestorPrestamos' => 'true',
            'nombreUsuario' => 'Admin',
            'clave' => 'Admin',
        ]);
        PersonaFactory::createMany(20);


        HistorialFactory::createMany(30, function (){
           return[
               'material' => MaterialFactory::random(),
               'prestadoPor' => PersonaFactory::random(),
               'prestadoA' => PersonaFactory::random(),
               'devueltoPor' => PersonaFactory::random(),
           ];
        });

        $manager->flush();
    }
}
