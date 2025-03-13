<?php
namespace Concepts\InvokableFactoryValidator;

use Concepts\InvokableFactoryValidator\Validators\ConsultingValidator;
use Concepts\InvokableFactoryValidator\Validators\OneTimeProductValidator;
use Concepts\InvokableFactoryValidator\Validators\RecurringMembershipValidator;

class ProductTypeValidatorFactory
{
    public static function build(ProductType $productType): string
    {
        return match($productType)
        {
            ProductType::ONE_TIME_PRODUCT => OneTimeProductValidator::class,
            ProductType::CONSULTING => ConsultingValidator::class,
            ProductType::RECURRING_MEMBERSHIP => RecurringMembershipValidator::class,
        };
    }
}
