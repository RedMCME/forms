<?php

declare(strict_types=1);

namespace forms\element;

use JetBrains\PhpStorm\Immutable;
use pocketmine\form\FormValidationException;

abstract class BaseElement implements \JsonSerializable{

	public function __construct(#[Immutable] public /*readonly*/ string $text){ }

	abstract protected function getType() : string;

	/**
	 * @throws FormValidationException
	 */
	abstract protected function validateValue(mixed $value) : void;

	/** @phpstan-return array<string, mixed> */
	abstract protected function serializeElementData() : array;

	/** @phpstan-return array<string, mixed> */
	#[\ReturnTypeWillChange]
	final public function jsonSerialize() : array{
		$ret = $this->serializeElementData();
		$ret["type"] = $this->getType();
		$ret["text"] = $this->text;

		return $ret;
	}
}
