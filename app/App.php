<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class App
 *
 * @property int id
 * @property string name
 * @property string created_at
 * @property string updated_at
 * @property Translation[] translations
 */
class App extends Model
{
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function translations()
    {
        return $this->belongsToMany(Translation::class);
    }
}
