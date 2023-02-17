<div class="container pt-4">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h6 class="text-white text-uppercase text-center">{{ $pageTitle }} | {{ $componentName }}</h6>
            </div>
            <div class="card-body">
                <h6>
                    <a class="btn btn-outline-dark" style="position: relative" href="javascript:void(0)" data-toggle="modal"
                        data-target="#theModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            <path fill-rule="evenodd"
                                d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Agregar</a>
                </h6>
                <span>
                    @include('commom.searchbox')
                </span>

                <div class="table-responsive">
                    <table class="table table table-striped table-bordered">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th>ID</th>
                                <th class="text-center" style="background: #3E54AC">NOTA-1</th>
                                <th class="text-center" style="background: #3F979B">NOTA-2</th>
                                <th class="text-center" style="background: #F94A29">NOTA-3</th>
                                <th class="text-center" style="background: #FB2576">NOTA-4</th>
                                <th class="text-center" style="background: #FBDF07">PROMEDIO</th>
                                <th>ESTUDIANTE</th>
                                <th>PROFESOR</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notas as $e)
                                <tr>
                                    <td>{{ $e->id }}</td>
                                    <td class="text-center text-white" style="background: #3E54AC">
                                        <input disabled wire:change="Edit({{$e}})" type="number"
                                            class="form-control" value="{{ $e->nota1 }}">
                                    </td>
                                    <td class="text-center text-white" style="background: #3F979B">
                                        <input disabled wire:change="Edit({{$e}})" type="number"
                                            class="form-control" value="{{ $e->nota2 }}">
                                    </td>
                                    <td class="text-center text-white" style="background: #F94A29">
                                        <input disabled wire:change="Edit({{$e}})" type="number"
                                            class="form-control" value="{{ $e->nota3 }}">
                                    </td>
                                    <td class="text-center text-white" style="background: #FB2576">
                                        <input disabled wire:change="Edit({{$e}})"  type="number"
                                            class="form-control" value="{{ $e->nota4 }}">
                                    </td>
                                    <td class="text-center text-dark" style="background: #FBDF07">
                                        <input  disabled type="number"
                                            class="form-control"  value="{{ $e->promedio }}">
                                    </td>
                                    <td>{{ $e->nombre }}</td>
                                    <td>{{ $e->name }}</td>
                                    <td>
                                        @if ($selected_id < 1)
                                        <a href="javascript:void(0)" wire:click="Edit({{$e->id}})"
                                            class="btn btn-outline-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        @endif
                                       <form action="{{ route('nota.destroy', $e->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </button>
                                        </form> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $notas->links() }}
            </div>
            @include('livewire.nota.form')
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('msgok', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('msg-update', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('msgok', msg => {
            $('#theModal').modal('hide')
        });
    });
    function Confirm(id) 
    {
       swal({
        title: 'CONFIRMAR',
        text: '¿DESEAS ELIMINAR EL REGISTRO?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false
    },
    function() {
        console.log('ID', id);
        window.livewire.emit('deleteRow', id)    
        //toastr.success('info', 'Registro eliminado con éxito')
        swal.close()  
    })
    }
    
</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>