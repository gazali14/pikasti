<x-layout-admin :selectedKader='$selectedKader'>
    <div class="p-3 min-h-screen">
        <div class="mt-5">
            <!-- Grafik Jumlah Kader -->
            <x-grafik-admin />
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            @endif
        });
    </script>
</x-layout-admin>
