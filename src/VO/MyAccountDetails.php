<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class MyAccountDetails implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param null|string[] $badges
     */
    public function __construct(
        public readonly string $username,
        public readonly string $email,
        public readonly bool $subscribed,
        public readonly string $status,
        public readonly null|array $badges,
        public readonly int $gems,
        public readonly int $achievementsPoints,
        public readonly bool $banned,
        public readonly null|string $banReason,
    ) {}

    /**
     * @return array{
     *     username: string,
     *     email: string,
     *     subscribed: bool,
     *     status: string,
     *     badges: null|string[],
     *     gems: int,
     *     achievementsPoints: int,
     *     banned: bool,
     *     banReason: null|string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'subscribed' => $this->subscribed,
            'status' => $this->status,
            'badges' => $this->badges,
            'gems' => $this->gems,
            'achievementsPoints' => $this->achievementsPoints,
            'banned' => $this->banned,
            'banReason' => $this->banReason,
        ];
    }
}
