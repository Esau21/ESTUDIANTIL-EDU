</div>
<div class="modal-footer">
    <button type="button" wire:click.prevent="resetUI()" class="btn btn-danger close-btn" data-dismiss="modal">Close</button>
    @if ($selected_id < 1)
    <button type="button" wire:click.prevent="Store()" class="btn btn-primary">Save</button>
    @else 
    <button type="button" wire:click.prevent="Update()" class="btn btn-primary">Update</button>
    @endif
</div>
</div>
</div>
</div>
