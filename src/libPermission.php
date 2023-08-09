<?php

declare(strict_types = 1);

namespace AmitxD\libPermission;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\scheduler\TaskScheduler;
use callable;

class libPermission extends PluginBase {
    
    /** @var self */
    private static $instance;

    public function onEnable(): void {
        self::$instance = $this;
    }

    /**
     * Grants a permission to a player.
     *
     * @param Player $player
     * @param string $permission
     * @return void
     */
    public static function set(Player $player, string $permission): void {
        $player->addAttachment(self::getInstance(), $permission, false); 
    }
    
    /**
     * Grants a permission to a player for a specific duration.
     *
     * @param Player $player
     * @param string $permission
     * @param int $time Time in seconds
     * @return void
     */
    public static function setFor(Player $player, string $permission, int $time): void {
        $instance = self::getInstance();
        $player->addAttachment($instance, $permission, false);
        
        self::wait(function() use ($player, $permission) {
            self::remove($player, $permission);
        }, $time);
    }

    /**
     * Checks if a player has a certain permission.
     *
     * @param Player $player
     * @param string $perm
     * @return bool
     */
    public static function has(Player $player, string $perm): bool {
        return $player->hasPermission($perm);
    }
    
    /**
     * Removes a permission from a player.
     *
     * @param Player $player
     * @param string $permission
     * @return void
     */
    public static function remove(Player $player, string $permission): void {
        $player->removeAttachment($permission);
        $player->recalculatePermissions();
    }
    
    /**
     * Lists all permissions of a player.
     *
     * @param Player $player
     * @return array
     */
    public static function listPlayerPermissions(Player $player): array {
        $permissions = [];
        
        foreach ($player->getEffectivePermissions() as $permission) {
            $permissions[] = $permission->getPermission();
        }
        
        return $permissions;
    }

    /**
     * Executes a callback after a specified duration.
     *
     * @param callable $callback
     * @param int $duration Time in seconds
     * @return void
     */
    public static function wait(callable $callback, int $duration): void {
        self::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask($callback), $duration * 20);
    }

    /**
     * Returns the instance of the plugin.
     *
     * @return self
     */
    public static function getInstance(): self {
        return self::$instance;
    }
}
