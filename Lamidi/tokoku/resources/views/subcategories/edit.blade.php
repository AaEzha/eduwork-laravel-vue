<div class="modal right fade" id="editsection{{$section->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('sections.update',$section->id)}}" method="post" encrypt="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <label for="">Section Name</label>
                        <input type="text" name="section_name" id="" value="{{$section->section_name}}" class="form-control">
                    </div>
                    <div class="form-row">
                        <label for="">Section Status</label>
                        <input type="checkbox" name="section_status" {{$section->status== 1 ?  'checked':''}}>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-pimary btn-block">
                            Update
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