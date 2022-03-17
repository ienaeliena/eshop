                        @extends('layouts.admin')

                        @section('content')
                        <div class="row p-1">&nbsp;</div>
                        <div class="card mx-3">
                            <div class="card-header">
                                <h4>Registered User </h4>
                                <hr>

                            </div>
                            <div class="card-body">
                                <table class="table table-primary table-bordered table-striped">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $item->id }} </td>
                                            <td>{{ $item->name.' '.$item->lname }} </td>
                                            <td>{{ $item->email }} </td>
                                            <td>{{ $item->phone }} </td>
                                            <td>
                                                <a href="{{ url('view-user/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        @endsection

                        @section('scripts')

                        @endsection
