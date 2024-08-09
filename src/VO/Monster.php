<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Monster implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param DropRate[] $drops
     */
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly int $level,
        public readonly int $hp,
        public readonly int $attackFire,
        public readonly int $attackEarth,
        public readonly int $attackWater,
        public readonly int $attackAir,
        public readonly int $resFire,
        public readonly int $resEarth,
        public readonly int $resWater,
        public readonly int $resAir,
        public readonly int $minGold,
        public readonly int $maxGold,
        public readonly array $drops,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     code: string,
     *     level: int,
     *     hp: int,
     *     attackFire: int,
     *     attackEarth: int,
     *     attackWater: int,
     *     attackAir: int,
     *     resFire: int,
     *     resEarth: int,
     *     resWater: int,
     *     resAir: int,
     *     minGold: int,
     *     maxGold: int,
     *     drops: DropRate[],
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'level' => $this->level,
            'hp' => $this->hp,
            'attackFire' => $this->attackFire,
            'attackEarth' => $this->attackEarth,
            'attackWater' => $this->attackWater,
            'attackAir' => $this->attackAir,
            'resFire' => $this->resFire,
            'resEarth' => $this->resEarth,
            'resWater' => $this->resWater,
            'resAir' => $this->resAir,
            'minGold' => $this->minGold,
            'maxGold' => $this->maxGold,
            'drops' => $this->drops,
        ];
    }
}
