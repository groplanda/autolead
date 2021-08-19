<?php namespace Acme\Setting\Models;

use Model;

/**
 * Model
 */
class Message extends Model
{
  use \October\Rain\Database\Traits\Validation;
  use \October\Rain\Database\Traits\Sortable;
  use \October\Rain\Database\Traits\SimpleTree;

    const SORT_ORDER = 'sort_order';
    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_setting_message';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
