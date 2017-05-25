<?php

namespace App;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('App\User');
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
