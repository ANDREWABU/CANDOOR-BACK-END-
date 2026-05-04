<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescheduleOrCancel extends Model
{
    use HasFactory;
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'Created_Date';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'Modified_Date';
}
