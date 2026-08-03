<?php

namespace App\Factory;

use App\Entity\QuoteRequest;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<QuoteRequest>
 */
final class QuoteRequestFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    #[\Override]
    public static function class(): string
    {
        return QuoteRequest::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('-1 year', 'now')),
            'email' => self::faker()->safeEmail(),
            'message' => self::faker()->paragraph(),
            'name' => self::faker()->name(),
            'status' => 'new',
            'user' => self::faker()->boolean(70) ? UserFactory::random() : null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(QuoteRequest $quoteRequest): void {})
        ;
    }
}
