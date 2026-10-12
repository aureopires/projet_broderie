<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(name: 'app:quote-logos:migrate', description: 'Déplace les anciens logos de devis vers le stockage privé sans modifier la base.')]
final class MigrateQuoteLogosCommand extends Command
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')] private readonly string $projectDir,
        #[Autowire('%quote_logos_directory%')] private readonly string $destination,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('dry-run', null, InputOption::VALUE_NONE, 'Affiche les déplacements sans modifier les fichiers.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $source = $this->projectDir.'/public/uploads/quote-logos';
        if (!is_dir($source)) {
            $io->success('Aucun ancien dossier à migrer.');
            return Command::SUCCESS;
        }
        // Preflight the whole set before moving any file. Never overwrite a destination.
        $files = [];
        foreach (new \DirectoryIterator($source) as $file) {
            if ($file->isDot()) {
                continue;
            }
            if (!$file->isFile() || $file->isLink() || !preg_match('/\A[a-zA-Z0-9_-]+\.[a-zA-Z0-9]+\z/', $file->getFilename()) || file_exists($this->destination.'/'.$file->getFilename())) {
                $io->error('Migration interrompue : fichier inattendu ou destination déjà existante.');
                return Command::FAILURE;
            }
            $files[] = $file->getFilename();
        }
        $filesystem = new Filesystem();
        foreach ($files as $filename) {
            if (!$input->getOption('dry-run')) {
                $filesystem->mkdir($this->destination, 0700);
                $filesystem->rename($source.'/'.$filename, $this->destination.'/'.$filename);
                $filesystem->chmod($this->destination.'/'.$filename, 0600);
            }
        }
        $io->success(sprintf('%d logo(s) %s. Les noms stockés en base restent identiques.', count($files), $input->getOption('dry-run') ? 'à déplacer' : 'déplacé(s)'));
        return Command::SUCCESS;
    }
}
