<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\ExtensionDeleting;
use Mazhurnyy\Events\ExtensionSaved;

/**
 * @property int $id
 * @property string $title
 * @property string $note
 * @property string $updated_at
 */
class Extension extends Model
{

    protected $table = 'extensions';

    protected $dispatchesEvents = [
        'saved' =>ExtensionSaved::class,
        'deleting' => ExtensionDeleting::class,
    ];
    /**
     * @var array
     */
    protected $fillable = ['name', 'note'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleryFiles()
    {
        return $this->hasMany('Mazhurnyy\Models\File');
    }

}