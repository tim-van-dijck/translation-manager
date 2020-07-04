<?php

namespace App\Models;

use App\Models\App;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class TranslationKey
 * @property int id
 * @property string key
 * @property Collection apps
 * @property Collection translations
 */
class TranslationKey extends Model
{
    protected $fillable = ['key'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function apps()
    {
        return $this->belongsToMany(App::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(Translation::class, 'key_id');
    }
}
