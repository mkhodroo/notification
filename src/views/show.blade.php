@extends('behin-layouts.app')
@section('content')
<div class="container" dir="rtl"><div class="card"><div class="card-header"><h4>{{ $notification->title }}</h4></div><div class="card-body"><p style="white-space:pre-wrap">{{ $notification->body }}</p>@if($notification->link)<a href="{{ $notification->link }}" target="_blank" rel="noopener" class="btn btn-primary">بازکردن لینک</a>@endif</div></div></div>
<script>fetch('{{ route('api.notifications.seen', $notification) }}',{method:'POST',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content}});</script>
@endsection
