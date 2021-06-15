@extends('master')
@section('content')

    <section class="phones">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>All Phone Numbers</h1>

                    <div class="filters">
                        <div class="col-md-4 country">
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <select name="country" id="country" class="form-control">
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Uganda">Uganda</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 state">
                            <div class="form-group">
                                <label for="Phone State">Phone State</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="">Select Phone State</option>
                                    <option value="valid">Valid Phone Numbers</option>
                                    <option value="invalid">InValid Phone Numbers</option>                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    @include('layouts.table')
                    {{ $numbers->links() }}
                </div>
            </div>
        </div>

    </section>

@endsection

@section('scripts')
    <script>
        const config = {
            routes: {
                filternumbersRoute: "{{ route('filter-numbers') }}", 
                paginationRoute: "{{ route('pagination-route') }}"
            },

            token: "{{ csrf_token() }}"
        };
    </script>
    <script src="{{asset('assets/js/app.js')}}"></script>
@endsection