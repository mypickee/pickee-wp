<?php
namespace TrsVendors\Dgm\Shengine\Attributes;

use Dgm\Shengine\Interfaces\IPackage;


class WeightAttribute extends \TrsVendors\Dgm\Shengine\Attributes\AbstractAttribute
{
    public function getValue(\TrsVendors\Dgm\Shengine\Interfaces\IPackage $package)
    {
        return $package->getWeight();
    }
}