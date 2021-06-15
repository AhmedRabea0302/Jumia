<section class="table-blade">
    <div class="numbers">
        <div class="row">
            <div class="col-me-12">
                          
                <div class="col-md-8">
                    <table class="table table-bordered table-hover numbers-table">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>State</th>
                                <th>Country Code</th>
                                <th>Phone Num</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach ($numbers as $num)
                                <tr>
                                    <td>{{ $num->country ?? '' }}</td>
                                    <td>{{ $num->state }}</td>
                                    <td>+{{ $num->code }}</td>
                                    <td>{{ $num->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
    
            </div>
        </div>
    </div>
    
</section>