<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class AccountDetails implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param null|string[] $badges
     */
    public function __construct(
        public readonly string $username,
        public readonly bool $subscribed,
        public readonly string $status,
        public readonly null|array $badges,
        public readonly int $achievementsPoints,
        public readonly bool $banned,
        public readonly null|string $banReason,
    ) {}

    /**
     * @return array{
     *     username: string,
     *     subscribed: bool,
     *     status: string,
     *     badges: null|string[],
     *     achievementsPoints: int,
     *     banned: bool,
     *     banReason: null|string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'username' => $this->username,
            'subscribed' => $this->subscribed,
            'status' => $this->status,
            'badges' => $this->badges,
            'achievementsPoints' => $this->achievementsPoints,
            'banned' => $this->banned,
            'banReason' => $this->banReason,
        ];
    }
}
