<?php
namespace Efrogg\Briks\Converters;


class BriksJsonConverter extends BriksArrayConverter
{
    public function setData($data)
    {
        parent::setData(json_decode($data));
    }

}