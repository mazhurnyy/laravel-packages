<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $delivery_id
 * @property string $locale
 * @property string $title
 */
class MapTranslation extends Model
{

    protected $table = 'map_translations';
    /**
     * @var array
     */
    protected $fillable = ['map_id', 'locale', 'title', 'preview'];

    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /*
    public function catalog()
      {
          return $this->belongsTo('Mazhurnyy\Models\Map', 'id', 'map_id');
      }
  */
}
