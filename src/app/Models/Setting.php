<?php
namespace Mc388\SimpleCms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 *
 * @package Mc388\SimpleCms\App\Models
 */
class Setting extends Model
{
    protected $fillable = [
        'website_title',
        'google_analytics_id',
    ];
}
