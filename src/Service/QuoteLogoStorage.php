<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class QuoteLogoStorage
{
    private const EXTENSIONS = ['image/png' => 'png', 'image/jpeg' => 'jpg', 'image/webp' => 'webp'];

    public function __construct(
        #[Autowire('%quote_logos_directory%')] private readonly string $directory,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function store(UploadedFile $file): string
    {
        $image = @getimagesize($file->getPathname());
        $mime = $file->getMimeType();
        if (!$file->isValid() || $file->getSize() > 15_000_000 || !isset(self::EXTENSIONS[$mime]) || ($image['mime'] ?? null) !== $mime) {
            throw new FileException('Image de logo invalide.');
        }
        $filename = bin2hex(random_bytes(16)).'.'.self::EXTENSIONS[$mime];
        try {
            $filesystem = new Filesystem();
            $filesystem->mkdir($this->directory, 0700);
            $file->move($this->directory, $filename);
            $filesystem->chmod($this->directory.'/'.$filename, 0600);
        } catch (\Throwable $exception) {
            $this->delete($filename);
            $this->logger->error('Impossible de stocker un logo de devis.', ['exception' => $exception]);
            throw new FileException('Impossible de stocker le logo.', 0, $exception);
        }

        return $filename;
    }

    public function path(?string $filename): ?string
    {
        if (!$filename || !preg_match('/\A[a-zA-Z0-9_-]+\.[a-zA-Z0-9]+\z/', $filename)) {
            return null;
        }
        $path = $this->directory.'/'.$filename;
        return is_file($path) && !is_link($path) ? $path : null;
    }

    public function downloadablePath(?string $filename): ?string
    {
        $path = $this->path($filename);
        if (!$path) {
            return null;
        }
        $image = @getimagesize($path);
        return isset(self::EXTENSIONS[$image['mime'] ?? '']) ? $path : null;
    }

    public function delete(?string $filename): void
    {
        $path = $this->path($filename);
        if (!$path) {
            return;
        }
        try {
            (new Filesystem())->remove($path);
        } catch (\Throwable $exception) {
            $this->logger->warning('Impossible de supprimer un logo de devis.', ['exception' => $exception]);
        }
    }
}
