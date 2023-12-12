<div>
    <canvas id="userRegistrationChart" width="400" height="200"></canvas>
</div>


    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {
                const ctx = document.getElementById('userRegistrationChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            label: 'User Registrations',
                            data: @json($data),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
