<?php namespace Acme\Setting\Models;

use Model;

/**
 * Model
 */
class Faq extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SimpleTree;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;
    const SORT_ORDER = 'sort_order';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_setting_faq';

    /**
     * @var array Validation rules
     */
    public $rules = [
      'question' => 'required|min:3|max:100',
      'answer' => 'required|min:3'
    ];
}
