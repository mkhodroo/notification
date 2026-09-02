@extends('behin-layouts.app')
@section('content')
<div class="container-fluid" dir="rtl"><div class="card"><div class="card-header bg-primary text-white"><h4>اعلان‌های من</h4></div><div class="card-body"><table class="table table-bordered"><thead><tr><th>عنوان</th><th>وضعیت</th><th>تاریخ</th><th>جزئیات</th></tr></thead><tbody>@forelse($notifications as $notification)<tr><td>{{ $notification->title }}</td><td>{{ $notification->seen_at ? 'دیده شده' : 'جدید' }}</td><td>{{ $notification->created_at }}</td><td><a class="btn btn-sm btn-primary" href="{{ route('notifications.show', $notification) }}">مشاهده</a></td></tr>@empty<tr><td colspan="4">اعلانی وجود ندارد.</td></tr>@endforelse</tbody></table>{{ $notifications->links() }}</div></div></div>
@endsection
