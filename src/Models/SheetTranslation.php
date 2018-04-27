<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\SheetTranslationSaved;
use Mazhurnyy\Events\SheetTranslationDeleting;

/**
 * @property int $id
 * @property int $delivery_id
 * @property string $locale
 * @property string $title
 */
class SheetTranslation extends Model
{

    protected $table = 'sheet_translations';
    /**
     * @var array
     */
    protected $fillable = ['sheet_id', 'locale', 'title', 'preview', 'text', 'keywords', 'description'];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved'    => SheetTranslationSaved::class,
        'deleting' => SheetTranslationDeleting::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sheet()
    {
        return $this->belongsTo('Mazhurnyy\Models\Sheet', 'id', 'sheet_id');
    }

}
