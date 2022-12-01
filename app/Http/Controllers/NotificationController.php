<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\NotificationType;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user();
        $notifications = $user->notifications()->orderBy('id','desc')->paginate(20);
        return view('notifications.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notificationTypes = NotificationType::all();
        return view('notifications.create',compact('notificationTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        $user = $this->user();
        $data_request = $request->only((new Notification)->getFillable());
        $user->notifications()->create($data_request);
        return response()->redirectToRoute('notifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user();
        $notification = $user->notifications()->findOrFail($id);
        $notificationTypes = NotificationType::all();
        return view('notifications.edit',compact('notification','notificationTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, $id)
    {
        $user = $this->user();
        $notification = $user->notifications()->findOrFail($id);
        $data_request = $request->only($user->notifications()->getFillable());
        $notification->update($data_request);
        return response()->redirectToRoute('notifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->delete();
        return response()->redirectToRoute('notifications.index');
    }
}
