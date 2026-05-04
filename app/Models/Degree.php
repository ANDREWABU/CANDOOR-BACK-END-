<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
class Degree extends Model
{
    use HasFactory;
    use Sluggable;


    protected $fillable = [
        'name',
        'UserID',
        'Slug'
    ];

    public function sluggable(): array
    {
        return [
            'Slug' => [
                'source' => 'name'
            ]
        ];
    }
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
