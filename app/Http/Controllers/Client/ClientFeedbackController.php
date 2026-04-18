<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use App\Models\Feedback;
use App\Models\FeedbackPhoto;
use App\Services\AdminService;

class ClientFeedbackController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $titlePage = __('system.feedback');
        $feedbacks = Feedback::with('feedbackPhotos')->orderBy('created_at','desc')->paginate(15);
        $totalFeedback = Feedback::count();
        $avgFeedback = Feedback::avg('rating');
        $stats = Feedback::selectRaw('rating, COUNT(*) as total')->groupBy('rating')->pluck('total', 'rating');
        return view('client.feedback',[
            'titlePage' => $titlePage,
            'feedbacks' => $feedbacks,
            'totalFeedback' => $totalFeedback,
            'avgFeedback' => $avgFeedback,
            'stats' => $stats
        ]);
    }

    public function feedback(Request $request){
        $user = auth()->user();
        $name = $request->name_feedback;
        $title = $request->title_feedback;
        $rating = $request->rating;
        $content = $request->feedback;
        $imageFeedbacks = $request->file('image_feedback');
        $userAgent = $request->userAgent();
        $today = Carbon::today();
        $facebook_id = '';

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => __('system.name') . ' ' . __('system.not_empty')
            ]);
        }

        if (empty($title)) {
            return response()->json([
                'success' => false,
                'message' => __('system.title') . ' ' . __('system.not_empty')
            ]);
        }

        if (empty($content)) {
            return response()->json([
                'success' => false,
                'message' => __('system.feel') . ' ' . __('system.not_empty')
            ]);
        }

        $exists = Feedback::where('user_agent', $userAgent)->where('feedback_date', $today)->exists();

        if ($user && $user->role === 'user') {
            $facebook_id = $user->facebook_id;
            $exists = Feedback::where('facebook_id', $facebook_id)
                ->where('feedback_date', $today)
                ->exists();
        } else {
            $exists = Feedback::where('user_agent', $userAgent)
                ->where('feedback_date', $today)
                ->exists();
        }

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => __('system.rated')
            ]);
        }

        $feedback = new Feedback();
        $feedback->name = $name;
        $feedback->title = $title;
        $feedback->content = $content;
        $feedback->rating = $rating;
        $feedback->user_agent = $userAgent;
        $feedback->feedback_date = now()->toDateString();
        $feedback->facebook_id = $facebook_id;
        $feedback->save();

        if(!empty($imageFeedbacks)){
            foreach ($imageFeedbacks as $file) {
                if ($file->isValid()) {
                    $nameFile = $file->getClientOriginalName();
                    $typeFile = $file->getClientOriginalExtension();
                    $nameOnly = pathinfo($nameFile, PATHINFO_FILENAME);
                    $newNameFile = time() . '_' . $nameOnly . '.' . $typeFile;
                    if (app()->environment('local')) {
                        $uploadDir = public_path('storage/feedbacks/');
                    } else {
                        $uploadDir = base_path('../public_html/storage/feedbacks/');
                    }
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $file->move($uploadDir, $newNameFile);
                    $fileFeedbackPhoto = new FeedbackPhoto();
                    $fileFeedbackPhoto->image = $newNameFile;
                    $fileFeedbackPhoto->feedback_id = $feedback->id;
                    $fileFeedbackPhoto->save();
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => __('system.thanks')
        ]);
            
    }
}
