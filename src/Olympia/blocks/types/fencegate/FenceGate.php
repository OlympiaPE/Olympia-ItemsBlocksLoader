<?php

namespace Olympia\blocks\types\fencegate;

use customiesdevs\customies\block\permutations\Permutable;
use customiesdevs\customies\block\permutations\RotatableTrait;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\Transparent;
use pocketmine\block\utils\SupportType;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;
use pocketmine\world\sound\DoorSound;

class FenceGate extends Transparent implements Permutable
{
    use RotatableTrait;

    public bool $interactable = true;

    public function __construct(int $typeId)
    {
        $info = new BlockTypeInfo(BlockBreakInfo::axe(2.0, null, 15.0));
        parent::__construct(new BlockIdentifier($typeId), "Fence Gate", $info);
    }

    public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null): bool
    {
        if($player !== null) {
            if ($blockClicked instanceof FenceGate && !$player->isSneaking()) {
                return false;
            }
            $this->facing = $player->getHorizontalFacing();
        }
        return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []): bool
    {
        $world = $this->position->getWorld();
        $world->addSound($this->position, new DoorSound());

        return parent::onInteract($item, $face, $clickVector, $player, $returnedItems);
    }

    public function getSupportType(int $facing): SupportType
    {
        return SupportType::NONE;
    }
}