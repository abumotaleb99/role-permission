@if(session('success'))
<div class="alert alert-success alert-dismissible fade show hide-message" role="alert" data-hide-timeout="5000">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show hide-message" role="alert" data-hide-timeout="5000">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var messagesContainer = document.getElementById('messages-container');

        if (messagesContainer) {
            var hideMessages = messagesContainer.querySelectorAll('.hide-message');

            hideMessages.forEach(function (message) {
                var hideTimeout = parseInt(message.getAttribute('data-hide-timeout'));

                if (!isNaN(hideTimeout)) {
                    setTimeout(function () {
                        message.classList.add('d-none');
                    }, hideTimeout);
                }
            });
        }
    });
</script>