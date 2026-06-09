<?php

namespace App;

class ItemDefinitions
{
    // The master list of all items in your entire RPG world
    public static $list = [
        'baseball_bat' => [
            'name'        => 'Oak Warclub',
            'type'        => 'weapon',
            'price'       => 350,
            'stat_name'   => 'Attack Power',
            'stat_value'  => 12,
            'description' => 'A carved oak club bound with leather. Powerful enough to shatter bone and send foes sprawling.'
        ],
        'leather_jacket' => [
            'name'        => 'Studded Jerkin',
            'type'        => 'armor',
            'price'       => 250,
            'stat_name'   => 'Defense Rating',
            'stat_value'  => 4,
            'description' => 'A rugged leather vest reinforced with bronze studs. Light, flexible, and ideal for street skirmishing.'
        ],
        'kevlar_vest' => [
            'name'        => 'Reinforced Brigandine',
            'type'        => 'armor',
            'price'       => 800,
            'stat_name'   => 'Defense Rating',
            'stat_value'  => 25,
            'description' => 'Layered plates sewn into heavy cloth. A veteran&#039;s armor made to weather fierce blows.',
            'available'   => true,
        ],
        'Admin Crown' => [
            'name'        => 'Admin Crown',
            'type'        => 'admin',
            'price'       => 0,
            'stat_name'   => 'Defense Rating',
            'stat_value'  => 999999999999999,
            'description' => 'The ultimate symbol of administrative power.',
            'available'   => false,
        ],
        'Beer' => [
            'name'        => 'Tankard of Ale',
            'type'        => 'consumable',
            'price'       => 3,
            'stat_name'   => 'Resolve Boost',
            'stat_value'  => 1,
            'description' => 'A hearty draught to steady the nerves and steel your resolve before the next shadowy venture.',
            'available'   => true,
        ],
    ];
}