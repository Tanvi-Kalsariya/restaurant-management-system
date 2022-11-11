@extends('layouts.app')

@section('content')
    <div id="loader"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="" method="GET" class="addCountry">
                    @csrf
                    {{-- @method('GET') --}}

                    <div class="form-group search-group">
                        <div class="btn-wrapper">
                            <a href="{{ route('addCountry') }}"><button type="button" class="btn btn-primary"
                                    id="btnAddCountry" onclick="hideLoader()"> Add Country </button></a>
                        </div>
                        <div class="input-group country-search-bar">
                            <div class="form-outline">
                                {{-- <input type="search" id="search" name="search" class="form-control"
                                    value=" {{ request('search') }} " /> --}}
                                {{-- <input type="search" name="search" id="search" class="form-control" placeholder="Search..." value=" {{ $search }} "> --}}
                                <input type="search" name="search" id="search" class="form-control"
                                    placeholder="Search...">
                            </div>
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> <br>

                {{-- Country list table --}}
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Country</th>
                            <th scope="col">Country code</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    @foreach ($country as $item)
                        <tbody>
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td> {{ $item['country'] }} </td>
                                <td> {{ $item['country code'] }} </td>
                            </tr>
                        </tbody>
                    @endforeach

                    <tbody id="searched-country"></tbody>
                </table>
                {{-- Pagination code --}}
                {{-- <div class="d-flex justify-content-center">
                    {!! $country->links() !!}
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- Hide loader code --}}
    <script>
        $('#loader').hide();

        function hideLoader(e) {

            $('#loader').show();
            $.ajax({
                type: "GET",
                url: '{{ route('addCountry') }}',
                data: {
                    format: 'json'
                },
                success: function(response) {
                    console.log(response);
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    url: {{ route('serchCountry') }},
                    type: 'get',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        console.log(data);
                        $('#searched-country').html(data);
                    }
                });
            });
        });
    </script>
@endsection
