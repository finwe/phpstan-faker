<?php

declare(strict_types = 1);

namespace Finwe\PHPStan\Faker\Reflection;

use DateTime;
use Faker\Generator;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Type\ArrayType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\ThisType;
use PHPStan\Type\TrueOrfalseBooleanType;
use PHPStan\Type\Type;

class FakerMethodsClassReflectionExtension implements MethodsClassReflectionExtension
{

	/**
	 * @var mixed[]
	 */
	private $methods;

	public function __construct()
	{
		$this->methods = [
			'asciify' => [new StringType(), false, false, true, [$this->sp('string')], false], //@method string asciify($string = '****')
			'bothify' => [new StringType(), false, false, true, [$this->sp('string')], false], //@method string bothify($string = '## ??')
			'creditCardNumber' => [new StringType(), false, false, true, [$this->sp('type'), $this->bp('formatted'), $this->sp('separator')], false], //@method string creditCardNumber($type = null, $formatted = false, $separator = '-')
			'date' => [new StringType(), false, false, true, [$this->sp('format'), $this->sp('max')], false], //@method string date($format = 'Y-m-d', $max = 'now')
			'file' => [new StringType(), false, false, true, [$this->sp('sourceDirectory'), $this->sp('targetDirectory'), $this->bp('fullpath')], false], //@method string file($sourceDirectory = '/tmp', $targetDirectory = '/tmp', $fullPath = true)
			'iban' => [new StringType(), false, false, true, [$this->sp('countryCode'), $this->sp('prefix'), $this->ip('length')], false], //@method string iban($countryCode = null, $prefix = '', $length = null)
			'image' => [new StringType(), false, false, true, [$this->sp('dir'), $this->ip('width'), $this->ip('height'), $this->sp('category'), $this->bp('fullpath')], false], //@method string image($dir = null, $width = 640, $height = 480, $category = null, $fullPath = true)
			'imageUrl' => [new StringType(), false, false, true, [$this->ip('width'), $this->ip('height'), $this->sp('category'), $this->bp('randomize'), $this->sp('word')], false], //@method string imageUrl($width = 640, $height = 480, $category = null, $randomize = true, $word = null)
			'lexify' => [new StringType(), false, false, true, [$this->sp('string')], false], //@method string lexify($string = '????')
			'numerify' => [new StringType(), false, false, true, [$this->sp('string')], false], //@method string numerify($string = '###')
			'paragraph' => [new StringType(), false, false, true, [$this->ip('nbSentences'), $this->bp('variableNbSentences')], false], //@method string paragraph($nbSentences = 3, $variableNbSentences = true)
			'password' => [new StringType(), false, false, true, [$this->ip('minLength'), $this->ip('maxLength')], false], //@method string password($minLength = 6, $maxLength = 20)
			'realText' => [new StringType(), false, false, true, [$this->ip('maxNbChars'), $this->ip('indexSize')], false], //@method string realText($maxNbChars = 200, $indexSize = 2)
			'regexify' => [new StringType(), false, false, true, [$this->sp('string')], false], //@method string regexify($regex = '')
			'sentence' => [new StringType(), false, false, true, [$this->sp('nbWords'), $this->sp('variableNbWords')], false], //@method string sentence($nbWords = 6, $variableNbWords = true)
			'shuffleString' => [new StringType(), false, false, true, [$this->sp('string'), $this->sp('encoding')], false], //@method string shuffleString($string = '', $encoding = 'UTF-8')
			'slug' => [new StringType(), false, false, true, [$this->ip('nbWords'), $this->bp('variableNbWords')], false], //@method string slug($nbWords = 6, $variableNbWords = true)
			'text' => [new StringType(), false, false, true, [$this->ip('maxNbChars')], false], //@method string text($maxNbChars = 200)
			'time' => [new StringType(), false, false, true, [$this->sp('format'), $this->sp('max')], false], //@method string time($format = 'H:i:s', $max = 'now')
			'toLower' => [new StringType(), false, false, true, [$this->sp('string')], false], //@method string toLower($string = '')
			'toUpper' => [new StringType(), false, false, true, [$this->sp('string')], false], //@method string toUpper($string = '')

			'dateTimeBetween' => [new ObjectType(DateTime::class), false, false, true, [$this->sp('startDate'), $this->sp('endDate')], false], //@method \DateTime dateTimeBetween($startDate = '-30 years', $endDate = 'now')

			'paragraphs' => [new MixedType(), false, false, true, [$this->ip('nb'), $this->bp('asText')], false], //@method string|array paragraphs($nb = 3, $asText = false)
			'sentences' => [new MixedType(), false, false, true, [$this->ip('nb'), $this->bp('asText')], false], //@method string|array sentences($nb = 3, $asText = false)
			'words' => [new MixedType(), false, false, true, [$this->ip('nb'), $this->bp('asText')], false], //@method string|array words($nb = 3, $asText = false)

			'randomKey' => [new MixedType(), false, false, true, [$this->ap('array')], false], //@method int|string|null randomKey(array $array = array())
			'randomElement' => [new MixedType(), false, false, true, [$this->ap('array')], false], //@method int|string|null randomKey(array $array = array())

			'shuffle' => [new MixedType(), false, false, true, [$this->sp('arg')], false], //@method array|string shuffle($arg = '')

			'optional' => [new ThisType(Generator::class), false, false, true, [$this->fp('weight'), $this->sp('default')], false], //@method Generator optional($weight = 0.5, $default = null)
			'unique' => [new ThisType(Generator::class), false, false, true, [$this->bp('reset'), $this->ip('maxRetries')], false], //@method Generator unique($reset = false, $maxRetries = 10000)

			'numberBetween' => [new IntegerType(), false, false, true, [$this->ip('min'), $this->ip('max')], false], //@method int numberBetween($min = 0, $max = 2147483647)
			'randomNumber' => [new IntegerType(), false, false, true, [$this->ip('nbDigits'), $this->bp('strict')], false], //@method int randomNumber($nbDigits = null, $strict = false)
			'biasedNumberBetween' => [new IntegerType(), false, false, true, [$this->ip('min'), $this->ip('max'), $this->sp('function')], false], //@method int biasedNumberBetween($min = 0, $max = 100, $function = 'sqrt')

			'randomElements' => [new StringType(), false, false, true, [$this->ap('array'), $this->ip('count')], false], //@method array randomElements(array $array = array('a', 'b', 'c'), $count = 1)
			'shuffleArray' => [new StringType(), false, false, true, [$this->ap('array')], false], //@method array shuffleArray(array $array = array())

			'boolean' => [new TrueOrfalseBooleanType(), false, false, true, [$this->ip('chanceOfGettingTrue')], false], //@method boolean boolean($chanceOfGettingTrue = 50)

			'randomFloat' => [new FloatType(), false, false, true, [$this->ip('nbMaxDecimals'), $this->ip('min'), $this->ip('max')], false], //@method float randomFloat($nbMaxDecimals = null, $min = 0, $max = null)
		];
	}

	public function hasMethod(ClassReflection $classReflection, string $methodName): bool
	{
		return $classReflection->getName() === Generator::class
			&& array_key_exists($methodName, $this->methods);
	}

	public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
	{
		$key = $this->methods[$methodName];

		return $this->returnMethodImplementation($key[0], $classReflection, $key[1], $key[2], $key[3], $methodName, $key[4], $key[5]);
	}

	/**
	 * @param \PHPStan\Type\Type $returnType
	 * @param \PHPStan\Reflection\ClassReflection $declaringClass
	 * @param bool $static
	 * @param bool $private
	 * @param bool $public
	 * @param string $name
	 * @param mixed[] $parameters
	 * @param bool $variadic
	 */
	private function returnMethodImplementation(Type $returnType, ClassReflection $declaringClass, bool $static, bool $private, bool $public, string $name, array $parameters, bool $variadic): MethodReflection
	{
		return new class($returnType, $declaringClass, $static, $private, $public, $name, $parameters, $variadic) implements MethodReflection
		{

			/**
			 * @var mixed
			 */
			private $returnType, $declaringClass, $static, $private, $public, $name, $parameters, $variadic;

			/**
			 * @param \PHPStan\Type\Type $returnType
			 * @param \PHPStan\Reflection\ClassReflection $declaringClass
			 * @param bool $static
			 * @param bool $private
			 * @param bool $public
			 * @param string $name
			 * @param mixed[] $parameters
			 * @param bool $variadic
			 */
			public function __construct(Type $returnType, ClassReflection $declaringClass, bool $static, bool $private, bool $public, string $name, array $parameters, bool $variadic)
			{
				$this->returnType = $returnType;
				$this->declaringClass = $declaringClass;
				$this->static = $static;
				$this->private = $private;
				$this->public = $public;
				$this->name = $name;
				$this->parameters = $parameters;
				$this->variadic = $variadic;
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

			public function getPrototype(): MethodReflection
			{
				return $this;
			}

			public function getName(): string
			{
				return $this->name;
			}

			/**
			 * @return \PHPStan\Reflection\ParameterReflection[]
			 */
			public function getParameters(): array
			{
				return $this->parameters;
			}

			public function isVariadic(): bool
			{
				return $this->variadic;
			}

			public function getReturnType(): Type
			{
				return $this->returnType;
			}
		};
	}

	private function sp(string $name): ParameterReflection
	{
		return $this->createParameterInstance(new StringType(), $name, true, false, false);
	}

	private function ip(string $name): ParameterReflection
	{
		return $this->createParameterInstance(new IntegerType(), $name, true, false, false);
	}

	private function bp(string $name): ParameterReflection
	{
		return $this->createParameterInstance(new TrueOrfalseBooleanType(), $name, true, false, false);
	}

	private function fp(string $name): ParameterReflection
	{
		return $this->createParameterInstance(new FloatType(), $name, true, false, false);
	}

	private function ap(string $name): ParameterReflection
	{
		return $this->createParameterInstance(new ArrayType(new MixedType(), new MixedType(), false), $name, true, false, false);
	}

	private function createParameterInstance(Type $type, string $name, bool $optional, bool $passedByReference, bool $variadic): ParameterReflection
	{
		return new class($type, $name, $optional, $passedByReference, $variadic) implements ParameterReflection
		{
			/**
			 * @var mixed
			 */
			private $type, $name, $optional, $passedByReference, $variadic;

			public function __construct(Type $type, string $name, bool $optional, bool $passedByReference, bool $variadic)
			{
				$this->type = $type;
				$this->name = $name;
				$this->optional = $optional;
				$this->passedByReference = $passedByReference;
				$this->variadic = $variadic;
			}

			public function getName(): string
			{
				return $this->name;
			}

			public function isOptional(): bool
			{
				return $this->optional;
			}

			public function getType(): Type
			{
				return $this->type;
			}

			public function isPassedByReference(): bool
			{
				return $this->passedByReference;
			}

			public function isVariadic(): bool
			{
				return $this->variadic;
			}
		};
	}

}
