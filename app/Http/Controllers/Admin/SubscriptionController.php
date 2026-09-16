<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = Subscription::latest()->paginate(20);
        $unreadCount = Subscription::unread()->count();
        $readCount = Subscription::read()->count();
        $contactedCount = Subscription::contacted()->count();
        
        return view('admin.subscriptions.index', compact('subscriptions', 'unreadCount', 'readCount', 'contactedCount'));
    }

    public function show(Subscription $subscription)
    {
        if ($subscription->status === 'unread') {
            $subscription->update(['status' => 'read']);
        }
        
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function updateStatus(Request $request, Subscription $subscription)
    {
        $request->validate([
            'status' => 'required|in:unread,read,contacted'
        ]);

        $subscription->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully.');
    }

    public function updateNotes(Request $request, Subscription $subscription)
    {
        $request->validate([
            'admin_notes' => 'nullable|string'
        ]);

        $subscription->update(['admin_notes' => $request->admin_notes]);

        return back()->with('success', 'Notes updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return back()->with('success', 'Subscription deleted successfully.');
    }

    public function markAllRead()
    {
        Subscription::unread()->update(['status' => 'read']);

        return back()->with('success', 'All subscriptions marked as read.');
    }
}
