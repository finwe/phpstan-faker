<?php declare(strict_types = 1);

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
use PHPStan\Type\TrueOrFalseBooleanType;
use PHPStan\Type\Type;

class FakerMethodsClassReflectionExtension implements MethodsClassReflectionExtension
{

	private $methods;

	public function __construct()
	{
		$this->methods = [
			'asciify' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string')], FALSE], //@method string asciify($string = '****')
			'bothify' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string')], FALSE], //@method string bothify($string = '## ??')
			'creditCardNumber' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('type'), $this->bp('formatted'), $this->sp('separator')], FALSE], //@method string creditCardNumber($type = null, $formatted = false, $separator = '-')
			'date' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('format'), $this->sp('max')], FALSE], //@method string date($format = 'Y-m-d', $max = 'now')
			'file' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('sourceDirectory'), $this->sp('targetDirectory'), $this->bp('fullpath')], FALSE], //@method string file($sourceDirectory = '/tmp', $targetDirectory = '/tmp', $fullPath = true)
			'iban' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('countryCode'), $this->sp('prefix'), $this->ip('length')], FALSE], //@method string iban($countryCode = null, $prefix = '', $length = null)
			'image' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('dir'), $this->ip('width'), $this->ip('height'), $this->sp('category'), $this->bp('fullpath')], FALSE], //@method string image($dir = null, $width = 640, $height = 480, $category = null, $fullPath = true)
			'imageUrl' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ip('width'), $this->ip('height'), $this->sp('category'), $this->bp('randomize'), $this->sp('word')], FALSE], //@method string imageUrl($width = 640, $height = 480, $category = null, $randomize = true, $word = null)
			'lexify' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string')], FALSE], //@method string lexify($string = '????')
			'numerify' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string')], FALSE], //@method string numerify($string = '###')
			'paragraph' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ip('nbSentences'), $this->bp('variableNbSentences')], FALSE], //@method string paragraph($nbSentences = 3, $variableNbSentences = true)
			'password' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ip('minLength'), $this->ip('maxLength')], FALSE], //@method string password($minLength = 6, $maxLength = 20)
			'realText' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ip('maxNbChars'), $this->ip('indexSize')], FALSE], //@method string realText($maxNbChars = 200, $indexSize = 2)
			'regexify' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string')], FALSE], //@method string regexify($regex = '')
			'sentence' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('nbWords'), $this->sp('variableNbWords')], FALSE], //@method string sentence($nbWords = 6, $variableNbWords = true)
			'shuffleString' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string'), $this->sp('encoding')], FALSE], //@method string shuffleString($string = '', $encoding = 'UTF-8')
			'slug' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ip('nbWords'), $this->bp('variableNbWords')], FALSE], //@method string slug($nbWords = 6, $variableNbWords = true)
			'text' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ip('maxNbChars')], FALSE], //@method string text($maxNbChars = 200)
			'time' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('format'), $this->sp('max')], FALSE], //@method string time($format = 'H:i:s', $max = 'now')
			'toLower' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string')], FALSE], //@method string toLower($string = '')
			'toUpper' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->sp('string')], FALSE], //@method string toUpper($string = '')

			'dateTimeBetween' => [new ObjectType(DateTime::class, true), FALSE, FALSE, TRUE, [$this->sp('startDate'), $this->sp('endDate')], FALSE], //@method \DateTime dateTimeBetween($startDate = '-30 years', $endDate = 'now')

			'paragraphs' => [new MixedType(), FALSE, FALSE, TRUE, [$this->ip('nb'), $this->bp('asText')], FALSE], //@method string|array paragraphs($nb = 3, $asText = false)
			'sentences' => [new MixedType(), FALSE, FALSE, TRUE, [$this->ip('nb'), $this->bp('asText')], FALSE], //@method string|array sentences($nb = 3, $asText = false)
			'words' => [new MixedType(), FALSE, FALSE, TRUE, [$this->ip('nb'), $this->bp('asText')], FALSE], //@method string|array words($nb = 3, $asText = false)

			'randomKey' => [new MixedType(), FALSE, FALSE, TRUE, [$this->ap('array')], FALSE], //@method int|string|null randomKey(array $array = array())
			'randomElement' => [new MixedType(), FALSE, FALSE, TRUE, [$this->ap('array')], FALSE], //@method int|string|null randomKey(array $array = array())

			'shuffle' => [new MixedType(), FALSE, FALSE, TRUE, [$this->sp('arg')], FALSE], //@method array|string shuffle($arg = '')

			'optional' => [new ThisType(Generator::class, TRUE), FALSE, FALSE, TRUE, [$this->fp('weight'), $this->sp('default')], FALSE], //@method Generator optional($weight = 0.5, $default = null)
			'unique' => [new ThisType(Generator::class, TRUE), FALSE, FALSE, TRUE, [$this->bp('reset'), $this->ip('maxRetries')], FALSE], //@method Generator unique($reset = false, $maxRetries = 10000)

			'numberBetween' => [new IntegerType(TRUE), FALSE, FALSE, TRUE, [$this->ip('min'), $this->ip('max')], FALSE], //@method int numberBetween($min = 0, $max = 2147483647)
			'randomNumber' => [new IntegerType(TRUE), FALSE, FALSE, TRUE, [$this->ip('nbDigits'), $this->bp('strict')], FALSE], //@method int randomNumber($nbDigits = null, $strict = false)
			'biasedNumberBetween' => [new IntegerType(TRUE), FALSE, FALSE, TRUE, [$this->ip('min'),$this->ip('max'), $this->sp('function')], FALSE], //@method int biasedNumberBetween($min = 0, $max = 100, $function = 'sqrt')

			'randomElements' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ap('array'), $this->ip('count')], FALSE], //@method array randomElements(array $array = array('a', 'b', 'c'), $count = 1)
			'shuffleArray' => [new StringType(TRUE), FALSE, FALSE, TRUE, [$this->ap('array')], FALSE], //@method array shuffleArray(array $array = array())

			'boolean' => [new TrueOrFalseBooleanType(TRUE), FALSE, FALSE, TRUE, [$this->ip('chanceOfGettingTrue')], FALSE], //@method boolean boolean($chanceOfGettingTrue = 50)

			'randomFloat' => [new FloatType(TRUE), FALSE, FALSE, TRUE, [$this->ip('nbMaxDecimals'), $this->ip('min'), $this->ip('max')], FALSE], //@method float randomFloat($nbMaxDecimals = null, $min = 0, $max = null)
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

	private function returnMethodImplementation(Type $returnType, ClassReflection $declaringClass, bool $static, bool $private, bool $public, string $name, array $parameters, bool $variadic): MethodReflection
	{

		return new class($returnType, $declaringClass, $static, $private, $public, $name, $parameters, $variadic) implements MethodReflection
		{

			private $returnType, $declaringClass, $static, $private, $public, $name, $parameters, $variadic;

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

	private function sp(string $name)
	{
		return $this->createParameterInstance(new StringType(FALSE), $name, TRUE, FALSE, FALSE);
	}

	private function ip(string $name)
	{
		return $this->createParameterInstance(new IntegerType(FALSE), $name, TRUE, FALSE, FALSE);
	}

	private function bp(string $name)
	{
		return $this->createParameterInstance(new TrueOrFalseBooleanType(FALSE), $name, TRUE, FALSE, FALSE);
	}

	private function fp(string $name)
	{
		return $this->createParameterInstance(new FloatType(FALSE), $name, TRUE, FALSE, FALSE);
	}

	private function ap(string $name)
	{
		return $this->createParameterInstance(new ArrayType(new MixedType(), FALSE), $name, TRUE, FALSE, FALSE);
	}

	private function createParameterInstance(Type $type, string $name, bool $optional, bool $passedByReference, bool $variadic)
	{
		return new class($type, $name, $optional, $passedByReference, $variadic) implements ParameterReflection
		{
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
