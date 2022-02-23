@extends('layouts.app')

@section('content')
    <div class="relative flex items-top justify-center  bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <button type="button" class="btn btn-primary btn-lg" id="app-get_lucky">Get Lucky</button>
            <button type="button" class="btn btn-primary btn-lg" id="app-get_history">History</button>
            <form id="init" action="{{route('generateNewLink',['link' => $link])}}" method="post" >
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">Get New Link</button>
            </form>
            <form id="deactivate" action="{{route('deactivate',['link' => $link])}}" method="post" >
                @csrf
                <button type="submit" class="btn btn-secondary btn-lg">Deactivate Link</button>
            </form>
    </div>



        <div>
            <h4  style = "text-align: center" id="fun-result"></h4>
        </div>
        <table class="table" >
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Summa</th>
                <th scope="col">Status</th>
                <th scope="col">Random</th>
                <th scope="col">User hash</th>
            </tr>
            </thead>
            <tbody class="tbody" id="history_tbody">
            </tbody>
        </table>
@stop

@section ('body_scripts')
 @include ('home.ajax')
@stop
