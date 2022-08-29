<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Mail\SendMailManager;
use App\Repositories\FeedbackRepository;
use App\Services\FeedbackService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    private $feedbackServices;
    private $feedbackRepository;

    public function __construct(FeedbackService $FeedbackServices, FeedbackRepository $FeedbackRepository)
    {
        $this->feedbackServices = $FeedbackServices;
        $this->feedbackRepository = $FeedbackRepository;
    }

    public function index()
    {
        $feedback = $this->feedbackRepository->getAll();

        return view(
            'feedback.list',
            [
                'feedback' => $feedback
            ]
        );
    }

    public function create()
    {
        $lastFeedback = $this->feedbackRepository->lastFeedback();

        if (!empty($lastFeedback)) {
            $lastFeedbackDate = Carbon::createFromFormat('Y-m-d H:i:s', $lastFeedback);
        } else {
            $lastFeedbackDate = '';
        }

        if ($lastFeedback) {
            $lastFeedbackCheck = ($lastFeedback < date('Y-m-d H:i:s', strtotime('-1day'))) ? 'true' : 'false';
        } else {
            $lastFeedbackCheck = 'true';
        }

        return view(
            'feedback.create',
            [
                'lastFeedback'      => $lastFeedbackDate,
                'lastFeedbackCheck' => $lastFeedbackCheck
            ]
        );
    }

    public function store(StoreRequest $request)
    {
        $feedback = $this->feedbackServices->create($request);

        $this->sendMail($feedback);

        return redirect()->back()->with('message', 'Ваш запрос был отправлен');
    }

    public function update($id)
    {
        $this->feedbackServices->update($id);

        return redirect()->back()->with('message', 'Запрос был помечен как "Ответ отправлен"');
    }

    private function sendMail($feedback)
    {
        Mail::to('info@wood-gears.com')->send(new SendMailManager($feedback));

        return view('mails.manager');
    }
}
