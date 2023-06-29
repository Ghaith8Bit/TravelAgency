<!-- jQuery -->
<script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('dashboard/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var icon = document.getElementById('switch-icon');
        var savedColor = localStorage.getItem('iconColor');
        if (savedColor === '#00BFFF') {
            icon.classList.add('fa-sun');
            icon.style.color = '#00BFFF';
            document.body.style.backgroundImage = "url('{{ asset('dashboard/dist/img/backgroundBlue.jpg') }}')";
        } else {
            icon.classList.add('fa-moon');
            icon.style.color = '#9370DB';
            document.body.style.backgroundImage =
                "url('{{ asset('dashboard/dist/img/backgroundPurple.jpg') }}')";
        }
        document.body.classList.add('fade-in');
    });

    function toggleIcon() {
        var icon = document.getElementById('switch-icon');
        var body = document.body;
        if (icon.classList.contains('fa-moon')) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            icon.style.color = '#00BFFF';
            body.classList.remove('fade-in');
            setTimeout(function() {
                body.style.backgroundImage = "url('{{ asset('dashboard/dist/img/backgroundBlue.jpg') }}')";
                body.classList.add('fade-in');
            }, 500);
            localStorage.setItem('iconColor', '#00BFFF');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            icon.style.color = '#9370DB';
            body.classList.remove('fade-in');
            setTimeout(function() {
                body.style.backgroundImage = "url('{{ asset('dashboard/dist/img/backgroundPurple.jpg') }}')";
                body.classList.add('fade-in');
            }, 500);
            localStorage.setItem('iconColor', '#9370DB');
        }
    }
</script>
