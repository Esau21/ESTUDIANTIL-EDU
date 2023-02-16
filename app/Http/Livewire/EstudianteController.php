<?php

namespace App\Http\Livewire;

use App\Models\Estudiante;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Expr\FuncCall;

class EstudianteController extends Component
{

    public $nombre, $apellido, $carnet, $selected_id, $pageTitle, $componentName, $search;
    private $pagination = 3;
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

    public function mount()
    {
        $this->pageTitle = 'Estudiantes';
        $this->componentName = 'Listado';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $estudiantes = Estudiante::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->select('estudiantes.*')
                ->orWhere('apellido', 'LIKE', '%' . $this->search . '%')
                ->orWhere('carnet', 'LIKE', '%' . $this->search . '%')
                ->orderBy('nombre', 'ASC')
                ->paginate($this->pagination);
        else
            $estudiantes = Estudiante::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->select('estudiantes.*')
                ->orWhere('apellido', 'LIKE', '%' . $this->search . '%')
                ->orWhere('carnet', 'LIKE', '%' . $this->search . '%')
                ->orderBy('nombre', 'ASC')
                ->paginate($this->pagination);
        return view('livewire.estudiante.estudiantes', ['estudiantes' => $estudiantes])
            ->extends('layouts.theme.plantilla')
            ->section('content');
    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->apellido = '';
        $this->carnet = '';
        $this->selected_id = 0;
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'carnet' => 'required'

        ];

        $messages = [
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El apellido es requerido',
            'carnet.required' => 'El carnet es requerido'
        ];

        $this->validate($rules, $messages);

        $estudiantes = Estudiante::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'carnet' => $this->carnet,
        ]);

        $estudiantes->save();

        $this->resetUI();
        $this->emit('msgok', 'Agregado');
    }

    public function Edit($id)
    {
        $estudiantes = Estudiante::find($id, ['id', 'nombre', 'apellido', 'carnet']);
        $this->selected_id = $estudiantes->id;
        $this->nombre = $estudiantes->nombre;
        $this->apellido = $estudiantes->apellido;
        $this->carnet = $estudiantes->carnet;


        $this->emit('show-modal');
    }

    public function Update()
    {
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'carnet' => 'required'

        ];

        $messages = [
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El apellido es requerido',
            'carnet.required' => 'El carnet es requerido'
        ];

        $this->validate($rules, $messages);

        $estudiantes = Estudiante::find($this->selected_id);
        $estudiantes->update([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'carnet' => $this->carnet,
        ]);

        $this->resetUI();
        $this->emit('msg-update', 'Actualizado');
    }


    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id)
    {
        Estudiante::destroy($id);

        return redirect()->route('estudiante.index');
    }
}
