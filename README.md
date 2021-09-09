# m20online-core
This is a library package to help you generate and manage Microlite20 purest-essence characters sheets.

## Motivation
I am a tabletop RPG player and game master. A few times ago I discovered Microlite20 ruleset which is simple, efficient and can be use to any kind of game (D&D, Call of Cthulhu, Paranoïa...). Then I decided to create a project to help me generate character sheet.
This package is a part of this project and contain the core code to generate a character.

## Installation
You can install it through composer:
> composer require bertprod/m20onlinecore

## System requirements
PHP >= 7.2 but latest stable version is highly recommanded

## Usage
Let's say you want to create a Dwarf fighter:

~~~php
<?php
use M20OnlineCore\Builder\CharacterBuilder;
use M20OnlineCore\Entity\CharacterEntity;
use M20OnlineCore\Job\FighterJob;
use M20OnlineCore\Race\DwarfRace;

$characterBuilder = new CharacterBuilder();

$characterEntity = $characterBuilder->build(DwarfRace::NAME, FighterJob::NAME);
~~~

It will return an instance of `M20OnlineCore\Entity\CharacterEntity` with which you'll be able to access to your character data.

By example, if you want the value of strength stat:

~~~php
<?php
$strengh = $characterEntity->get(CharacterEntity::STAT_STR);
~~~

All available fields are stored in `data` attribute of `M20OnlineCore\Entity\CharacterEntity` class.

## Testing
### Unit testing
You can run unit testing through PHPUnit:
> vendor/bin/phpunit

### Code sniffer
Code follow PSR12, to run test:
> vendor/bin/phpcs --standard=PSR12 src/

## License
MIT

## Credits
- Bertrand Andres