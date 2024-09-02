<?php
/**
 * This file is a part of mskarbek48${PROJECT_NAME}
 *
 * @author Maciej Skarbek <macieqskarbek@gmail.com>
 * @copyright (c) 2024 Maciej Skarbek
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @created at 02.09.2024 14:09
 *
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 **/

namespace App\Service\Scraper\ValueObject;

class JobOffer
{
	public function __construct(
		private array $exceptedTechnologies,
		private array $optionalTechnologies,
		private array $responsibilities,
		private array $requirements,
		private array $offer,
		private array $benefits,
		private string $address,
		private array $level,
		private string $validUntil,
	){}
}