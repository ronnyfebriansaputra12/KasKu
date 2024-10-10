@extends('layouts.be_master')

@section('title', $title)

@section('main-content')
    <div class="content-input"></div>
    <div class="card">
        <div class="card-header" style="display: flex; align-items: center; justify-content: space-between;">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: none; margin-bottom: 0;">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Group Menu</li>
                </ol>
            </nav>
            <h6 style="margin-right: 150px;"><span class="text-semibold">Group Menu List</span></h6>
            <button type="button" class="btn btnCreate" data-toggle="modal" data-target=".modal-right"
                style="background-color: #2A6CA2;"><span class="fe fe-24 fe-plus small"></span><span
                    class="small text-muted"> Add
                    New</span></button>
        </div>
        <div class="table-responsive">
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="datatable-header mb-3"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="flex-grow: 1;"></div>
                            <div style="display: flex; align-items: center;">
                                <div class="dataTables_length"></div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover group-menu-list">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Sequence</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-right modal-slide " tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document" style="width: 70%; max-height: 100vh;">
            <div class="modal-content create-modal">

            </div>
        </div>
    </div>
    <div class="modal fade modal-right-detail modal-slide" id="detailModal" tabindex="-1" role="dialog"
        aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width: 70%; max-height: 100vh;">
            <div class="modal-content detail-modal">
                <!-- Konten detail modal akan dimuat di sini dari AJAX -->
            </div>
        </div>
    </div>

    <div class="modal fade modal-right-edit modal-slide" id="editModal" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width: 70%; max-height: 100vh;">
            <div class="modal-content edit-modal">
                <!-- Konten detail modal akan dimuat di sini dari AJAX -->
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .table.group-menu-list tbody tr td:last-child {
            text-align: center;
        }
    </style>
@endpush

@push('script-append')
    <script src="{{ asset('js/pages/configuration/group_menu.js') }}?v=1.0"></script>
@endpush
