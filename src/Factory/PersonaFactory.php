<?php

namespace App\Factory;

use App\Entity\Persona;
use App\Repository\PersonaRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Persona>
 *
 * @method static Persona|Proxy createOne(array $attributes = [])
 * @method static Persona[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Persona|Proxy find(object|array|mixed $criteria)
 * @method static Persona|Proxy findOrCreate(array $attributes)
 * @method static Persona|Proxy first(string $sortedField = 'id')
 * @method static Persona|Proxy last(string $sortedField = 'id')
 * @method static Persona|Proxy random(array $attributes = [])
 * @method static Persona|Proxy randomOrCreate(array $attributes = [])
 * @method static Persona[]|Proxy[] all()
 * @method static Persona[]|Proxy[] findBy(array $attributes)
 * @method static Persona[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Persona[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PersonaRepository|RepositoryProxy repository()
 * @method Persona|Proxy create(array|callable $attributes = [])
 */
final class PersonaFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'nombreUsuario' => self::faker()->unique()->userName(),
            'clave' => self::faker()->password(),
            'nombre' => self::faker()->firstName(),
            'apellidos' => self::faker()->lastName() . ' ' . self::faker()->lastName(),
            'administrador' => false,
            'gestorPrestamos' => false,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Persona $persona): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Persona::class;
    }
}
