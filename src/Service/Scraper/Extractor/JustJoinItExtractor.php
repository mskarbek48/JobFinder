<?php
/**
 * This file is a part of mskarbek48${PROJECT_NAME}
 *
 * @author Maciej Skarbek <macieqskarbek@gmail.com>
 * @copyright (c) 2024 Maciej Skarbek
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @created at 02.09.2024 14:26
 *
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 **/

namespace App\Service\Scraper\Extractor;

use App\Service\Scraper\ValueObject\JobOffer;
use Symfony\Component\DomCrawler\Crawler;

class JustJoinItExtractor implements ExtractorInterface
{

	public function extract(array $data): JobOffer
	{
		$offer = new JobOffer();
		$offer->setSource("JustJoinIt");
		$offer->setTitle($data['title']);
		$offer->setExceptedTechnologies($data['requiredSkills']);
		$offer->setOptionalTechnologies(is_array($data['niceToHaveSkills'])?$data['niceToHaveSkills']:array());
		$offer->setAddress(($data['street'] ?? "") . " " . ($data['city'] ?? ""));
		$offer->setLevel([$data['experienceLevel']]);
		$offer->setAddress(($data['street'] ?? "") . " " . ($data['city'] ?? ""));
		$offer->setValidUntil($data['validUntil'] ?? "");
		return $offer;
	}

}