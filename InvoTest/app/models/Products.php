<?php
/**
 * Created by PhpStorm.
 * User: zhixin
 * Date: 2015/11/11
 * Time: 13:42
 */
use Phalcon\Mvc\Model;

class Products extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $product_type_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $price;

    /**
     * @var string
     */
    public $active;

    /**
     *  Products initializer
     */
    public function initialize()
    {
        $this->belongsTo(
            'product_types_id',
            'ProductTypes',
            'id',
            array(
                'reusable' => true
            ));
    }

    /**
     *  Returns a human representation of 'active'
     *
     * @return string
     */
    public function getActiveDetail()
    {
        if($this->active == 'Y'){
            return 'Yes';
        }
        return 'No';
    }
}
