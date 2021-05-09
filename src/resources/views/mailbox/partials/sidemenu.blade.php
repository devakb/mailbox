@once
    <section id="mailsystem_sidemenu mt-3">
        <div class="d-flex flex-column flex-wrap">
            <a href="{{ route('mailbox.newmessage') }}"class="btn {{ request()->routeIs('mailbox.newmessage') ? "btn-primary" : "btn-light" }} btn-block w-100"

                @unless(request()->routeIs('mailbox.newmessage')) style="border-color: #dae0e5;" @endunless>New Message
            </a>
            <a href="{{ route('mailbox.inbox') }}"
                class="btn {{ request()->routeIs('mailbox.inbox') ? "btn-primary" : "btn-light" }} btn-block w-100"

                @unless(request()->routeIs('mailbox.inbox')) style="border-color: #dae0e5;" @endunless>Inbox
            </a>
            <a href="{{ route('mailbox.sentbox') }}"
                class="btn {{ request()->routeIs('mailbox.sentbox') ? "btn-primary" : "btn-light" }} btn-block w-100"

                @unless(request()->routeIs('mailbox.sentbox')) style="border-color: #dae0e5;" @endunless>Sent
            </a>
        </div>
    </section>
@endonce
