<?php

namespace App\Http\Controllers\Dashboard;

use App\Comblaint;
use App\Company;
use App\Notifications\FeedbackReceived;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComblaintController extends Controller
{

    public function create()
    {
        return view('dashboard.feedbacks.create');
    }


    public function store(Request $request)
    {
        $feedback = Comblaint::create($this->validateFeedback());

        Company::find(1)->notify(new FeedbackReceived($request->message, $feedback->id));

        return redirect('/dashboard/feedbacks/create')
            ->with('message', 'Email Sent');
    }

    public function show(Comblaint $feedback)
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
