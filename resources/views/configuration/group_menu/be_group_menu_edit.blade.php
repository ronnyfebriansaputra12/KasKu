<div class="modal-header">
    <h5 class="modal-title" id="defaultModalLabel">Edit Group Menu</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="post" action="" id="frmCreate" class="needs-validation" novalidate>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $groupMenu->name }}" required>
                    <div class="valid-feedback"> Looks good! </div>
                </div>
            </div> <!-- /.col -->
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <div class="form-group mb-3">
                        <label for="sequence">Sequence</label>
                        <input type="number" class="form-control" id="sequence" name="sequence" value="{{ $groupMenu->sequence }}"  required>
                        <div class="valid-feedback"> Looks good! </div>
                    </div>
                </div>
            </div> <!-- /.col -->
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <div class="form-group mb-3">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon"
                            placeholder="fe fe-24 fe-plus" value="{{ $groupMenu->icon }}" required>
                        <div class="valid-feedback"> Looks good! </div>
                    </div>
                </div>
            </div> <!-- /.col -->
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn mb-2 btn-info btnUpdat">Save</button>
</div>
