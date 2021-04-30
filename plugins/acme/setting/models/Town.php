<?php namespace Acme\Setting\Models;

use Model;

/**
 * Model
 */
class Town extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_setting_towns';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
