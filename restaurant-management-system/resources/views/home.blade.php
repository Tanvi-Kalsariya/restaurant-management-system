@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}
                <button type="submit" class="btn btn-primary"> Add Country </button>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Short Name</th>
                        </tr>
                    </thead>

                    @foreach ($data as $item)
                    <!--?php //print_r($data);exit;? -->

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td> {{ $item['country'] }} </td>
                                <td> {{ $item['shourt_code'] }} </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
