<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\StatusTranslationSaved;
use Mazhurnyy\Events\StatusTranslationDeleting;

/**
 * @property int $id
 * @property int $entities_id
 * @property string $locale
 * @property string $title
 * @property string $preview
 * @property string $text
 * @property string $keywords
 * @property string $description
 */
class StatusTranslation extends Model
{

    protected $table = 'status_translations';
    /**
     * @var array
     */
    protected $fillable = ['status_id', 'locale', 'title'];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved'    => StatusTranslationSaved::class,
        'deleting' => StatusTranslationDeleting::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('Mazhurnyy\Models\Status', 'id', 'status_id');
    }
}
