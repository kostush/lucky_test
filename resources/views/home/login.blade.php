@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class ="row">
            <div class="col-md-6 ofset-md-4">
                <div class="card">
                    <div class="card-header">
                        Registration
                    </div>
                    <div class="card-body">
                        <form action="" method ="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">name</label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop


