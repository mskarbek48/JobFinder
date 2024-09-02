<?php
/**
 * This file is a part of mskarbek48${PROJECT_NAME}
 *
 * @author Maciej Skarbek <macieqskarbek@gmail.com>
 * @copyright (c) 2024 Maciej Skarbek
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @created at 02.09.2024 12:11
 *
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 **/

namespace App\Service\Scraper;

use App\Service\Scraper\Experience\ExperienceInterface;
use App\Service\Scraper\Technology\TechnologyInterface;

class ScraperManager
{
	private array $scrapers = [];

	public function __construct(array $scrapers)
	{
		$this->scrapers = $scrapers;
	}

	public function scrape(TechnologyInterface $technology, string $location, ExperienceInterface $experience): void
	{
		foreach ($this->scrapers as $scraper) {
			$scraper->setLocation($location);
			$scraper->setTechnology($technology);
			$scraper->setExperience($experience);
			$scraper->scrape();
		}
	}

	public function getScrapedData(): array
	{
		$data = [];
		foreach ($this->scrapers as $scraper) {
			$data = array_merge($data, $scraper->getScrapedData());
		}
		return $data;
	}
}