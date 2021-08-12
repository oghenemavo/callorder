@extends('layouts.app')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Merchant Dashboard</h4>
            <div class="nk-block-des">
                <p>Upload most recent <strong>Inventory</strong> & preview list of uploaded inventory</p>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">

            <form action="{{ route('supermarket.upload.inventory') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="customFileLabel">Inventory</label>
                    <div class="form-control-wrap">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">upload inventory</button>
            </form>
        </div>
    </div><!-- .card-preview -->

    <div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Inventory</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->inventory_file }}</td>
                            <td>{{ $inventory->created_at->format('D, d M Y H:i a') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
@endsection