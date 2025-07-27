@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg p-4">
    @if(session('success'))
        <div class="bg-green-100 p-3 mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 p-3 mb-4">{{ session('error') }}</div>
    @endif

    <a href="{{ route('google.auth') }}" class="btn btn-primary mb-4">Connect Google</a>

    <form action="{{ route('interview.schedule') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="candidate_id" class="block font-semibold">Select Candidate</label>
            <select name="candidate_id" required class="w-full border p-2 rounded">
                <option value="">-- Select Candidate --</option>
                @foreach(\App\Models\User::all() as $candidate)
                    <option value="{{ $candidate->id }}">{{ $candidate->name }} ({{ $candidate->email }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="scheduled_at" class="block font-semibold">Scheduled Date & Time</label>
            <input type="datetime-local" name="scheduled_at" required class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="btn btn-success">Schedule Interview</button>
    </form>
</div>
@endsection
