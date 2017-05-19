<?php
/**
 * Created by PhpStorm.
 * User: carapuce
 * Date: 19/05/17
 * Time: 11:18
 */

namespace Efrogg\Briks\Converters;


class BriksJsonConverter extends BriksArrayConverter
{
    public function setData($data)
    {
        parent::setData(json_decode($data));
    }

}