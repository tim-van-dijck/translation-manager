<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Translation
 *
 * @property int id
 * @property string language
 * @property string key
 * @property string translation
 * @property string created_at
 * @property string updated_at
 * @property App[] apps
 */
class Translation extends Model
{
    protected $fillable = ['language', 'key', 'translation'];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function apps()
    {
        return $this->belongsToMany(App::class);
    }
}
