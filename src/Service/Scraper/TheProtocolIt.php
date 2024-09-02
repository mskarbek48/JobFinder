<?php
/**
 * This file is a part of mskarbek48${PROJECT_NAME}
 *
 * @author Maciej Skarbek <macieqskarbek@gmail.com>
 * @copyright (c) 2024 Maciej Skarbek
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @created at 02.09.2024 12:04
 *
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 **/

namespace App\Service\Scraper;



use App\Service\Scraper\Extractor\ExtractorInterface;
use App\Service\Scraper\UrlBuilder\UrlBuilderInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class TheProtocolIt extends AbstractScraper implements ScraperInterface
{
	const URL = "https://theprotocol.it/";



	public function scrape(): void
	{
		$offers = [];
		$this->url = $this->urlBuilder->buildUrl($this->technology, $this->location, $this->experience);
		$client = HttpClient::create();
		$request = $client->request('GET', $this->url);
		$response = $request->getContent();
		$crawler = new Crawler($response);
		$test = $crawler->filter('a.a4pzt2q');
		foreach($test as $once)
		{
			$job = $once->attributes->getNamedItem("href")->nodeValue;

			$job_url = self::URL . $job;

			$job_request = $client->request('GET', $job_url);
			$job_response = $job_request->getContent();
			$job_crawler = new Crawler($job_response);

			$extracted = $this->extractor->extract($job_crawler);
			$jobs[] = $extracted;

		}
		$this->data = $jobs;
	}

}