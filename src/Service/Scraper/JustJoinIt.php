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



use App\Service\Scraper\UrlBuilder\UrlBuilderInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class JustJoinIt extends AbstractScraper implements ScraperInterface
{
	const URL = "https://justjoin.it/";

	public function __construct(UrlBuilderInterface $urlBuilder)
	{
		$this->urlBuilder = $urlBuilder;
	}

	public function scrape(): void
	{
		$this->url = $this->urlBuilder->buildUrl($this->technology, $this->location, $this->experience);


		$client = HttpClient::create();

		$request = $client->request('GET', $this->url);
		$response = $request->getContent();
		$crawler = new Crawler($response);

		$next_data = $crawler->filter('script#__NEXT_DATA__')->first()->text();
		$json = json_decode($next_data, true);

		file_put_contents("test.json", json_encode($json, JSON_PRETTY_PRINT));


	}

	public function getScrapedData(): array
	{
		return array("example");
	}
}