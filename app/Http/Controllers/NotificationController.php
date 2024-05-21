<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer les notifications de l'utilisateur actuel
        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        // Marquer les notifications comme lues
        $user->unreadNotifications->markAsRead();

        // Afficher la vue des notifications
        return view('notification', ['notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /**
 * Display the specified resource.
 */
/**
 * Display the specified resource.
 */
public function show(Notification $notification)
{
    // Retrieve notifications for the current user
    $user = Auth::user();
    $notifications = $user->unreadNotifications;

    // Mark notifications as read
    $user->unreadNotifications->markAsRead();

    // Pass notifications data to the view along with the specific notification
    return view('notification', [
        'notifications' => $notifications,
        'notification' => $notification
    ]);
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
