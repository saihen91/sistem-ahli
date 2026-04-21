<!DOCTYPE html>
<html>
<head>
    <title>Sistem Ahli</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert (optional nanti) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Sistem Ahli
        </a>

        <!-- Menu -->
        <div class="d-flex gap-3">

            <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'fw-bold' : '' }}"
               href="{{ route('dashboard') }}">
                Dashboard
            </a>

            <a class="nav-link text-white {{ request()->routeIs('anggota.*') ? 'fw-bold' : '' }}"
               href="{{ route('anggota.index') }}">
                Anggota
            </a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-link nav-link text-white" style="display:inline; border:none;">
                    Logout
                </button>
            </form>

        </div>

    </div>
</nav>


<div class="container mt-4">

    {{-- Alert --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</div>


<script>
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {

        let form = this.closest('form');

        Swal.fire({
            title: 'Padam data?',
            text: "Data tidak boleh dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, padam!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });
});
</script>

<script>
function showToast(icon, message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 2500
    });
}
</script>

{{-- SUCCESS ALERT --}}
@if(session('success'))
<script>
console.log('toast trigger');
showToast('success', @json(session('success')));
</script>
@endif




</body>
</html>
