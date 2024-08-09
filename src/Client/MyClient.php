<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class MyClient extends AbstractClient
{
    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionMove(string $name, VO\Body\BodyDestination $body): VO\CharacterMovementData
    {
        $endpoint = '/my/{name}/action/move';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\CharacterMovementDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionEquipItem(string $name, VO\Body\BodyEquip $body): VO\EquipRequest
    {
        $endpoint = '/my/{name}/action/equip';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\EquipRequestFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionUnequipItem(string $name, VO\Body\BodyUnequip $body): VO\EquipRequest
    {
        $endpoint = '/my/{name}/action/unequip';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\EquipRequestFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionFight(string $name): VO\CharacterFightData
    {
        $endpoint = '/my/{name}/action/fight';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\CharacterFightDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionGathering(string $name): VO\SkillData
    {
        $endpoint = '/my/{name}/action/gathering';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\SkillDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionCrafting(string $name, VO\Body\BodyCrafting $body): VO\SkillData
    {
        $endpoint = '/my/{name}/action/crafting';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\SkillDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionDepositBank(string $name, VO\Body\BodySimpleItem $body): VO\BankItem
    {
        $endpoint = '/my/{name}/action/bank/deposit';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\BankItemFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionDepositBankGold(string $name, VO\Body\BodyDepositWithdrawGold $body): VO\GoldTransaction
    {
        $endpoint = '/my/{name}/action/bank/deposit/gold';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\GoldTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionRecycling(string $name, VO\Body\BodyRecycling $body): VO\RecyclingData
    {
        $endpoint = '/my/{name}/action/recycling';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\RecyclingDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionWithdrawBank(string $name, VO\Body\BodySimpleItem $body): VO\BankItem
    {
        $endpoint = '/my/{name}/action/bank/withdraw';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\BankItemFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionWithdrawBankGold(string $name, VO\Body\BodyDepositWithdrawGold $body): VO\GoldTransaction
    {
        $endpoint = '/my/{name}/action/bank/withdraw/gold';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\GoldTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionGeBuyItem(string $name, VO\Body\BodyGETransactionItem $body): VO\GETransactionList
    {
        $endpoint = '/my/{name}/action/ge/buy';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\GETransactionListFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionGeSellItem(string $name, VO\Body\BodyGETransactionItem $body): VO\GETransactionList
    {
        $endpoint = '/my/{name}/action/ge/sell';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\GETransactionListFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionAcceptNewTask(string $name): VO\TaskData
    {
        $endpoint = '/my/{name}/action/task/new';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\TaskDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionCompleteTask(string $name): VO\TaskRewardData
    {
        $endpoint = '/my/{name}/action/task/complete';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\TaskRewardDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionTaskExchange(string $name): VO\TaskRewardData
    {
        $endpoint = '/my/{name}/action/task/exchange';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\TaskRewardDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionDeleteItem(string $name, VO\Body\BodySimpleItem $body): VO\DeleteItem
    {
        $endpoint = '/my/{name}/action/delete';
        $replace = ['{name}' => $name];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\DeleteItemFormatter());
    }

    /**
     * @param array{page?:int, size?:int} $query
     * @return VO\Log[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAllCharactersLogs(array $query = []): array
    {
        $endpoint = '/my/logs';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\LogFormatter());
    }

    /**
     * @return VO\Character[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getMyCharacters(): array
    {
        $endpoint = '/my/characters';
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVOList($request, new Formatter\CharacterFormatter());
    }

    /**
     * @param array{item_code?:string, page?:int, size?:int} $query
     * @return VO\SimpleItem[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getBankItems(array $query = []): array
    {
        $endpoint = '/my/bank/items';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\SimpleItemFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getBankGolds(): VO\Gold
    {
        $endpoint = '/my/bank/gold';
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\GoldFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function changePassword(VO\Body\BodyChangePassword $body): VO\Response
    {
        $endpoint = '/my/change_password';
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\ResponseFormatter());
    }
}
