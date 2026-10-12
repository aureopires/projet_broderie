<?php

namespace App\Tests\Form;

use App\Form\QuoteLogoType;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class QuoteLogoTypeTest extends KernelTestCase
{
    #[DataProvider('files')]
    public function testFileContentExtensionAndSizeAreChecked(string $name, string $kind, bool $valid): void
    {
        self::bootKernel();
        $path = tempnam(sys_get_temp_dir(), 'quote-logo-');
        try {
            if ($kind === 'png') {
                imagepng(imagecreatetruecolor(2, 2), $path);
            } elseif ($kind === 'large') {
                imagepng(imagecreatetruecolor(2, 2), $path);
                $handle = fopen($path, 'a');
                ftruncate($handle, 15_000_001);
                fclose($handle);
            } else {
                file_put_contents($path, '<svg xmlns="http://www.w3.org/2000/svg"/>');
            }
            $form = self::getContainer()->get(FormFactoryInterface::class)->createBuilder(FormType::class, null, ['csrf_protection' => false])->add('logo', QuoteLogoType::class)->getForm();
            $form->submit(['logo' => new UploadedFile($path, $name, test: true)]);
            self::assertSame($valid, $form->isValid(), (string) $form->getErrors(true));
        } finally {
            unlink($path);
        }
    }

    public static function files(): iterable
    {
        yield 'PNG valide' => ['logo.png', 'png', true];
        yield 'SVG interdit' => ['logo.svg', 'svg', false];
        yield 'SVG renommé PNG' => ['logo.png', 'svg', false];
        yield 'extension PHP' => ['logo.php', 'png', false];
        yield 'limite 15 Mo' => ['logo.png', 'large', false];
    }
}
