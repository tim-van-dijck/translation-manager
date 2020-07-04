<?php

namespace App\Entities;

use App\Traits\HandleToJson;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

/**
 * Class Language
 * @package App\Entities
 * @property int id
 * @property bool admin
 * @property string key
 * @property string name
 */
class Language implements Arrayable, \ArrayAccess, Jsonable, \JsonSerializable
{
    use HandleToJson;

    /** @var string */
    private $key;
    /** @var string */
    private $name;
    /** @var bool */
    private $admin;

    /**
     * Translation constructor.
     * @param string $key
     * @param bool $admin
     */
    public function __construct(string $key, bool $admin)
    {
        $this->key = $key;
        $this->name = trans("language.$key");
        $this->admin = $admin;
    }

    public function toArray(): array
    {
        return [
            'admin' => $this->admin,
            'key' => $this->key,
            'name' => $this->name,
        ];
    }
}