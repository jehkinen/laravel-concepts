<?php
namespace Concepts\InvokableFactoryValidator;

enum ProductType: string
{
    case ONE_TIME_PRODUCT = 'OneTimeProduct';
    case RECURRING_MEMBERSHIP = 'RecurringMembership';
    case CONSULTING = 'Consulting';
}
