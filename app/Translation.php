<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Translation
 *
 * @property int id
 * @property int key_id
 * @property string language
 * @property string translation
 * @property string created_at
 * @property string updated_at
 */
class Translation extends Model
{
    protected $fillable = ['language', 'key_id', 'translation'];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function key()
    {
        return $this->belongsTo(TranslationKey::class, 'key_id');
    }
}
