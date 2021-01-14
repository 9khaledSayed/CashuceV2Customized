<?php


namespace App\Http\Controllers\Dashboard;


use App\Feedback;
use App\Http\Controllers\Controller;
use App\Notifications\FeedbackReceived;
use Illuminate\Http\Request;


class FeedbackController extends Controller
{
    public function create()
    {
        return view('dashboard.feedbacks.create');
    }

    public function store(Request $request)
    {
        Feedback::create($this->validateFeedback());

        request()->user()->notify(new FeedbackReceived($request->message));

        return redirect('/dashboard/feedbacks/create')
            ->with('message', 'Email Sent');
    }

    public function show(Feedback $feedback)
    {
        return view('dashboard.feedbacks.show', compact('feedback'));
    }

    public function validateFeedback()
    {
        return request()->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'message' => 'required',
        ]);
    }
}