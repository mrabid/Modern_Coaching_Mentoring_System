@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sessions for {{ $mentee->name }}</h1>

    @if($sessions->isEmpty())
        <p>No sessions found for this mentee.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                    <tr>
                        <td>{{ $session->start_time->format('Y-m-d H:i') }}</td>
                        <td>{{ $session->end_time->format('Y-m-d H:i') }}</td>
                        <td>{{ ucfirst($session->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('mentor.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
</div>
@endsection
