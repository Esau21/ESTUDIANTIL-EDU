@include('commom.modalHead')

<div class="container">
    <div class="card">
        <div class="card-header bg-dark">
            <h6 class="text-center text-uppercase text-white">Crear | Carrera</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="name" class="form-control"
                            placeholder="Ingresar nombre de la carrera">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea wire:model.lazy="descripcion" class="form-control" placeholder="Ingresa una descripcion"></textarea>
                        @error('descripcion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('commom.modalFooter')
