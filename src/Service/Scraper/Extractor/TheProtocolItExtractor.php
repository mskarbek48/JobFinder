<?php
/**
 * This file is a part of mskarbek48${PROJECT_NAME}
 *
 * @author Maciej Skarbek <macieqskarbek@gmail.com>
 * @copyright (c) 2024 Maciej Skarbek
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @created at 02.09.2024 14:00
 *
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 **/

namespace App\Service\Scraper\Extractor;

use App\Service\Scraper\ValueObject\JobOffer;
use Symfony\Component\DomCrawler\Crawler;

class TheProtocolItExtractor implements ExtractorInterface
{
	public function extract(Crawler $crawler): JobOffer
	{
		$fields = $crawler->filter('.tieu7dq .l1bcjc6p')->each(function (Crawler $node) {
			return $node->text();
		});

		$price = $crawler->filter('.i1cspcwo p')->each(function (Crawler $node) {
			return $node->text();
		});




		$offer = new JobOffer();

		$salary = explode("–", $price[0]);

		if(isset($salary[1]))
		{
			$max = explode(" ", $salary[1], -1);
			$offer->setSalaryMin(str_replace(" ", "", $salary[0]));
			$offer->setSalaryMax(str_replace(" ", "", $max[0]));
			$offer->setCurrency(explode( " ",$salary[1])[1]);
		}
		$offer->setSource("TheProtocolIt");
		$offer->setTitle($crawler->filter('.t1yrx4v1')->text());
		$offer->setExceptedTechnologies($crawler->filter('div.c1uektcw div.c19s9s03 span.l1sjc53z')->each(function (Crawler $node) {
			return $node->text();
		}));
		$offer->setOptionalTechnologies($crawler->filter('div.c1uektcw div.c19s9s03 span.t16r9o63')->each(function (Crawler $node) {
			return $node->text();
		}));
		$offer->setResponsibilities($crawler->filter('ul[data-test="section-requirements-expected"] div.ihmj1ec')->each(function (Crawler $node) {
			return $node->text();
		}));
		$offer->setRequirements($crawler->filter('ul[data-test="section-requirements-expected"] div.ihmj1ec')->each(function (Crawler $node) {
			return $node->text();
		}));
		$offer->setOffer($crawler->filter('div[data-test="section-offered"] ul div.ihmj1ec')->each(function (Crawler $node) {
			return $node->text();
		}));
		$offer->setBenefits($crawler->filter('div[data-test="section-benefits"] ul div.ihmj1ec')->each(function (Crawler $node) {
			return $node->text();
		}));
		$offer->setAddress(isset($fields[4]) ? $fields[4] : $fields[3]);
		$offer->setLevel(explode(" • ", $fields[1]));
		$offer->setValidUntil($fields[2]);


		return $offer;
	}
}