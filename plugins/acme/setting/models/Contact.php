<?php namespace Acme\Setting\Models;

use Model;

/**
 * Model
 */
class Contact extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SimpleTree;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_setting_contacts';

    protected $jsonable = ['phone', 'open'];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasOne = [
        'town' => ['Acme\Setting\Models\Town', 'key' => 'contact_id']
    ];
}
