<?php

namespace App\Entities;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Entities\Category
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model implements TableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }

    public function getTableHeaders()
    {
     return ['#', 'Nome'];
    }

    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#' :
                return $this->id;
            case 'Nome' :
                return $this->name;
            break;
        }
    }


}
