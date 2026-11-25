<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('is_read')) {
            $query->where('is_read', $request->boolean('is_read'));
        }

        $messages = $query->latest()->paginate(20)->withQueryString();

        return view('pages.admin.messages.index', compact('messages'));
    }

    public function markRead(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => !$message->is_read]);
        Cache::forget('admin_sidebar_counts');

        return redirect()->back()->with('success', 'Message status updated.');
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        Cache::forget('admin_sidebar_counts');

        return redirect()->back()->with('success', 'Contact message deleted.');
    }
}
