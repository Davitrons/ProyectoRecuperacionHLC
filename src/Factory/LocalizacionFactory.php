<?php

namespace App\Factory;

use App\Entity\Localizacion;
use App\Repository\LocalizacionRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Localizacion>
 *
 * @method static Localizacion|Proxy createOne(array $attributes = [])
 * @method static Localizacion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Localizacion|Proxy find(object|array|mixed $criteria)
 * @method static Localizacion|Proxy findOrCreate(array $attributes)
 * @method static Localizacion|Proxy first(string $sortedField = 'id')
 * @method static Localizacion|Proxy last(string $sortedField = 'id')
 * @method static Localizacion|Proxy random(array $attributes = [])
 * @method static Localizacion|Proxy randomOrCreate(array $attributes = [])
 * @method static Localizacion[]|Proxy[] all()
 * @method static Localizacion[]|Proxy[] findBy(array $attributes)
 * @method static Localizacion[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Localizacion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LocalizacionRepository|RepositoryProxy repository()
 * @method Localizacion|Proxy create(array|callable $attributes = [])
 */
final class LocalizacionFactory extends ModelFactory
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
            'codigo' => self::faker()->unique()->numerify(),
            'nombre' => self::faker()->text(10),
            'descripcion' => self::faker()->text(20),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Localizacion $localizacion): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Localizacion::class;
    }
}
