<?php

namespace Olympia\blocks\types\fencegate;

use Olympia\blocks\OlympiaBlocks;
use Olympia\blocks\OlympiaBlockTypeIds;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class FenceGateOpen extends FenceGate
{
    public function __construct()
    {
        parent::__construct(OlympiaBlockTypeIds::FENCE_GATE_OPEN);
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []): bool
    {
        $fenceGate = OlympiaBlocks::FENCE_GATE_CLOSE();
        $fenceGate->facing = $this->facing;
        $this->position->world->setBlock($this->position, $fenceGate);
        return parent::onInteract($item, $face, $clickVector, $player, $returnedItems);
    }

    protected function recalculateCollisionBoxes(): array
    {
        return [];
    }
}