<?php

namespace App\Entities;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Product
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Product whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Product whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Product whereUserId($value)
 * @mixin \Eloquent
 */
class Product extends Model implements TableInterface
{
    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }
    public function getTableHeaders()
    {
        return ['#', 'Titulo', 'Subtitulo', 'Preço', 'Usuário'];
    }

    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#' :
                return $this->id;
            case 'Titulo' :
                return $this->title;
            case 'Subtitulo' :
                return $this->subtitle;
            case 'Preço' :
                return $this->price;
            case 'Usuário' :
                return $this->user->name;
            break;
        }
    }

}
