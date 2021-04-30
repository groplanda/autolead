<?php namespace Acme\Setting\Models;

use Model;

/**
 * Model
 */
class Gallery extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SimpleTree;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_setting_gallery';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'slug' => 'required',
        'title'   => 'required',
        'images'   => 'required',
        'images.*' => 'image|max:1000|dimensions:min_width=100,min_height=100'
    ];

    protected $slugs = ['slug' => 'slug'];

    public $attachMany = [
        'images' => ['System\Models\File', 'delete' => true ]
    ];

    public function afterDelete() {
        foreach ($this->images as $image) {
            $image->delete();
        }
    }
}
