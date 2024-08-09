<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Fight implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param Drop[] $drops
     * @param string[] $logs
     */
    public function __construct(
        public readonly int $xp,
        public readonly int $gold,
        public readonly array $drops,
        public readonly int $turns,
        public readonly BlockedHits $monsterBlockedHits,
        public readonly BlockedHits $playerBlockedHits,
        public readonly array $logs,
        public readonly string $result,
    ) {}

    /**
     * @return array{
     *     xp: int,
     *     gold: int,
     *     drops: Drop[],
     *     turns: int,
     *     monsterBlockedHits: BlockedHits,
     *     playerBlockedHits: BlockedHits,
     *     logs: string[],
     *     result: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'xp' => $this->xp,
            'gold' => $this->gold,
            'drops' => $this->drops,
            'turns' => $this->turns,
            'monsterBlockedHits' => $this->monsterBlockedHits,
            'playerBlockedHits' => $this->playerBlockedHits,
            'logs' => $this->logs,
            'result' => $this->result,
        ];
    }
}
