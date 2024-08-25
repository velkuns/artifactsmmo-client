<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BankExtensionTransaction implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly Cooldown $cooldown,
        public readonly BankExtension $transaction,
        public readonly Character $character,
    ) {}

    /**
     * @return array{
     *     cooldown: Cooldown,
     *     transaction: BankExtension,
     *     character: Character,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'cooldown' => $this->cooldown,
            'transaction' => $this->transaction,
            'character' => $this->character,
        ];
    }
}
