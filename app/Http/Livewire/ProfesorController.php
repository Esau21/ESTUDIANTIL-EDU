<?php

namespace App\Http\Livewire;

use App\Models\Estudiante;
use App\Models\Profesor;
use Livewire\Component;
use Livewire\WithPagination;

class ProfesorController extends Component
{

    use WithPagination;

    public $nombre, $apellidos, $estudiante_id, $selected_id, $pageTitle, $componentName, $search;
    private $pagination = 3;
    protected $paginationTheme = 'bootstrap';

    public function mount() 
    {
        $this->pageTitle = 'Profesores';
        $this->componentName = 'Listado';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $profesor = Profesor::join('estudiantes as estu', 'estu.id', 'profesors.estudiante_id')
            ->select('profesors.*', 'estu.nombre as nombre_estudiante')
            ->where('profesors.nombre', 'LIKE', '%' . $this->search . '%')
            ->orWhere('profesors.apellidos', 'LIKE', '%' . $this->search . '%')
            ->orWhere('estu.nombre', 'LIKE', '%' . $this->search . '%')
            ->orderBy('profesors.nombre', 'ASC')
            ->paginate($this->pagination);
        else 
            $profesor = Profesor::join('estudiantes as estu', 'estu.id', 'profesors.estudiante_id')
            ->select('profesors.*', 'estu.nombre as nombre_estudiante')
            ->where('profesors.nombre', 'LIKE', '%' . $this->search . '%')
            ->orWhere('profesors.apellidos', 'LIKE', '%' . $this->search . '%')
            ->orWhere('estu.nombre', 'LIKE', '%' . $this->search . '%')
            ->orderBy('profesors.nombre', 'ASC')
            ->paginate($this->pagination);
        return view('livewire.profesor.profe', ['profesor' => $profesor, 'estu' => Estudiante::orderBy('nombre', 'ASC')->get()])
        ->extends('layouts.theme.plantilla')
        ->section('content');
    }


    public function resetUI() 
    {
        $this->nombre = '';
        $this->apellidos = '';
        $this->estudiante_id = '';
        $this->selected_id = 0;
    }


    public function Store() 
    {
        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required',
            'estudiante_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'El nombre es requerido',
            'apellidos.required' => 'Los apellidos son requeridos',
            'estudiante_id' => 'Seleeciona al estudiante'
        ];

        $this->validate($rules, $messages);


        $profesor = Profesor::create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'estudiante_id' => $this->estudiante_id,
        ]);

        $profesor->save();

        $this->resetUI();
        $this->emit('msgok', 'Agregado');
    }

    public function Edit($id) 
    {
        $profesor = Profesor::find($id, ['id','nombre','apellidos','estudiante_id']);
        $this->selected_id = $profesor->id;
        $this->nombre = $profesor->nombre;
        $this->apellidos = $profesor->apellidos;
        $this->estudiante_id = $profesor->estudiante_id;


        $this->emit('show-modal');
    }

    public function Update() 
    {
        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required',
            'estudiante_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'El nombre es requerido',
            'apellidos.required' => 'Los apellidos son requeridos',
            'estudiante_id' => 'Seleeciona al estudiante'
        ];

        $this->validate($rules, $messages);

        $profesor = Profesor::find($this->selected_id);

        $profesor->update([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'estudiante_id' => $this->estudiante_id,
        ]);

        $this->resetUI();
        $this->emit('msg-update', 'Actualizado');
    }



    public function Destroy($id)
    {
        Profesor::destroy($id);


        return redirect()->route('profesor.index');

    }
}
