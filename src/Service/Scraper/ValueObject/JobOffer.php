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


	private string $title = "";
	private array $exceptedTechnologies = array();
	private array $optionalTechnologies = array();
	private array $responsibilities = array();
	private array $requirements = array();
	private array $offer = array();
	private array $benefits = array();
	private string $address = "";
	private array $level = array();
	private string $validUntil = "";
	private float $salary_min = 0.0;
	private float $salary_max = 0.0;
	private string $currency = "PLN";
	private string $source = "";

	public function __construct(){}

	public function getSalaryMin(): float
	{
		return $this->salary_min;
	}

	public function getSource(): string
	{
		return $this->source;
	}

	public function setSource(string $source): void
	{
		$this->source = $source;
	}


	public function setSalaryMin(float $salary_min): void
	{
		$this->salary_min = $salary_min;
	}

	public function getSalaryMax(): float
	{
		return $this->salary_max;
	}

	public function setSalaryMax(float $salary_max): void
	{
		$this->salary_max = $salary_max;
	}

	public function getCurrency(): string
	{
		return $this->currency;
	}

	public function setCurrency(string $currency): void
	{
		$this->currency = $currency;
	}

	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	public function setExceptedTechnologies(array $exceptedTechnologies): void
	{
		$this->exceptedTechnologies = $exceptedTechnologies;
	}

	public function setOptionalTechnologies(array $optionalTechnologies): void
	{
		$this->optionalTechnologies = $optionalTechnologies;
	}

	public function setResponsibilities(array $responsibilities): void
	{
		$this->responsibilities = $responsibilities;
	}

	public function setRequirements(array $requirements): void
	{
		$this->requirements = $requirements;
	}

	public function setOffer(array $offer): void
	{
		$this->offer = $offer;
	}

	public function setBenefits(array $benefits): void
	{
		$this->benefits = $benefits;
	}

	public function setAddress(string $address): void
	{
		$this->address = $address;
	}

	public function setLevel(array $level): void
	{
		$this->level = $level;
	}

	public function setValidUntil(string $validUntil): void
	{
		$this->validUntil = $validUntil;
	}



	public function getTitle(): string
	{
		return $this->title;
	}

	public function getExceptedTechnologies(): array
	{
		return $this->exceptedTechnologies;
	}

	public function getOptionalTechnologies(): array
	{
		return $this->optionalTechnologies;
	}

	public function getResponsibilities(): array
	{
		return $this->responsibilities;
	}

	public function getRequirements(): array
	{
		return $this->requirements;
	}

	public function getOffer(): array
	{
		return $this->offer;
	}

	public function getBenefits(): array
	{
		return $this->benefits;
	}


	public function getAddress(): string
	{
		return $this->address;
	}

	public function getLevel(): array
	{
		return $this->level;
	}

	public function getValidUntil(): string
	{
		return $this->validUntil;
	}


}