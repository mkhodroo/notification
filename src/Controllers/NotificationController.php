<?php

namespace UserNotification\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UserNotification\Models\UserNotification;
use UserNotification\Services\NotificationService;

class NotificationController extends Controller
{
    public function index() { return view('UserNotificationViews::index', ['notifications' => UserNotification::where('user_id', Auth::id())->whereNull('archived_at')->latest()->paginate(20)]); }
    public function show(UserNotification $notification) { $this->owned($notification); return view('UserNotificationViews::show', compact('notification')); }
    public function count() { return response()->json(['count' => UserNotification::where('user_id', Auth::id())->whereNull('archived_at')->whereNull('seen_at')->count()]); }
    public function mine() { return response()->json(UserNotification::where('user_id', Auth::id())->whereNull('archived_at')->latest()->paginate(20)); }
    public function all() { return response()->json(UserNotification::whereNull('archived_at')->latest()->paginate(50)); }
    public function store(Request $request, NotificationService $service)
    {
        $data = $request->validate(['user_id' => ['nullable','integer','min:1'], 'user_ids' => ['nullable','array','min:1'], 'user_ids.*' => ['integer','min:1'], 'title' => ['required','string','max:255'], 'body' => ['required','string'], 'link' => ['nullable','url','max:2048']]);
        $ids = $data['user_ids'] ?? (isset($data['user_id']) ? [$data['user_id']] : []);
        if (!$ids) return response()->json(['message' => 'حداقل یک کاربر لازم است.'], 422);
        return response()->json(['created' => $service->create($ids, $data['title'], $data['body'], $data['link'] ?? null)], 201);
    }
    public function seen(UserNotification $notification) { $this->owned($notification); $notification->update(['seen_at' => $notification->seen_at ?: now()]); return response()->json(['seen_at' => $notification->seen_at]); }
    public function archive(UserNotification $notification) { $this->owned($notification); $notification->update(['archived_at' => now()]); return response()->json(['message' => 'اعلان بایگانی شد.']); }
    public function details(UserNotification $notification) { $this->owned($notification); return response()->json($notification); }
    private function owned(UserNotification $notification): void { abort_unless($notification->user_id === Auth::id(), 403); }
}
