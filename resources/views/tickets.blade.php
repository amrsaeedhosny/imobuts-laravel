@extends("layouts.header")

@section('header')
    <div class="row">
        <div class="col-md-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Label</th>
                <th></th>
            </tr>
            </thead>
            @foreach($tickets as $ticket)
                <form action="{{route('change_ticket',['ticketID'=>$ticket->id])}}">
                    <tr>
                        <th>{{$ticket->id}}</th>
                        <td>{{$ticket->label}}</td>
                        <td>
                            <button class="btn btn-default">
                                Change
                            </button>
                        </td>
                    </tr>
                </form>
            @endforeach
        </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Available</th>
                    <th>Expired</th>
                </tr>
                </thead>
                <tr>
                    <th>{{$available_tickets}}</th>
                    <td>{{count($tickets) - $available_tickets}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection