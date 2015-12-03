<?php

class CmbReinfo extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $succeed;

    /**
     *
     * @var string
     */
    protected $cono;

    /**
     *
     * @var string
     */
    protected $billno;

    /**
     *
     * @var double
     */
    protected $amount;

    /**
     *
     * @var integer
     */
    protected $date;

    /**
     *
     * @var string
     */
    protected $merchant_para;

    /**
     *
     * @var string
     */
    protected $swift_number;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field succeed
     *
     * @param string $succeed
     * @return $this
     */
    public function setSucceed($succeed)
    {
        $this->succeed = $succeed;

        return $this;
    }

    /**
     * Method to set the value of field cono
     *
     * @param string $cono
     * @return $this
     */
    public function setCono($cono)
    {
        $this->cono = $cono;

        return $this;
    }

    /**
     * Method to set the value of field billno
     *
     * @param string $billno
     * @return $this
     */
    public function setBillno($billno)
    {
        $this->billno = $billno;

        return $this;
    }

    /**
     * Method to set the value of field amount
     *
     * @param double $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Method to set the value of field date
     *
     * @param integer $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Method to set the value of field merchant_para
     *
     * @param string $merchant_para
     * @return $this
     */
    public function setMerchantPara($merchant_para)
    {
        $this->merchant_para = $merchant_para;

        return $this;
    }

    /**
     * Method to set the value of field swift_number
     *
     * @param string $swift_number
     * @return $this
     */
    public function setSwiftNumber($swift_number)
    {
        $this->swift_number = $swift_number;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field succeed
     *
     * @return string
     */
    public function getSucceed()
    {
        return $this->succeed;
    }

    /**
     * Returns the value of field cono
     *
     * @return string
     */
    public function getCono()
    {
        return $this->cono;
    }

    /**
     * Returns the value of field billno
     *
     * @return string
     */
    public function getBillno()
    {
        return $this->billno;
    }

    /**
     * Returns the value of field amount
     *
     * @return double
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns the value of field date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the value of field merchant_para
     *
     * @return string
     */
    public function getMerchantPara()
    {
        return $this->merchant_para;
    }

    /**
     * Returns the value of field swift_number
     *
     * @return string
     */
    public function getSwiftNumber()
    {
        return $this->swift_number;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cmb_reinfo';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmbReinfo[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmbReinfo
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
