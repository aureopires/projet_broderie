<?php

namespace App\Tests\Form;

use App\Entity\QuoteRequest;
use App\Form\QuoteRequestType;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;

final class QuoteRequestTypeTest extends KernelTestCase
{
    private const VALID_DATA = [
        'articleType' => 'Polo', 'articleOrigin' => 'client', 'markingType' => 'broderie',
        'quantity' => 12, 'firstName' => 'Camille', 'lastName' => 'Exemple',
        'organizationType' => 'particulier', 'organizationName' => '',
        'email' => 'camille@example.test', 'phone' => '0600000000',
        'message' => 'Douze polos avec un motif brodé.',
    ];

    public function testValidRequestWithoutOptionalFieldsIsAccepted(): void
    {
        self::bootKernel();
        $form = self::getContainer()->get(FormFactoryInterface::class)->create(QuoteRequestType::class, new QuoteRequest(), ['csrf_protection' => false]);
        $form->submit(self::VALID_DATA);
        self::assertTrue($form->isValid(), (string) $form->getErrors(true));
    }

    #[DataProvider('invalidData')]
    public function testInvalidFieldIsRejectedByServer(string $field, mixed $value): void
    {
        self::bootKernel();
        $form = self::getContainer()->get(FormFactoryInterface::class)->create(QuoteRequestType::class, new QuoteRequest(), ['csrf_protection' => false]);
        $form->submit(array_replace(self::VALID_DATA, [$field => $value]));
        self::assertFalse($form->isValid());
        self::assertGreaterThan(0, count($form->get($field)->getErrors(true)));
    }

    public static function invalidData(): iterable
    {
        foreach (['articleType', 'articleOrigin', 'markingType', 'quantity', 'firstName', 'lastName', 'organizationType', 'email', 'phone', 'message'] as $field) {
            yield $field.' vide' => [$field, ''];
        }
        foreach (['articleType', 'firstName', 'lastName', 'email', 'phone', 'message'] as $field) {
            yield $field.' espaces' => [$field, '   '];
        }
        yield 'email invalide' => ['email', 'invalide'];
        yield 'quantité zéro' => ['quantity', 0];
        yield 'quantité négative' => ['quantity', -1];
        yield 'quantité non numérique' => ['quantity', 'abc'];
        yield 'origine inconnue' => ['articleOrigin', 'inconnue'];
        yield 'marquage inconnu' => ['markingType', 'inconnu'];
        yield 'organisme inconnu' => ['organizationType', 'inconnu'];
    }
}
