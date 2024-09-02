<?php
/**
 * This file is a part of mskarbek48${PROJECT_NAME}
 *
 * @author Maciej Skarbek <macieqskarbek@gmail.com>
 * @copyright (c) 2024 Maciej Skarbek
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @created at 02.09.2024 12:03
 *
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 **/

namespace App\Service\Scraper;

use App\Service\Scraper\Experience\ExperienceInterface;
use App\Service\Scraper\Extractor\ExtractorInterface;
use App\Service\Scraper\Technology\TechnologyInterface;
use App\Service\Scraper\UrlBuilder\UrlBuilderInterface;

class AbstractScraper
{
	protected string $url;

	protected TechnologyInterface $technology;

	protected ExperienceInterface $experience;

	protected string $location;

	protected UrlBuilderInterface $urlBuilder;

	protected array $data;

	protected ExtractorInterface $extractor;

	public function setLocation(string $location): void
	{
		$this->location = $location;
	}

	public function setTechnology(TechnologyInterface $technology): void
	{
		$this->technology = $technology;
	}

	public function setExperience(ExperienceInterface $experience): void
	{
		$this->experience = $experience;
	}


	public function __construct(UrlBuilderInterface $urlBuilder, ExtractorInterface $extractor)
	{
		$this->urlBuilder = $urlBuilder;
		$this->extractor = $extractor;
	}

	public function getScrapedData(): array
	{
		return $this->data;
	}

}