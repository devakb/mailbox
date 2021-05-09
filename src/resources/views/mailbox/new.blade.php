@extends('layouts.app')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="container my-5">
        <div class="row justify-content-between">
            <div class="col-md-3">
                @include('mailbox.partials.sidemenu')
            </div>
            <div class="col-md-8">
                <h5><b>New Message</b></h5>
                <div class="box py-2">
                    <div class="card my-2">
                        <div class="card-body">
                           <form action="{{ route('mailbox.newmessage.send') }}" method="POST">
                                @csrf
                                @method('PUT')
                               <div class="form-group">
                                   <label>Recipient</label>
                                   <select class="form-control select2 @error('user') is-invalid @enderror" name="user">
                                        <option value="" hidden disabled selected>-- Choose Recipient --</option>
                                        @foreach ($users as $id => $user_email)
                                            <option value="{{ $id }}" @if(old('user') == $id) selected @endif>{{ $user_email }}</option>
                                        @endforeach
                                   </select>
                                   @error('user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                   @enderror
                               </div>

                               <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" value="{{ old('subject') }}" name="subject">
                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                              </div>

                              <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" id="ckeditor" placeholder="Message" name="message">{{ old('message') }}</textarea>
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

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
    $('.select2').select2();
    CKEDITOR.replace( 'ckeditor', {
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
