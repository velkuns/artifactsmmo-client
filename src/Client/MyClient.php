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
    public function getBankDetails(): VO\Bank
    {
        $endpoint = '/my/bank';
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\BankFormatter());
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
     * @param array{code?:string, page?:int, size?:int} $query
     * @return VO\GEOrder[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getGeSellOrders(array $query = []): array
    {
        $endpoint = '/my/grandexchange/orders';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\GEOrderFormatter());
    }

    /**
     * @param array{id?:string, code?:string, page?:int, size?:int} $query
     * @return VO\GeOrderHistory[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getGeSellHistory(array $query = []): array
    {
        $endpoint = '/my/grandexchange/history';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\GeOrderHistoryFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAccountDetails(): VO\MyAccountDetails
    {
        $endpoint = '/my/details';
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\MyAccountDetailsFormatter());
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

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionMove(string $name, VO\Body\BodyDestination $body): VO\CharacterMovementData
    {
        $endpoint = "/my/$name/action/move";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\CharacterMovementDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionRest(string $name): VO\CharacterRestData
    {
        $endpoint = "/my/$name/action/rest";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\CharacterRestDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionEquipItem(string $name, VO\Body\BodyEquip $body): VO\EquipRequest
    {
        $endpoint = "/my/$name/action/equip";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\EquipRequestFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionUnequipItem(string $name, VO\Body\BodyUnequip $body): VO\EquipRequest
    {
        $endpoint = "/my/$name/action/unequip";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\EquipRequestFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionUseItem(string $name, VO\Body\BodySimpleItem $body): VO\UseItem
    {
        $endpoint = "/my/$name/action/use";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\UseItemFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionFight(string $name): VO\CharacterFightData
    {
        $endpoint = "/my/$name/action/fight";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\CharacterFightDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionGathering(string $name): VO\SkillData
    {
        $endpoint = "/my/$name/action/gathering";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\SkillDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionCrafting(string $name, VO\Body\BodyCrafting $body): VO\SkillData
    {
        $endpoint = "/my/$name/action/crafting";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\SkillDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionDepositBankGold(string $name, VO\Body\BodyDepositWithdrawGold $body): VO\BankGoldTransaction
    {
        $endpoint = "/my/$name/action/bank/deposit/gold";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\BankGoldTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionDepositBank(string $name, VO\Body\BodySimpleItem $body): VO\BankItemTransaction
    {
        $endpoint = "/my/$name/action/bank/deposit";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\BankItemTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionWithdrawBank(string $name, VO\Body\BodySimpleItem $body): VO\BankItemTransaction
    {
        $endpoint = "/my/$name/action/bank/withdraw";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\BankItemTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionWithdrawBankGold(string $name, VO\Body\BodyDepositWithdrawGold $body): VO\BankGoldTransaction
    {
        $endpoint = "/my/$name/action/bank/withdraw/gold";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\BankGoldTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionBuyBankExpansion(string $name): VO\BankExtensionTransaction
    {
        $endpoint = "/my/$name/action/bank/buy_expansion";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\BankExtensionTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionRecycling(string $name, VO\Body\BodyRecycling $body): VO\RecyclingData
    {
        $endpoint = "/my/$name/action/recycling";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\RecyclingDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionGeBuyItem(string $name, VO\Body\BodyGEBuyOrder $body): VO\GETransactionList
    {
        $endpoint = "/my/$name/action/grandexchange/buy";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\GETransactionListFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionGeCreateSellOrder(string $name, VO\Body\BodyGEOrderCreationr $body): VO\GEOrderTransaction
    {
        $endpoint = "/my/$name/action/grandexchange/sell";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\GEOrderTransactionFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionGeCancelSellOrder(string $name, VO\Body\BodyGECancelOrder $body): VO\GETransactionList
    {
        $endpoint = "/my/$name/action/grandexchange/cancel";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\GETransactionListFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionCompleteTask(string $name): VO\RewardData
    {
        $endpoint = "/my/$name/action/task/complete";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\RewardDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionTaskExchange(string $name): VO\RewardData
    {
        $endpoint = "/my/$name/action/task/exchange";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\RewardDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionAcceptNewTask(string $name): VO\TaskData
    {
        $endpoint = "/my/$name/action/task/new";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\TaskDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionTaskTrade(string $name, VO\Body\BodySimpleItem $body): VO\TaskTradeData
    {
        $endpoint = "/my/$name/action/task/trade";
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\TaskTradeDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionTaskCancel(string $name): VO\TaskCancelled
    {
        $endpoint = "/my/$name/action/task/cancel";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\TaskCancelledFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionChristmasExchange(string $name): VO\RewardData
    {
        $endpoint = "/my/$name/action/christmas/exchange";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\RewardDataFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function actionDeleteItem(string $name, VO\Body\BodySimpleItem $body): VO\DeleteItem
    {
        $endpoint = "/my/$name/action/delete";
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
}
