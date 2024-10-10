<div class="modal-header text-white">
    <h5 class="modal-title">
        <i class="fas fa-info-circle"></i> Detail Group Menu
    </h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <i class="fas fa-list"></i> Informasi Group Menu
            </h5>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td>{{ $groupMenu->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Sequence</th>
                        <td>{{ $groupMenu->sequence }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Icon</th>
                        <td>{{ $groupMenu->icon }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fas fa-times"></i> Close
    </button>
</div>
