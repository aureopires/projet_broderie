<?php

namespace App\Tests\Command;

use App\Command\MigrateQuoteLogosCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

final class MigrateQuoteLogosCommandTest extends TestCase
{
    public function testDryRunAndMigrationPreserveFileContentAndNames(): void
    {
        $root = sys_get_temp_dir().'/quote-migrate-'.bin2hex(random_bytes(8));
        $source = $root.'/public/uploads/quote-logos';
        $target = $root.'/private/quote-logos';
        $filesystem = new Filesystem();
        $filesystem->mkdir($source);
        try {
            file_put_contents($source.'/existing.png', 'original content');
            $tester = new CommandTester(new MigrateQuoteLogosCommand($root, $target));
            self::assertSame(0, $tester->execute(['--dry-run' => true]));
            self::assertFileExists($source.'/existing.png');
            self::assertFileDoesNotExist($target.'/existing.png');
            self::assertSame(0, $tester->execute([]));
            self::assertSame('original content', file_get_contents($target.'/existing.png'));
            self::assertFileDoesNotExist($source.'/existing.png');
            self::assertSame(0, $tester->execute([]));
            file_put_contents($source.'/existing.png', 'different content');
            self::assertSame(1, $tester->execute([]));
            self::assertSame('original content', file_get_contents($target.'/existing.png'));
            self::assertSame('different content', file_get_contents($source.'/existing.png'));
        } finally {
            $filesystem->remove($root);
        }
    }
}
