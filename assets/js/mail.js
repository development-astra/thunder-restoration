
$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            // change the URL to your actual endpoint
            url: 'http://134.199.195.8:5000/send_email/v1/thunder_restoration',
            // url: 'https://0pbj0xnp-4848.asse.devtunnels.ms/send_email/v1/thunder_restoration',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result) {
                console.log('=== AJAX SUCCESS ===');
                console.log('Full result:', result);
                console.log('Type of result:', typeof result);
                console.log('result.success:', result.success);
                
                if (result.success) {
                    console.log('Redirecting to thank-you.html');
                    window.location.href = 'thank-you.html';
                } else {
                    console.log('Redirecting to form-error.html (result.success is falsy)');
                    window.location.href = 'form-error.html';
                }
            },
            error: function(xhr) {
                // Redirect to error page on failure
                window.location.href = 'form-error.html';
            }
        });
    });
});