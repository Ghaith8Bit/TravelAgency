  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('dist/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('dist/lib/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('dist/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('dist/lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('dist/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('dist/lib/tempusdominus/js/moment.min.js') }}"></script>
  <script src="{{ asset('dist/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
  <script src="{{ asset('dist/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('dist/js/main.js') }}"></script>

  <!-- Toastify Javascript -->
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  @if (session('toastify'))
      <script>
          Toastify({
              text: '{{ session('toastify.text') }}',
              className: '{{ session('toastify.className') }}',
              duration: 2000,
          }).showToast();
      </script>
  @endif
