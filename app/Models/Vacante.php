<?php

namespace App\Models;

use App\Models\User;
use App\Models\Salario;
use App\Models\Candidato;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacante extends Model
{
    use HasFactory;

    protected $casts = ['ultimoDia' => 'date:d-m-Y'];

    protected $fillable=[

        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimoDia',
        'descripcion',
        'imagen',
        'user_id'

    ];

    //estas funciones son para decirle a laravel que categoria_id y salario_id pertenecen a otros modelos y de esta forma poder relacionarlos cuando vayamos a mostrar la informacion de una vacante en especifico,pues queremos mostrar los valores de esos datos y hasta el momento solo muestran los ids. De esta forma en la vista de mostrar-vacante.blade lo que hacemos es llamar a estos metodos y asi podemos acceder a los campos de categoria y salario de las respectivas tablas de la bd.
    public function categoria(){

        //con belongsTo() indicamos que esta funcion pertenece al modelo de Categoria
        return $this->belongsTo(Categoria::class);
    }

    public function salario(){

        //con belongsTo() indicamos que esta funcion pertenece al modelo de Categoria
        return $this->belongsTo(Salario::class);
    }

    public function candidatos(){

        return $this->hasMany(Candidato::class)->orderBy('created_at','DESC');
    }

    public function reclutador(){

        return $this->belongsTo(User::class,'user_id');
    }
}
