<?php

namespace App\Http\Livewire;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\Nota;
use App\Models\Profesor;
use Livewire\Component;
use Livewire\WithPagination;

class NotasController extends Component
{
    use WithPagination;

    public $nota1, $nota2,  $nota3, $nota4, $promedio, $estudiante_id, $profesor_id, $materia_id, $carrera_id, $pageTitle, $componentName, $selected_id, $search;
    private $pagination = 4;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->pageTitle = 'Notas';
        $this->componentName = 'Listado';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $notas = Nota::join('estudiantes as estu', 'estu.id', 'notas.estudiante_id')
                ->join('profesors as profe', 'profe.id', 'notas.profesor_id')
                ->join('materias as mate', 'mate.id', 'notas.materia_id')
                ->join('carreras as carre', 'carre.id', 'notas.carrera_id')
                ->select('notas.*', 'estu.nombre as nombre', 'profe.nombre as name', 'mate.nombre as matename', 'carre.name as nombrecarre')
                ->where('estu.nombre', 'LIKE', '%' . $this->search . '%')
                ->orWhere('profe.nombre', 'LIKE', '%' . $this->search . '%')
                ->orWhere('carre.name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('mate.nombre', 'LIKE', '%' . $this->search . '%')
                ->orderBy('notas.promedio', 'DESC')
                ->paginate($this->pagination);
        else
            $notas = Nota::join('estudiantes as estu', 'estu.id', 'notas.estudiante_id')
                ->join('profesors as profe', 'profe.id', 'notas.profesor_id')
                ->join('materias as mate', 'mate.id', 'notas.materia_id')
                ->join('carreras as carre', 'carre.id', 'notas.carrera_id')
                ->select('notas.*', 'estu.nombre as nombre', 'profe.nombre as name', 'mate.nombre as matename', 'carre.name as nombrecarre')
                ->where('estu.nombre', 'LIKE', '%' . $this->search . '%')
                ->orWhere('profe.nombre', 'LIKE', '%' . $this->search . '%')
                ->orWhere('carre.name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('mate.nombre', 'LIKE', '%' . $this->search . '%')
                ->orderBy('notas.promedio', 'DESC')
                ->paginate($this->pagination);
        return view('livewire.nota.nota', [
            'notas' => $notas, 'estu' => Estudiante::orderBy('nombre', 'DESC')->get(), 'profe' => Profesor::orderBy('nombre', 'ASC')->get(),
            'carre' => Carrera::orderBy('name', 'DESC')->get(), 'mate' => Materia::orderBy('nombre', 'DESC')->get()
        ])
            ->extends('layouts.theme.plantilla')
            ->section('content');
    }


    public function resetUI()
    {
        $this->nota1 = '';
        $this->nota2 = '';
        $this->nota3 = '';
        $this->nota4 = '';
        $this->promedio = '';
        $this->estudiante_id = '';
        $this->profesor_id = '';
        $this->materia_id = '';
        $this->carrera_id = '';
        $this->selected_id = 0;
    }


    public function Store()
    {
        $rules = [
            'nota1' => 'required',
            'nota2' => 'required',
            'nota3' => 'required',
            'nota4' => 'required',
            'promedio' => 'required',
            'estudiante_id' => 'required',
            'profesor_id' => 'required',
            'materia_id' => 'required',
            'carrera_id' => 'required',
        ];

        $messages = [
            'nota1.required' => 'La nota no puede quedar vacia',
            'nota2.required' => 'La nota no puede quedar vacia',
            'nota3.required' => 'La nota no puede quedar vacia',
            'nota4.required' => 'La nota no puede quedar vacia',
            'promedio.required' => 'El promedio no puede quedar vacio',
            'estudiante_id.required' => 'Tienes que seleccionar un alumno',
            'profesor_id.required' => 'Tienes que seleccionar un profesor',
            'materia_id' => 'Tienes que seleccionar una materia',
            'carrera_id' => 'Tienes que seleccionar una carrera',
        ];

        $this->validate($rules, $messages);


        $notas = Nota::create([
            'nota1' => $this->nota1,
            'nota2' => $this->nota2,
            'nota3' => $this->nota3,
            'nota4' => $this->nota4,
            'promedio' => $this->promedio,
            'estudiante_id' => $this->estudiante_id,
            'profesor_id' => $this->profesor_id,
            'materia_id' => $this->materia_id,
            'carrera_id' => $this->carrera_id,
        ]);

        $notas->save();

        $this->resetUI();
        $this->emit('msgok');
    }


    public function Edit($id)
    {
        $notas = Nota::find($id, ['id', 'nota1', 'nota2', 'nota3', 'nota4', 'promedio', 'estudiante_id', 'profesor_id', 'materia_id', 'carrera_id']);
        $this->selected_id = $notas->id;
        $this->nota1 = $notas->nota1;
        $this->nota2 = $notas->nota2;
        $this->nota3 = $notas->nota3;
        $this->nota4 = $notas->nota4;
        $this->promedio = $notas->promedio;
        $this->estudiante_id = $notas->estudiante_id;
        $this->profesor_id = $notas->profesor_id;
        $this->materia_id = $notas->materia_id;
        $this->carrera_id = $notas->carrera_id;

        $this->emit('show-modal');
    }

    public function EditarNota($id)
    {
        $notas = Nota::find($id, ['id', 'nota1', 'nota2', 'nota3', 'nota4', 'promedio', 'estudiante_id', 'profesor_id', 'materia_id', 'carrera_id']);
        $this->selected_id = $notas->id;
        $this->nota1 = $notas->nota1;
        $this->nota2 = $notas->nota2;
        $this->nota3 = $notas->nota3;
        $this->nota4 = $notas->nota4;
        $this->promedio = $notas->promedio;
        $this->estudiante_id = $notas->estudiante_id;
        $this->profesor_id = $notas->profesor_id;
        $this->materia_id = $notas->materia_id;
        $this->carrera_id = $notas->carrera_id;
    }


    public function Update()
    {
        $rules = [
            'nota1' => 'required',
            'nota2' => 'required',
            'nota3' => 'required',
            'nota4' => 'required',
            'promedio' => 'required',
            'estudiante_id' => 'required',
            'profesor_id' => 'required',
        ];

        $messages = [
            'nota1.required' => 'La nota no puede quedar vacia',
            'nota2.required' => 'La nota no puede quedar vacia',
            'nota3.required' => 'La nota no puede quedar vacia',
            'nota4.required' => 'La nota no puede quedar vacia',
            'promedio.required' => 'El promedio no puede quedar vacio',
            'estudiante_id.required' => 'Tienes que seleccionar un alumno',
            'profesor_id.required' => 'Tienes que seleccionar un profesor',
        ];

        $this->validate($rules, $messages);


        $notas = Nota::find($this->selected_id);

        $notas->update([
            'nota1' => $this->nota1,
            'nota2' => $this->nota2,
            'nota3' => $this->nota3,
            'nota4' => $this->nota4,
            'promedio' => $this->promedio,
            'estudiante_id' => $this->estudiante_id,
            'profesor_id' => $this->profesor_id,
        ]);

        $this->resetUI();
        $this->emit('msg-update', 'Actualizado');
    }

    public function calculateAverage()
    {
        $sumaNotas = $this->nota1 + $this->nota2 + $this->nota3 + $this->nota4;
        $this->promedio = $sumaNotas / 4;
    }

    public function calcularNotaId($id)
    {
        $sumaNotas = Nota::find($id, ['id', 'nota1', 'nota2', 'nota3', 'nota4', 'promedio', 'estudiante_id', 'profesor_id', 'materia_id', 'carrera_id']);
        $this->selected_id = $sumaNotas->id;
        $this->estudiante_id = $sumaNotas->estudiante_id;
        $this->profesor_id = $sumaNotas->profesor_id;
        $this->materia_id = $sumaNotas->materia_id;
        $this->carrera_id = $sumaNotas->carrera_id;
        $sumaNotas = $this->nota1 + $this->nota2 + $this->nota3 + $this->nota4;
        $this->promedio = $sumaNotas / 4;
    }



    public function Destroy($id)
    {
        Nota::destroy($id);

        return redirect()->route('nota.index');
    }
}
