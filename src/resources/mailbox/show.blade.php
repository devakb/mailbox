@extends('layouts.app')

@section('content')

    <div class="container my-5">
        <div class="row justify-content-between">
            <div class="col-md-3">
                @include('mailbox.partials.sidemenu')
            </div>
            <div class="col-md-8">
                <div class="box">

                    <div class="card my-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 my-2">
                                    <b>From : <span class="text-info">{{ $message->sender->email }}</span></b> <br>
                                    <b>To : <span class="text-info">{{ $message->recipient->email }}</span></b> <br>
                                    <b>Subject : <span class="text-info">{{ $message->subject }}</span></b> <br>
                                </div>
                                <div class="col-md-6 my-2">
                                    <b>Date : <span class="text-info">{{ $message->created_at->format('F d, Y') }}</span></b> <br>
                                    <b>Time : <span class="text-info">{{ $message->created_at->format('h:i:s A') }}</span></b> <br>
                                </div>
                            </div>
                            <hr>
                            <p>{!! $message->message !!}</p>
                        </div>
                    </div>

                    <br>

                    <div class="card my-2">
                        <div class="card-body">
                            <form action="{{ route('mailbox.reply', $message->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Reply Message</label>
                                    <textarea class="form-control" id="ckeditor" data-height="300px" placeholder="Message" name="message">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                  </div>

                                  <br>

                                  <button type="submit" class="btn btn-success">Send</button>
                            </form>
                        </div>
                    </div>

                    <br>


                    <h5><b>Replies ({{ $message->replies->count() }})</b></h5>
                    @foreach ($message->replies as $reply_message)


                        <div class="card my-2">
                            <div class="card-body">
                                <b>From : <span class="text-info">{{ $reply_message->respondent->email }}</span> <span class="text-primary">(@if($reply_message->respondent->id == $message->sender->id) Sender @else Receiver @endif)</span> </b>
                                <hr>
                                <div>
                                    {!! $reply_message->message !!}
                                </div>
                                <div class="float-right small text-muted">
                                    {{ $reply_message->created_at->format('F d, Y h:i:s A') }}
                                </div>
                            </div>
                        </div>


                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'ckeditor', {
        height: 150,
        toolbar: [

                    { name: 'styles', items: ['Format'] },

                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },

                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },

                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList'] },

                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor', 'HorizontalRule' ] },

                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source'] },

                ],
    });
</script>
@endsection
