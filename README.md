# libPermission

`libPermission` is a lightweight library for managing player permissions in PocketMine MP plugins. It provides an easy-to-use API to grant, remove, and manage permissions for players.

## Features

- Grant and remove permissions from players.
- Set permissions for a specific duration.
- Check if a player has a specific permission.
- List all permissions of a player.

## Installation

1. Download the latest release of `libPermission` from the [Releases](https://github.com/Amitminer/libPermission/releases) section.
2. Place the `libPermission.phar` file in your PocketMine MP's `plugins` folder.

## Usage

```php
use pocketmine\player\Player;
use AmitxD\libPermission\libPermission;

// Grant a permission to a player
libPermission::set($player, "example.permission");

// Set a permission for a player for a specific duration
libPermission::setFor($player, "temporary.permission", 300); // 300 seconds

// Check if a player has a specific permission
if (libPermission::has($player, "example.permission")) {
    // Player has the permission
} else {
    // Player does not have the permission
}

// Remove a permission from a player
libPermission::remove($player, "example.permission");

// List all permissions of a player
$permissions = libPermission::listPlayerPermissions($player);
```

## Contributing

Contributions are welcome! If you'd like to contribute to the development of `libPermission`, feel free to submit a pull request.

## License

`libPermission` is open-source software licensed under the [MIT License](LICENSE).
