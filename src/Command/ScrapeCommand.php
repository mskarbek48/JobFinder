<?php

namespace App\Command;

use App\Service\Scraper\Experience\Junior;
use App\Service\Scraper\Experience\Mid;
use App\Service\Scraper\Extractor\JustJoinItExtractor;
use App\Service\Scraper\Extractor\TheProtocolItExtractor;
use App\Service\Scraper\JustJoinIt;
use App\Service\Scraper\ScraperManager;
use App\Service\Scraper\Technology\PhpTechnology;
use App\Service\Scraper\TheProtocolIt;
use App\Service\Scraper\UrlBuilder\JustJoinItUrlBuilder;
use App\Service\Scraper\UrlBuilder\TheProtocolItUrlBuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:scrape',
    description: 'Add a short description for your command',
)]
class ScrapeCommand extends Command
{


    public function __construct()
    {
        parent::__construct();
    }

	protected function configure()
	{
		$this
			->setDescription('Scrape data from websites')
			->addArgument('technology', InputArgument::REQUIRED, 'Technologies to scrape')
			->addArgument('location', InputArgument::REQUIRED, 'Location to scrape')
			->addOption('experience', null, InputOption::VALUE_REQUIRED, 'Experience level', 'junior');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$io = new SymfonyStyle($input, $output);

		$technology_map = [
			"php" => PhpTechnology::class
		];

		$experience_map = [
			"junior" => Junior::class,
			"mid" => Mid::class
		];

		$technology = $input->getArgument('technology');
		$location = $input->getArgument('location');
		$experience = $input->getOption('experience');

		if(!array_key_exists($technology, $technology_map))
		{
			$io->error('Technology not supported');
			return Command::FAILURE;
		}

		if(!array_key_exists($experience, $experience_map))
		{
			$io->error('Experience level not supported');
			return Command::FAILURE;
		}

		$experience = new $experience_map[$experience]();
		$technology = new $technology_map[$technology]();



		$scrapeManager= new ScraperManager([
			new JustJoinIt(new JustJoinItUrlBuilder(), new JustJoinItExtractor()),
			new TheProtocolIt(new TheProtocolItUrlBuilder(), new TheProtocolItExtractor()),
		]);

		$scrapeManager->scrape($technology, $location, $experience);

		$data = $scrapeManager->getScrapedData();


		$io->table(
			['Source', 'Job Title', 'Company', 'Location', "Stack", "Salary"], // Table headers
			array_map(function($job) {
				print_r($job);
				return [
					$job->getSource(),
					$job->getTitle(),
					$job->getAddress(),
					$job->getAddress(),
					implode(", ", $job->getExceptedTechnologies()),
					$job->getSalaryMin() . " - " . $job->getSalaryMax() . " " . $job->getCurrency()
				];
			}, $data) // Table rows
		);

		return Command::SUCCESS;


	}


}
