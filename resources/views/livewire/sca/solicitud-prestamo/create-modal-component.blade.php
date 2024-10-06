<div>
    <button wire:click="create" class="btn btn-primary float-right" style="font-size: 18 !important;">+</button>
    @if($isOpen)
        @php
            $fechaActual = date('d-m-Y');
        @endphp
        <div class="modal show" tabindex="-1" role="dialog" style="display:block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-bg-dark" >
                    <div class="modal-header">
                        <h5 class="modal-title">Solicitud Prestamo</h5>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="store">
                            <div class="form-group">
                                <label for="fs_create" class="strong">Fecha Solicitud:</label><h5 class="btn">{{$fechaActual}}</h5>
                            </div>
                            <div class="form-group">
                                <label for="body">Post Body</label>
                                <textarea class="form-control" id="body" rows="4" placeholder="Enter post body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">
                              Save
                            </button>
                            <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
