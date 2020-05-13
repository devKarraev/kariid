<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserMessage;
use App\Http\Requests\HomeMessageUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var UserMessage
     */
    private $userMessage;

    /**
     * HomeController constructor.
     *
     * @param UserMessage $userMessage
     */
    public function __construct(
        UserMessage $userMessage
    ) {
        $this->userMessage = $userMessage;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userMessages = $this->userMessage->getAllWithPaginate(5);
        return view('admin.home', compact('userMessages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $userMessage = UserMessage::findOrFail($id);
       return view('admin.edit', compact('userMessage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(HomeMessageUpdateRequest $request, $id)
    {
        $data = $request->input();
        $entity = UserMessage::findOrFail($id);
        $entity->is_edited = 1;
        $entity->timestamps = false;
        $result = $entity->update($data);

        if ($result) {
            return redirect()->route('admin.index')->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения']);
        }
    }

    /**
     * Accept user message.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptMessage($id)
    {
        $message = UserMessage::findOrFail($id);
        $message->status = 'approved';
        $message->update();
        if ($message) {
            return redirect()->route('admin.index')->with(['success' => 'Успешно опубликовано']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения']);
        }
    }

    /**
     * Cancel user message.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelMessage($id)
    {
        $message = UserMessage::findOrFail($id);
        $message->status = 'canceled';
        $message->update();
        if ($message) {
            return redirect()->route('admin.index')->with(['success' => 'Успешно отклонено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения']);
        }
    }

    /**
     * Search by request entities in UserMessage model.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchMessage(Request $request)
    {
        $userMessages = UserMessage::query()
            ->where('user_name', 'LIKE', "%{$request->search}%")
            ->orWhere('user_email', 'LIKE', "%{$request->search}%")
            ->paginate(5);

        return view('admin.home', compact('userMessages'));
    }
}
