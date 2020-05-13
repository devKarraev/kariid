<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontendCreateMessage;
use App\Models\UserMessage;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * @var UserMessage
     */
    private $userMessage;

    /**
     * IndexController constructor.
     *
     * @param UserMessage $userMessage
     */
    public function __construct(
        UserMessage $userMessage
    ) {
        $this->userMessage = $userMessage;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function execute()
    {
        $paginator = $this->userMessage->getApprovedWithPaginate(5);
        return view('welcome', compact('paginator'));
    }

    /**
     * Create new message.
     *
     * @param FrontendCreateMessage $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createMessage(FrontendCreateMessage $request)
    {
        $imageName = null;
        if ($request->file('image')) {
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeas('uploads', $imageName, 'public');
        }
        $data = [
            'user_name'    => $request->input('user_name'),
            'user_email'   => $request->input('user_email'),
            'image_path'   => $imageName,
            'message_text' => $request->input('message_text'),
            'created_at'   => DB::raw('CURRENT_TIMESTAMP')
        ];
            $result = $this->userMessage->insert($data);

        if ($result) {
            return back()->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения']);
        }
    }
}
