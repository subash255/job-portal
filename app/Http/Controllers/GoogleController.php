<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleController extends Controller
{
    private function getClient()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-client-secret.json'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setRedirectUri(route('google.callback'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        return $client;
    }

    public function redirectToGoogle()
    {
        return redirect($this->getClient()->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = $this->getClient();
        $token = $client->fetchAccessTokenWithAuthCode($request->code);
        session(['google_token' => $token]);
        return redirect()->route('interview.form')->with('success', 'Google Connected!');
    }

    public function showForm()
    {
        return view('interview-form');
    }

    public function scheduleInterview(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:users,id',
            'scheduled_at' => 'required|date|after:now',
        ]);

        $client = $this->getClient();
        $client->setAccessToken(session('google_token'));
        if ($client->isAccessTokenExpired()) {
            return redirect()->route('google.auth')->with('error', 'Google session expired.');
        }

        $service = new Google_Service_Calendar($client);

        $startDateTime = new \DateTime($request->scheduled_at);
        $endDateTime = (clone $startDateTime)->modify('+1 hour');

        $candidate = \App\Models\User::findOrFail($request->candidate_id);

        $event = new Google_Service_Calendar_Event([
            'summary' => 'Interview with ' . $candidate->name,
            'start' => ['dateTime' => $startDateTime->format(\DateTime::RFC3339), 'timeZone' => 'Asia/Kathmandu'],
            'end' => ['dateTime' => $endDateTime->format(\DateTime::RFC3339), 'timeZone' => 'Asia/Kathmandu'],
            'attendees' => [['email' => $candidate->email]],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid(),
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
        ]);

        $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

        // Save interview with meet link
        Interview::create([
            'user_id' => $candidate->id,
            'company_id' => auth()->id(),
            'scheduled_at' => $request->scheduled_at,
            'meet_link' => $createdEvent->hangoutLink,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Interview scheduled with Meet link created!');
    }

    public function listInterviews()
    {
        $interviews = Interview::where('company_id', auth()->id())
                        ->orderBy('scheduled_at', 'desc')
                        ->get();

        return view('interviews-list', compact('interviews'));
    }
}

