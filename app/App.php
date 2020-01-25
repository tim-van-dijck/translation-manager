<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class App
 *
 * @property int id
 * @property string name
 * @property string created_at
 * @property string updated_at
 * @property Collection translations
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
        return $this->belongsToMany(TranslationKey::class);
    }
}
