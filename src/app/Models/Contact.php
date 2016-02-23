<?php
namespace Mc388\SimpleCms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 *
 * @package Mc388\SimpleCms\App\Models
 */
class Contact extends Model
{
    protected $fillable = [
        'name',
        'street',
        'postal_code',
        'city',
        'phone',
        'mobile',
        'fax',
        'email',
    ];
}
