    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--end::SweetAlert2-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/type.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/budget.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/settings.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/team.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/targets.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/files.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/complete.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/main.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/new-address.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->

    <!--begin::Smart Village JavaScript-->
    <script>
        // Function to format validation errors for display
        function formatValidationErrors(xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                let errorMessages = [];
                const errors = xhr.responseJSON.errors;

                Object.keys(errors).forEach(function(field) {
                    errors[field].forEach(function(message) {
                        errorMessages.push(message);
                    });
                });

                return errorMessages.join('<br>');
            }

            // Fallback to generic message
            if (xhr.responseJSON && xhr.responseJSON.message) {
                return xhr.responseJSON.message;
            }

            return 'Terjadi kesalahan saat memproses data';
        }

        // Function to show validation error with SweetAlert
        function showValidationError(xhr, title = 'Error Validasi') {
            const errorMessage = formatValidationErrors(xhr);

            Swal.fire({
                title: title,
                html: errorMessage,  // Use html instead of text to support <br>
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }

        // Removed refreshCSRFToken() - not needed for CMS
        // CSRF errors will trigger page reload instead

        // Global Session Management
        $(document).ready(function() {
            // Set up AJAX defaults
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enhanced global AJAX error handler
            $(document).ajaxError(function(event, xhr, settings) {
                console.log('AJAX Error:', xhr.status, xhr.responseJSON);

                if (xhr.status === 401) {
                    // Session expired
                    let response = xhr.responseJSON;
                    if (response && response.session_expired) {
                        Swal.fire({
                            title: 'Session Expired!',
                            text: 'Your session has expired. Redirecting to login...',
                            icon: 'warning',
                            timer: 3000,
                            timerProgressBar: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = response.redirect || '{{ route("login") }}';
                        });

                        // Auto redirect after 3 seconds
                        setTimeout(() => {
                            window.location.href = response.redirect || '{{ route("login") }}';
                        }, 3000);
                    }
                } else if (xhr.status === 419) {
                    // CSRF token mismatch - reload page to get fresh token
                    console.log('CSRF token mismatch, reloading page...');
                    
                    Swal.fire({
                        title: 'Form Kedaluwarsa!',
                        text: 'Halaman akan dimuat ulang untuk memperbarui form.',
                        icon: 'warning',
                        confirmButtonText: 'Muat Ulang',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else if (xhr.status === 422) {
                    // Validation errors - show specific field errors
                    showValidationError(xhr, 'Error Validasi');
                } else if (xhr.status >= 500) {
                    // Server errors
                    Swal.fire({
                        title: 'Server Error!',
                        text: 'Something went wrong on our server. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Enhanced session check with better error handling
            function checkSession() {
                $.ajax({
                    url: '{{ route("dashboard") }}',
                    type: 'HEAD',
                    cache: false,
                    timeout: 5000,
                    error: function(xhr) {
                        if (xhr.status === 401 || xhr.status === 419) {
                            console.log('Session expired, redirecting to login...');
                            window.location.href = '{{ route("login") }}?session_expired=1';
                        }
                    }
                });
            }

            // Check session every 5 minutes
            setInterval(checkSession, 300000);

            // Check session when page becomes visible (user switches back to tab)
            document.addEventListener('visibilitychange', function() {
                if (!document.hidden) {
                    checkSession();
                }
            });

            // Initialize basic functionalities
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Dashboard initialization
            console.log('Smart Village Dashboard initialized with enhanced session management');

            // Show session expired message if redirected from expired session
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('session_expired') === '1') {
                Swal.fire({
                    title: 'Session Expired',
                    text: 'Your session has expired. Please login again.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
    <!--end::Smart Village JavaScript-->
