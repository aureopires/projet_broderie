<?php

namespace App\Tests\Service;

use App\Service\QuoteLogoStorage;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class QuoteLogoStorageTest extends TestCase
{
    private string $directory;
    private QuoteLogoStorage $storage;

    protected function setUp(): void
    {
        $this->directory = sys_get_temp_dir().'/quote-logo-test-'.bin2hex(random_bytes(8));
        mkdir($this->directory);
        $this->storage = new QuoteLogoStorage($this->directory.'/private', new NullLogger());
    }

    protected function tearDown(): void
    {
        (new Filesystem())->remove($this->directory);
    }

    #[DataProvider('formats')]
    public function testRasterIsStoredWithGeneratedNameAndCanBeDeleted(string $format): void
    {
        $source = $this->directory.'/upload';
        $image = imagecreatetruecolor(2, 2);
        match ($format) {
            'png' => imagepng($image, $source),
            'jpg' => imagejpeg($image, $source),
            'webp' => imagewebp($image, $source),
        };
        $filename = $this->storage->store(new UploadedFile($source, 'client.'.$format, test: true));
        self::assertMatchesRegularExpression('/^[a-f0-9]{32}\.'.$format.'$/', $filename);
        self::assertNotNull($this->storage->downloadablePath($filename));
        self::assertSame(0600, fileperms($this->storage->path($filename)) & 0777);
        $this->storage->delete($filename);
        self::assertNull($this->storage->path($filename));
    }

    public static function formats(): iterable
    {
        yield ['png'];
        yield ['jpg'];
        yield ['webp'];
    }

    #[DataProvider('unsafeFiles')]
    public function testUnsafeFilesCannotBeStored(string $name, string $content): void
    {
        $source = $this->directory.'/upload';
        file_put_contents($source, $content);
        $this->expectException(FileException::class);
        $this->storage->store(new UploadedFile($source, $name, test: true));
    }

    public static function unsafeFiles(): iterable
    {
        yield 'SVG' => ['logo.svg', '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>'];
        yield 'faux PNG' => ['logo.png', '<?php echo "not an image";'];
    }

    public function testTraversalAndSymlinksCannotBeReadOrDeleted(): void
    {
        mkdir($this->directory.'/private');
        file_put_contents($this->directory.'/outside.png', 'private content');
        symlink($this->directory.'/outside.png', $this->directory.'/private/link.png');
        self::assertNull($this->storage->path('../outside.png'));
        self::assertNull($this->storage->path('link.png'));
        $this->storage->delete('../outside.png');
        $this->storage->delete('link.png');
        self::assertFileExists($this->directory.'/outside.png');
    }

    public function testLegacySvgIsNotDownloadable(): void
    {
        mkdir($this->directory.'/private');
        file_put_contents($this->directory.'/private/old.svg', '<svg xmlns="http://www.w3.org/2000/svg"/>');
        self::assertNull($this->storage->downloadablePath('old.svg'));
    }

    public function testStorageFailureRaisesFileException(): void
    {
        file_put_contents($this->directory.'/private', 'not a directory');
        $source = $this->directory.'/upload';
        imagepng(imagecreatetruecolor(2, 2), $source);
        $this->expectException(FileException::class);
        $this->storage->store(new UploadedFile($source, 'logo.png', test: true));
    }
}
