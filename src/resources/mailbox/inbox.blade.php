@extends('layouts.app')

@section('content')

    <div class="container my-5">
        <div class="row justify-content-between">
            <div class="col-md-3">
                @include('mailbox.partials.sidemenu')
            </div>
            <div class="col-md-8">
                <div class="box">
                    <h5><b>In Inbox</b></h5>
                    @forelse ($inbox_messages as $message)
                        <a href="{{ route('mailbox.show', $message->id) }}" class="text-dark" style="text-decoration: none;">
                            <div class="card my-2">
                                <div class="card-body">
                                    <b>From : <span class="text-info">{{ $message->sender->email }}</span></b>
                                    <h4 class="h4">{{ $message->subject }}</h4>
                                    <b>Replies ({{ $message->replies->count() }})</b>
                                    <div class="float-right small text-muted">
                                        {{ $message->created_at->format('F d, Y h:i:s A') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="card my-2">
                            <div class="card-body text-center text-muted">
                                Inbox is empty
                            </div>
                        </div>
                    @endforelse

                    <br><br>

                    {{ $inbox_messages->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
