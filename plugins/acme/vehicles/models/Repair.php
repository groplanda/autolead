<?php namespace Acme\Vehicles\Models;

use Model;

/**
 * Model
 */
class Repair extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_vehicles_repair';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasOne = [
      'user' => 'RainLab\User\Models\User'
    ];

    protected $jsonable = ['spare_parts'];

    public $attachMany = [
      'images' => ['System\Models\File', 'delete' => true ]
    ];

    public $belongsTo = [
      'vehicle' => \Acme\Vehicles\Models\Vehicle::class
    ];

    public function afterDelete() {
      foreach ($this->images as $image) {
          $image->delete();
      }
    }
}
