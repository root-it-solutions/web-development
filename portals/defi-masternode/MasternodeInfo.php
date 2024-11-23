<?php
require_once 'class_Masternode.php';
require_once 'RewardReduction.php';
require_once 'DeFiChain.php';

class MasternodeInfo extends DeFiChain
{
    private $ownerAuthAddress;
    private $id;
    private $creationBlock;
    private $creationTime;
    private $timelock;
    private $owners;
    private $mintedBlocks;
    private $lastMintedBlock;
    private $lastMintedBlockHash;
    private $lastMintedBlockTime;
    private $tm1Height;
    private $tm2Height;
    private $tm3Height;
    private $tm4Height;
    private $totalRewards;
    private $apr;
    private $blocskPerDay;
    private $avgTimeToFindBlock;

    /**
     * @throws Exception bla
     *
     */
    public function __construct($ownerAuthAddress, $owners = 1)
    {
        if (!isset($ownerAuthAddress))
        {
            throw new Exception('Please give Masternode Owneraddress');
        }
        $this->ownerAuthAddress = $ownerAuthAddress;
        $this->id = (new Masternode)->getMasternodeId($this->ownerAuthAddress);

        $this->owners = $owners;
        $this->getMasternode();
    }

    private function getMasternode()
    {
        $exec_command = self::NODECLI . ' getmasternode ' . $this->id;
        $result_json = self::callEXEC($exec_command, true);
        $result_json = str_replace($this->id, 'node', $result_json);
        $result_obj = json_decode($result_json);

        $this->creationBlock = $result_obj->node->creationHeight;
        $creationBlockInfo = $this->getBlockInfo($this->getBlockHash($this->creationBlock));
        $this->creationTime = (new DateTime)->setTimestamp($creationBlockInfo->time);

        $this->timelock = $result_obj->node->timelock;

        $this->mintedBlocks = $result_obj->node->mintedBlocks;
        $mintedBlocks = $this->getMasternodeMintedBlocks();
        $this->lastMintedBlock = max(array_keys($mintedBlocks));
        $this->lastMintedBlockHash = $mintedBlocks[$this->lastMintedBlock];
        $lastMintedBlockInfo = $this->getBlockInfo($this->lastMintedBlockHash);
        $this->lastMintedBlockTime = (new DateTime)->setTimestamp($lastMintedBlockInfo->time);

        $this->tm1Height = $result_obj->node->targetMultipliers[0];
        $this->tm2Height = $result_obj->node->targetMultipliers[1];
        $this->tm3Height = $result_obj->node->targetMultipliers[2];
        $this->tm4Height = $result_obj->node->targetMultipliers[3];

        // Calculate Total rewards from Transactions
        $this->totalRewards = 0;
        $exec_command = self::DEFICHAINAPI . '/mainnet/address/' . $this->ownerAuthAddress . '/transactions?size=1000000';
        //echo $exec_command."\n";exit;
        #https://ocean.defichain.com/v0/mainnet/tokens?next=0019dec50136a108c5ed55f00509f38d0fe8f6f5246aaeffbc9a1d2c643fe29bd90890c6b200000000&size=1000
        #$exec_command = self::DEFICHAINAPI . '/mainnet/address/' . $this->ownerAuthAddress . '/txs';
        $tx_obj = self::callAPI($exec_command);
        if($tx_obj->page->next !== '')
        {
            $exec_command = $exec_command.'&next='.$tx_obj->page->next;
            //echo $exec_command."\n";exit;
            $tx_obj2 = self::callAPI($exec_command);
            $txs = array_merge($tx_obj->data, $tx_obj2->data);
        }
        //var_dump($txs);exit;
        $this->totalRewards = $this->calcTotalRewards($txs);

        //$timeFromCreationToLastBlock = ($this->lastMintedBlockTime->getTimestamp() - $this->creationTime->getTimestamp()) / 60 / 60;
        $timeFromCreationToLastBlock = ((new DateTime())->getTimestamp() - $this->creationTime->getTimestamp()) / 60 / 60;
        $this->avgTimeToFindBlock = $timeFromCreationToLastBlock / $this->mintedBlocks;

        $this->blocskPerDay = ($this->mintedBlocks / $timeFromCreationToLastBlock) * 24;

        $actualReward = (new RewardReduction())->getActualReward(self::getLastBlockNumber());
        $this->apr = (($this->blocskPerDay * 365 * $actualReward) / 20011) * 100;


    }

    private function calcTotalRewards($txs): float
    {
        $tx_obj_count = count($txs);
        $rewards = 0;
        for ($i = 0; $i < $tx_obj_count; ++$i)
        {
            #if ($txs[$i]->coinbase)
            if ($txs[$i]->type === 'vin' && $txs[$i]->block->height >= 1152759)
            {
                //var_dump($txs[$i]);
                //echo $txs[$i]->value."\n";exit;
                $rewards += $txs[$i]->value;
                #$rewards += substr_replace($txs[$i]->value, '.', (strlen($txs[$i]->value) - 8), 0);
            }
        }
        return $rewards;
    }

    private function getBlockInfo($blockHash): object
    {
        $exec_command = self::NODECLI . ' getblock ' . $blockHash;
        return self::callEXEC($exec_command, false);
    }

    private function getBlockHash($block): string
    {
        $exec_command = self::NODECLI . ' getblockhash ' . $block;
        return self::callEXEC($exec_command, true);
    }

    private function getMasternodeMintedBlocks(): array
    {
        $exec_command = self::NODECLI . " getmasternodeblocks '{\"ownerAddress\": \"" . $this->ownerAuthAddress . "\"}'";
        return (array)self::callEXEC($exec_command, false);

    }

    public function getMasternodeLifetime(): DateInterval
    {
        $today = new DateTime();
        return $this->creationTime->diff($today);
    }

    public function getRewardPerOwner(): float
    {
        return ($this->totalRewards / $this->owners);
    }

    /**
     * @return mixed
     */
    public function getTimelock(): string
    {
        return $this->timelock;
    }

    /**
     * @param mixed $timelock
     */
    public function setTimelock($timelock): void
    {
        $this->timelock = $timelock;
    }

    /**
     * @return mixed
     */
    public function getOwners(): int
    {
        return $this->owners;
    }

    /**
     * @param mixed $owners
     */
    public function setOwners($owners): void
    {
        $this->owners = $owners;
    }

    /**
     * @return mixed
     */
    public function getMintedBlocks(): int
    {
        return $this->mintedBlocks;
    }

    /**
     * @param mixed $mintedBlocks
     */
    public function setMintedBlocks($mintedBlocks): void
    {
        $this->mintedBlocks = $mintedBlocks;
    }

    /**
     * @return mixed
     */
    public function getLastMintedBlock(): int
    {
        return $this->lastMintedBlock;
    }

    /**
     * @param mixed $lastMintedBlock
     */
    public function setLastMintedBlock($lastMintedBlock): void
    {
        $this->lastMintedBlock = $lastMintedBlock;
    }

    /**
     * @return mixed
     */
    public function getLastMintedBlockHash(): string
    {
        return $this->lastMintedBlockHash;
    }

    /**
     * @param mixed $lastMintedBlockHash
     */
    public function setLastMintedBlockHash($lastMintedBlockHash): void
    {
        $this->lastMintedBlockHash = $lastMintedBlockHash;
    }

    /**
     * @return mixed
     */
    public function getTm1Height(): int
    {
        return $this->tm1Height;
    }

    /**
     * @param mixed $tm1Height
     */
    public function setTm1Height($tm1Height): void
    {
        $this->tm1Height = $tm1Height;
    }

    /**
     * @return mixed
     */
    public function getTm2Height(): int
    {
        return $this->tm2Height;
    }

    /**
     * @param mixed $tm2Height
     */
    public function setTm2Height($tm2Height): void
    {
        $this->tm2Height = $tm2Height;
    }

    /**
     * @return mixed
     */
    public function getTm3Height(): int
    {
        return $this->tm3Height;
    }

    /**
     * @param mixed $tm3Height
     */
    public function setTm3Height($tm3Height): void
    {
        $this->tm3Height = $tm3Height;
    }

    /**
     * @return mixed
     */
    public function getTm4Height(): int
    {
        return $this->tm4Height;
    }

    /**
     * @param mixed $tm4Height
     */
    public function setTm4Height($tm4Height): void
    {
        $this->tm4Height = $tm4Height;
    }

    /**
     * @return mixed
     */
    public function getTotalRewards(): float
    {
        return $this->totalRewards;
    }

    /**
     * @param mixed $totalRewards
     */
    public function setTotalRewards($totalRewards): void
    {
        $this->totalRewards = $totalRewards;
    }

    /**
     * @return mixed
     */
    public function getApr(): float
    {
        return $this->apr;
    }

    /**
     * @param mixed $apr
     */
    public function setApr($apr): void
    {
        $this->apr = $apr;
    }

    /**
     * @return mixed
     */
    public function getBlocskPerDay(): float
    {
        return $this->blocskPerDay;
    }

    /**
     * @param mixed $blocskPerDay
     */
    public function setBlocskPerDay($blocskPerDay): void
    {
        $this->blocskPerDay = $blocskPerDay;
    }

    /**
     * @return mixed
     */
    public function getAvgTimeToFindBlock(): float
    {
        return $this->avgTimeToFindBlock;
    }

    /**
     * @param mixed $avgTimeToFindBlock
     */
    public function setAvgTimeToFindBlock($avgTimeToFindBlock): void
    {
        $this->avgTimeToFindBlock = $avgTimeToFindBlock;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreationBlock(): int
    {
        return $this->creationBlock;
    }

    /**
     * @param mixed $creationBlock
     */
    public function setCreationBlock($creationBlock): void
    {
        $this->creationBlock = $creationBlock;
    }

    /**
     * @return mixed
     */
    public function getCreationTime(): DateTime
    {
        return $this->creationTime;
    }

    /**
     * @param mixed $creationTime
     */
    public function setCreationTime($creationTime): void
    {
        $this->creationTime = $creationTime;
    }

    /**
     * @return mixed
     */
    public function getLastMintedBlockTime(): DateTime
    {
        return $this->lastMintedBlockTime;
    }

    /**
     * @param mixed $lastMintedBlockTime
     */
    public function setLastMintedBlockTime($lastMintedBlockTime): void
    {
        $this->lastMintedBlockTime = $lastMintedBlockTime;
    }
}
