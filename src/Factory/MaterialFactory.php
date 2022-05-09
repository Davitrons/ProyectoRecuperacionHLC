<?php

namespace App\Factory;

use App\Entity\Material;
use App\Repository\MaterialRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Material>
 *
 * @method static Material|Proxy createOne(array $attributes = [])
 * @method static Material[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Material|Proxy find(object|array|mixed $criteria)
 * @method static Material|Proxy findOrCreate(array $attributes)
 * @method static Material|Proxy first(string $sortedField = 'id')
 * @method static Material|Proxy last(string $sortedField = 'id')
 * @method static Material|Proxy random(array $attributes = [])
 * @method static Material|Proxy randomOrCreate(array $attributes = [])
 * @method static Material[]|Proxy[] all()
 * @method static Material[]|Proxy[] findBy(array $attributes)
 * @method static Material[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Material[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MaterialRepository|RepositoryProxy repository()
 * @method Material|Proxy create(array|callable $attributes = [])
 */
final class MaterialFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $fechaDevolucion = self::faker()->dateTimeBetween('-1 year', '-2 months');
        $fechaPrestamo = self::faker()->dateTimeBetween('-13 months', $fechaDevolucion);

        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'nombre' => self::faker()->text(10),
            'disponible' => self::faker()->boolean(),
            'descripcion' => self::faker()->text(20),
            'fechaHoraUltimoPrestamo' => \DateTimeImmutable::createFromMutable($fechaPrestamo),
            'fechaHoraUltimaDevolucion' => \DateTimeImmutable::createFromMutable($fechaDevolucion),
            'fechaAlta' => self::faker()->dateTimeThisYear(),
            'fechabaja' => self::faker()->dateTimeThisYear('+2 months'),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Material $material): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Material::class;
    }
}
