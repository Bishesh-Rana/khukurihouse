@push('scripts')
    <script>
        function lobiboxMessage(msg, type = 'success') {
            Lobibox.notify(type, {
                size: 'mini',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                width: 400,
                rounded: true,
                msg: msg,
                delay: 3000,
                delayIndicator: false,
            });
        }
    </script>
@endpush

@if ($message = Session::get('success'))
    @push('scripts')
        <script>
            $(document).ready(function() {
                lobiboxMessage("{{ $message }}", 'success');
            })
        </script>
    @endpush

@endif

@if ($message = Session::get('subscribe-success'))
    @push('scripts')
        <script>
            $(document).ready(function() {
                lobiboxMessage("{{ $message }}", 'success');
            })
        </script>
    @endpush

@endif

@if ($message = Session::get('seller-success'))
    @push('scripts')

        <script>
            $(document).ready(function() {
                lobiboxMessage("{{ $message }}", 'success');
            })
        </script>
    @endif
    @if ($message = Session::get('status'))
        @push('scripts')
            <script>
                $(document).ready(function() {
                    lobiboxMessage("{{ $message }}", 'info');
                })
            </script>
        @endpush
    @endif
    @if ($message = Session::get('error-message'))
        <script>
            $(document).ready(function() {
                lobiboxMessage("{{ $message }}", 'error');
            })
        </script>
    @endif

    @if ($message = Session::get('login-error'))
        <script>
            $(document).ready(function() {
                console.log('here');
                lobiboxMessage("{{ $message }}", 'error');
            })
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @push('scripts')
                <script>
                    $(document).ready(function() {
                        lobiboxMessage("{{ $error }}", 'error');
                    })
                </script>
            @endpush
        @endforeach
    @endif
