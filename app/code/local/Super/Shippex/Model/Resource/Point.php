<?php

/**
 * Class Super_Shippex_Model_Resource_Point
 */
class Super_Shippex_Model_Resource_Point extends Mage_Core_Model_Resource_Db_Abstract
{
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_CODE = 'code';
    const FIELD_STREET = 'street';
    const FIELD_NUMBER = 'number';
    const FIELD_CITY = 'city';
    const FIELD_POSTCODE = 'postcode';

    const LENGTH = 'length';

    /**
     * @var array
     */
    private static $fieldResultCache = [];

    protected function _construct()
    {
        $this->_init('shippex/point', self::FIELD_ID);
    }

    private static function _getFieldsMap()
    {
        return [
            self::FIELD_ID => [

            ],
            self::FIELD_NAME => [
                self::LENGTH => 60,
            ],
            self::FIELD_CODE => [
                self::LENGTH => 10
            ],
            self::FIELD_STREET => [
                self::LENGTH => 40
            ],
            self::FIELD_NUMBER => [
                self::LENGTH => 20
            ],
            self::FIELD_CITY => [
                self::LENGTH => 40
            ],
            self::FIELD_POSTCODE => [
                self::LENGTH => 10
            ]
        ];
    }

    /**
     * @param $field_code
     * @return bool
     */
    public static function getFieldLength($field_code)
    {
        $key = __FUNCTION__ . "_" . $field_code;

        if (array_key_exists($key, self::$fieldResultCache)) {
            return self::$fieldResultCache[$key];
        }

        $map = self::_getFieldsMap();
        $result = false;
        if (isset($map[$field_code], $map[$field_code][self::LENGTH])) {
            $result = $map[$field_code][self::LENGTH];
        }
        return self::$fieldResultCache[$key] = $result;
    }
}