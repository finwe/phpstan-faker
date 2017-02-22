<?php declare(strict_types = 1);

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

	private $properties;

	public function __construct()
	{
		$this->properties = [

			'creditCardExpirationDate' => [new ObjectType(DateTime::class, true), false, false, true],
			'dateTime' => [new ObjectType(DateTime::class, true), false, false, true],
			'dateTimeAD' => [new ObjectType(DateTime::class, true), false, false, true],
			'dateTimeThisCentury' => [new ObjectType(DateTime::class, true), false, false, true],
			'dateTimeThisDecade' => [new ObjectType(DateTime::class, true), false, false, true],
			'dateTimeThisMonth' => [new ObjectType(DateTime::class, true), false, false, true],
			'dateTimeThisYear' => [new ObjectType(DateTime::class, true), false, false, true],
			'rgbColorAsArray' => [new ArrayType(new IntegerType(true), true), false, false, true],

			'boolean' => [new TrueOrFalseBooleanType(true), false, false, true],

			'latitude' => [new FloatType(true), false, false, true],
			'longitude' => [new FloatType(true), false, false, true],
			'century' => [new IntegerType(true), false, false, true],
			'dayOfMonth' => [new IntegerType(true), false, false, true],
			'dayOfWeek' => [new IntegerType(true), false, false, true],
			'month' => [new IntegerType(true), false, false, true],
			'unixTime' => [new IntegerType(true), false, false, true],
			'year' => [new IntegerType(true), false, false, true],
			'randomDigit' => [new IntegerType(true), false, false, true],
			'randomDigitNotNull' => [new IntegerType(true), false, false, true],

			'amPm' => [new StringType(true), false, false, true],
			'iso8601' => [new StringType(true), false, false, true],
			'monthName' => [new StringType(true), false, false, true],
			'timezone' => [new StringType(true), false, false, true],
			'address' => [new StringType(true), false, false, true],
			'bankAccountNumber' => [new StringType(true), false, false, true],
			'buildingNumber' => [new StringType(true), false, false, true],
			'chrome' => [new StringType(true), false, false, true],
			'city' => [new StringType(true), false, false, true],
			'citySuffix' => [new StringType(true), false, false, true],
			'colorName' => [new StringType(true), false, false, true],
			'company' => [new StringType(true), false, false, true],
			'companyEmail' => [new StringType(true), false, false, true],
			'companySuffix' => [new StringType(true), false, false, true],
			'country' => [new StringType(true), false, false, true],
			'countryCode' => [new StringType(true), false, false, true],
			'countryISOAlpha3' => [new StringType(true), false, false, true],
			'creditCardDetails' => [new StringType(true), false, false, true],
			'creditCardExpirationDateStr' => [new StringType(true), false, false, true],
			'creditCardNumber' => [new StringType(true), false, false, true],
			'creditCardType' => [new StringType(true), false, false, true],
			'currencyCode' => [new StringType(true), false, false, true],
			'domainName' => [new StringType(true), false, false, true],
			'domainWord' => [new StringType(true), false, false, true],
			'ean13' => [new StringType(true), false, false, true],
			'ean8' => [new StringType(true), false, false, true],
			'email' => [new StringType(true), false, false, true],
			'fileExtension' => [new StringType(true), false, false, true],
			'firefox' => [new StringType(true), false, false, true],
			'firstName' => [new StringType(true), false, false, true],
			'firstNameFemale' => [new StringType(true), false, false, true],
			'firstNameMale' => [new StringType(true), false, false, true],
			'freeEmail' => [new StringType(true), false, false, true],
			'freeEmailDomain' => [new StringType(true), false, false, true],
			'hexColor' => [new StringType(true), false, false, true],
			'internetExplorer' => [new StringType(true), false, false, true],
			'ipv4' => [new StringType(true), false, false, true],
			'ipv6' => [new StringType(true), false, false, true],
			'isbn10' => [new StringType(true), false, false, true],
			'isbn13' => [new StringType(true), false, false, true],
			'jobTitle' => [new StringType(true), false, false, true],
			'languageCode' => [new StringType(true), false, false, true],
			'lastName' => [new StringType(true), false, false, true],
			'lastNameMale' => [new StringType(true), false, false, true],
			'lastNameFemale' => [new StringType(true), false, false, true],
			'linuxPlatformToken' => [new StringType(true), false, false, true],
			'linuxProcessor' => [new StringType(true), false, false, true],
			'locale' => [new StringType(true), false, false, true],
			'localIpv4' => [new StringType(true), false, false, true],
			'macAddress' => [new StringType(true), false, false, true],
			'macPlatformToken' => [new StringType(true), false, false, true],
			'macProcessor' => [new StringType(true), false, false, true],
			'md5' => [new StringType(true), false, false, true],
			'mimeType' => [new StringType(true), false, false, true],
			'opera' => [new StringType(true), false, false, true],
			'paragraph' => [new StringType(true), false, false, true],
			'password' => [new StringType(true), false, false, true],
			'phoneNumber' => [new StringType(true), false, false, true],
			'postcode' => [new StringType(true), false, false, true],
			'randomAscii' => [new StringType(true), false, false, true],
			'randomLetter' => [new StringType(true), false, false, true],
			'rgbColor' => [new StringType(true), false, false, true],
			'rgbCssColor' => [new StringType(true), false, false, true],
			'safari' => [new StringType(true), false, false, true],
			'safeColorName' => [new StringType(true), false, false, true],
			'safeEmail' => [new StringType(true), false, false, true],
			'safeEmailDomain' => [new StringType(true), false, false, true],
			'safeHexColor' => [new StringType(true), false, false, true],
			'sentence' => [new StringType(true), false, false, true],
			'sha1' => [new StringType(true), false, false, true],
			'sha256' => [new StringType(true), false, false, true],
			'slug' => [new StringType(true), false, false, true],
			'streetAddress' => [new StringType(true), false, false, true],
			'streetName' => [new StringType(true), false, false, true],
			'streetSuffix' => [new StringType(true), false, false, true],
			'swiftBicNumber' => [new StringType(true), false, false, true],
			'text' => [new StringType(true), false, false, true],
			'title' => [new StringType(true), false, false, true],
			'titleFemale' => [new StringType(true), false, false, true],
			'titleMale' => [new StringType(true), false, false, true],
			'tld' => [new StringType(true), false, false, true],
			'url' => [new StringType(true), false, false, true],
			'userAgent' => [new StringType(true), false, false, true],
			'userName' => [new StringType(true), false, false, true],
			'uuid' => [new StringType(true), false, false, true],
			'vat' => [new StringType(true), false, false, true],
			'windowsPlatformToken' => [new StringType(true), false, false, true],
			'word' => [new StringType(true), false, false, true],

			'name' => [new StringType(true), false, false, true],

			'paragraphs' => [new StringType(true), false, false, true], //@property string|array $paragraphs
			'sentences' => [new StringType(true), false, false, true], //@property string|array $sentences
			'words' => [new StringType(true), false, false, true], //@property string|array $words

		];
	}

	public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
	{
		return $classReflection->getName() === Generator::class
			&& array_key_exists($propertyName, $this->properties);
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
		};
	}

}
