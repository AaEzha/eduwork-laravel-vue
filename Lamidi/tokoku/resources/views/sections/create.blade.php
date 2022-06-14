<div class="modal fade" id="addsection" wire:ignore.self data-backdrop="static">
    <div class="modal-dialog right-crud modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h3>Add New Section</h3>
                </div>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store" action="#" method="post" encrypt="multipart/form-data" autocomplete="off">
                    @csrf
                    @forelse ($addmore as $more)
                    <div class="form-row">
                        <td class="col-md-5">
                            <label for="">Section Name</label>
                            <input type="text" wire:model="section_name.{{$more}}" class="form-control" autocomplete="off">
                            @error('section_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </td>
                        <td class="col-sm-1" data-bs-toggle="tooltip" data-placement="top" title="status[]">
                            <label class="switch"> Status</label>
                            <input type="checkbox" wire:model="section_status.{{$more}}">
                        </td>
                        <td class="col-sm-1">
                            <button class="btn-success btn-sm" style="margin-top: 10px;" wire:ignore wire:click.prevent="addmore">
                                <i class="fa fa-plus"></i>
                            </button>
                            @if($loop->index>0)
                            <button class="btn-danger btn-sm" style="margin-top: 10px;" wire:ignore wire:click.prevent="remove({{$loop->index}})">
                                <i class="fa fa-minus"></i>
                            </button>
                            @endif
                        </td>
                    </div>
                    @empty
                    @endforelse
                    <div class="modal-footer">
                        <button type="submit" class="btn-pimary btn-block">
                            Create Section
                        </button>
                        <button type="button" class="btn-danger btn-block" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>