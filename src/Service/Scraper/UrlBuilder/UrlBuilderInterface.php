<?php
/**
 * This file is a part of mskarbek48${PROJECT_NAME}
 *
 * @author Maciej Skarbek <macieqskarbek@gmail.com>
 * @copyright (c) 2024 Maciej Skarbek
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @created at 02.09.2024 12:35
 *
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 **/

namespace App\Service\Scraper\UrlBuilder;

use App\Service\Scraper\Experience\ExperienceInterface;
use App\Service\Scraper\Technology\TechnologyInterface;

interface UrlBuilderInterface
{
	public function buildUrl(TechnologyInterface $technology, string $location, ExperienceInterface $experience): string;
}