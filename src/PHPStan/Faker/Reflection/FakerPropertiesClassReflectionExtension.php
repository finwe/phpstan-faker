<?php

declare(strict_types = 1);

namespace Finwe\PHPStan\Faker\Reflection;

use DateTime;
use Faker\Generator;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Type\ArrayType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\TrueOrFalseBooleanType;
use PHPStan\Type\Type;

class FakerPropertiesClassReflectionExtension implements PropertiesClassReflectionExtension
{

	/**
	 * @var mixed[]
	 */
	private $properties;

	public function __construct()
	{
		$this->properties = [

			'creditCardExpirationDate' => [new ObjectType(DateTime::class), false, false, true],
			'dateTime' => [new ObjectType(DateTime::class), false, false, true],
			'dateTimeAD' => [new ObjectType(DateTime::class), false, false, true],
			'dateTimeThisCentury' => [new ObjectType(DateTime::class), false, false, true],
			'dateTimeThisDecade' => [new ObjectType(DateTime::class), false, false, true],
			'dateTimeThisMonth' => [new ObjectType(DateTime::class), false, false, true],
			'dateTimeThisYear' => [new ObjectType(DateTime::class), false, false, true],
			'rgbColorAsArray' => [new ArrayType(new IntegerType(), new IntegerType()), false, false, true],

			'boolean' => [new TrueOrFalseBooleanType(), false, false, true],

			'latitude' => [new FloatType(), false, false, true],
			'longitude' => [new FloatType(), false, false, true],
			'century' => [new IntegerType(), false, false, true],
			'dayOfMonth' => [new IntegerType(), false, false, true],
			'dayOfWeek' => [new IntegerType(), false, false, true],
			'month' => [new IntegerType(), false, false, true],
			'unixTime' => [new IntegerType(), false, false, true],
			'year' => [new IntegerType(), false, false, true],
			'randomDigit' => [new IntegerType(), false, false, true],
			'randomDigitNotNull' => [new IntegerType(), false, false, true],

			'amPm' => [new StringType(), false, false, true],
			'iso8601' => [new StringType(), false, false, true],
			'monthName' => [new StringType(), false, false, true],
			'timezone' => [new StringType(), false, false, true],
			'address' => [new StringType(), false, false, true],
			'bankAccountNumber' => [new StringType(), false, false, true],
			'buildingNumber' => [new StringType(), false, false, true],
			'chrome' => [new StringType(), false, false, true],
			'city' => [new StringType(), false, false, true],
			'citySuffix' => [new StringType(), false, false, true],
			'colorName' => [new StringType(), false, false, true],
			'company' => [new StringType(), false, false, true],
			'companyEmail' => [new StringType(), false, false, true],
			'companySuffix' => [new StringType(), false, false, true],
			'country' => [new StringType(), false, false, true],
			'countryCode' => [new StringType(), false, false, true],
			'countryISOAlpha3' => [new StringType(), false, false, true],
			'creditCardDetails' => [new StringType(), false, false, true],
			'creditCardExpirationDateStr' => [new StringType(), false, false, true],
			'creditCardNumber' => [new StringType(), false, false, true],
			'creditCardType' => [new StringType(), false, false, true],
			'currencyCode' => [new StringType(), false, false, true],
			'domainName' => [new StringType(), false, false, true],
			'domainWord' => [new StringType(), false, false, true],
			'ean13' => [new StringType(), false, false, true],
			'ean8' => [new StringType(), false, false, true],
			'email' => [new StringType(), false, false, true],
			'fileExtension' => [new StringType(), false, false, true],
			'firefox' => [new StringType(), false, false, true],
			'firstName' => [new StringType(), false, false, true],
			'firstNameFemale' => [new StringType(), false, false, true],
			'firstNameMale' => [new StringType(), false, false, true],
			'freeEmail' => [new StringType(), false, false, true],
			'freeEmailDomain' => [new StringType(), false, false, true],
			'hexColor' => [new StringType(), false, false, true],
			'internetExplorer' => [new StringType(), false, false, true],
			'ipv4' => [new StringType(), false, false, true],
			'ipv6' => [new StringType(), false, false, true],
			'isbn10' => [new StringType(), false, false, true],
			'isbn13' => [new StringType(), false, false, true],
			'jobTitle' => [new StringType(), false, false, true],
			'languageCode' => [new StringType(), false, false, true],
			'lastName' => [new StringType(), false, false, true],
			'lastNameMale' => [new StringType(), false, false, true],
			'lastNameFemale' => [new StringType(), false, false, true],
			'linuxPlatformToken' => [new StringType(), false, false, true],
			'linuxProcessor' => [new StringType(), false, false, true],
			'locale' => [new StringType(), false, false, true],
			'localIpv4' => [new StringType(), false, false, true],
			'macAddress' => [new StringType(), false, false, true],
			'macPlatformToken' => [new StringType(), false, false, true],
			'macProcessor' => [new StringType(), false, false, true],
			'md5' => [new StringType(), false, false, true],
			'mimeType' => [new StringType(), false, false, true],
			'opera' => [new StringType(), false, false, true],
			'paragraph' => [new StringType(), false, false, true],
			'password' => [new StringType(), false, false, true],
			'phoneNumber' => [new StringType(), false, false, true],
			'postcode' => [new StringType(), false, false, true],
			'randomAscii' => [new StringType(), false, false, true],
			'randomLetter' => [new StringType(), false, false, true],
			'rgbColor' => [new StringType(), false, false, true],
			'rgbCssColor' => [new StringType(), false, false, true],
			'safari' => [new StringType(), false, false, true],
			'safeColorName' => [new StringType(), false, false, true],
			'safeEmail' => [new StringType(), false, false, true],
			'safeEmailDomain' => [new StringType(), false, false, true],
			'safeHexColor' => [new StringType(), false, false, true],
			'sentence' => [new StringType(), false, false, true],
			'sha1' => [new StringType(), false, false, true],
			'sha256' => [new StringType(), false, false, true],
			'slug' => [new StringType(), false, false, true],
			'streetAddress' => [new StringType(), false, false, true],
			'streetName' => [new StringType(), false, false, true],
			'streetSuffix' => [new StringType(), false, false, true],
			'swiftBicNumber' => [new StringType(), false, false, true],
			'text' => [new StringType(), false, false, true],
			'title' => [new StringType(), false, false, true],
			'titleFemale' => [new StringType(), false, false, true],
			'titleMale' => [new StringType(), false, false, true],
			'tld' => [new StringType(), false, false, true],
			'url' => [new StringType(), false, false, true],
			'userAgent' => [new StringType(), false, false, true],
			'userName' => [new StringType(), false, false, true],
			'uuid' => [new StringType(), false, false, true],
			'vat' => [new StringType(), false, false, true],
			'windowsPlatformToken' => [new StringType(), false, false, true],
			'word' => [new StringType(), false, false, true],

			'name' => [new StringType(), false, false, true],

			'paragraphs' => [new StringType(), false, false, true], // @property string|array $paragraphs
			'sentences' => [new StringType(), false, false, true], // @property string|array $sentences
			'words' => [new StringType(), false, false, true], // @property string|array $words

		];
	}

	public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
	{
		return $classReflection->getName() === Generator::class
			&& \array_key_exists($propertyName, $this->properties);
	}

	public function getProperty(ClassReflection $classReflection, string $propertyName): PropertyReflection
	{
		$key = $this->properties[$propertyName];
		return $this->returnPropertyImplementation($key[0], $classReflection, $key[1], $key[2], $key[3]);
	}

	private function returnPropertyImplementation(Type $type, ClassReflection $declaringClass, bool $static, bool $private, bool $public): PropertyReflection
	{
		return new class($type, $declaringClass, $static, $private, $public) implements PropertyReflection
		{

			/**
			 * @var mixed
			 */
			private $type, $declaringClass, $static, $private, $public;

			public function __construct(Type $type, ClassReflection $declaringClass, bool $static, bool $private, bool $public)
			{
				$this->type = $type;
				$this->declaringClass = $declaringClass;
				$this->static = $static;
				$this->private = $private;
				$this->public = $public;
			}

			public function getDeclaringClass(): ClassReflection
			{
				return $this->declaringClass;
			}

			public function isStatic(): bool
			{
				return $this->static;
			}

			public function isPrivate(): bool
			{
				return $this->private;
			}

			public function isPublic(): bool
			{
				return $this->public;
			}

			public function getType(): Type
			{
				return $this->type;
			}

			public function isReadable(): bool
			{
				return true;
			}

			public function isWritable(): bool
			{
				return true;
			}
		};
	}

}
