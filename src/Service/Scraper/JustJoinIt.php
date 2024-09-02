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


	public function scrape(): void
	{
		$this->url = $this->urlBuilder->buildUrl($this->technology, $this->location, $this->experience);


		$client = HttpClient::create();

		$request = $client->request('GET', $this->url);
		$response = $request->getContent();
		$crawler = new Crawler($response);

		$data = $crawler->filter('script#__NEXT_DATA__')->first()->text();
		$data = json_decode($data, true)["props"]["pageProps"]["dehydratedState"]["queries"][0]["state"]["data"]["pages"][0]["data"];


		foreach($data as $once)
		{
			$offer = $this->extractor->extract($once);
			$this->data[] = $offer;
		}


	}

}