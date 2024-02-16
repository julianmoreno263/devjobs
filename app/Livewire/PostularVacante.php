<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Notifications\NuevoCandidato;

class PostularVacante extends Component
{

    use WithFileUploads;
    
    public $cv;
    public $vacante;

    protected $rules=[

        'cv'=>'required|mimes:pdf'
    ];

    public function mount(){

        $this->vacante=$vacante;
    }

    public function postularme(){

        $datos=$this->validate();

        //Almacenar el cv
        $cv=$this->cv->store('public/cv');
        $datos['cv']=str_replace('public/cv/',"",$cv);


        //crear el candidato a la vacante
        $this->vacante->candidatos()->create([

            'user_id'=>auth()->user()->id,
            'cv'=>$datos['cv']
        ]);


        //crear notificacion y enviar email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id,$this->vacante->titulo,auth()->user()->id));

        //mostrar al usuario un mensaje de que se envio correctamente
        session()->flash('mensaje', 'Se ha enviado la información correctamente, mucha suerte!');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
