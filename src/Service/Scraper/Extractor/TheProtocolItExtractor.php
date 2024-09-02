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

		$offer = new JobOffer(
			$crawler->filter('div.c1uektcw div.c19s9s03 span.l1sjc53z')->each(function (Crawler $node) {
				return $node->text();
			}),
			$crawler->filter('div.c1uektcw div.c19s9s03 span.t16r9o63')->each(function (Crawler $node) {
				return $node->text();
			}),
			$crawler->filter('ul[data-test="section-requirements-expected"] div.ihmj1ec')->each(function (Crawler $node) {
				return $node->text();
			}),
			$crawler->filter('ul[data-test="section-requirements-expected"] div.ihmj1ec')->each(function (Crawler $node) {
				return $node->text();
			}),
			$crawler->filter('div[data-test="section-offered"] ul div.ihmj1ec')->each(function (Crawler $node) {
				return $node->text();
			}),
			$crawler->filter('div[data-test="section-benefits"] ul div.ihmj1ec')->each(function (Crawler $node) {
				return $node->text();
			}),
			isset($fields[4]) ? $fields[4] : $fields[3],
			explode(" • ", $fields[1]),
			$fields[2],
		);

		return $offer;
	}
}