<?php

namespace Olympia\Kitmap\blocks\types;

use DaPigGuy\PiggyFactions\permissions\FactionPermission;
use DaPigGuy\PiggyFactions\PiggyFactions;
use Olympia\Kitmap\forms\ChunkBusterForm;
use Olympia\Kitmap\session\Session;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

final class ChunkBuster extends Block
{
    public function __construct()
    {
        $info = new BlockTypeInfo(BlockBreakInfo::pickaxe(2.5, ToolTier::WOOD));
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Chunk Buster", $info);
    }

    /**
     * @param BlockTransaction $tx
     * @param Item $item
     * @param Block $blockReplace
     * @param Block $blockClicked
     * @param int $face
     * @param Vector3 $clickVector
     * @param Session|null $player
     * @return bool
     */
    public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null): bool
    {
        if ($player instanceof Session) {
            $pos = $blockReplace->getPosition();
            $factionPlayer = PiggyFactions::getInstance()->getPlayerManager()->getPlayer($player);
            $chunk = PiggyFactions::getInstance()->getClaimsManager()->getClaimByPosition($pos);
            $chunkFaction = $chunk?->getFaction();
            if (!is_null($chunkFaction) && $chunkFaction->hasPermission($factionPlayer, FactionPermission::BUILD)) {
                ChunkBusterForm::sendForm($player, $this);
            }else{
                return false;
            }
        }
        return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
    }
}