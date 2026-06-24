import os

directories = [
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\berusaha',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\non-berusaha',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\kebijakan',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\psn',
]

script_to_inject = """
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    @php
        $holidays = [];
        try {
            $holidays = \\App\\Models\\Holiday::pluck('holiday_date')->map(fn($date) => $date->format('Y-m-d'))->toArray();
        } catch(\\Exception $e) {}
    @endphp
    <script>
        window.appHolidays = {!! json_encode($holidays) !!};
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr on all datetime-local inputs
            flatpickr('input[type="datetime-local"]', {
                enableTime: true,
                dateFormat: "Y-m-d\\\\TH:i",
                altInput: true,
                altFormat: "j F Y - H:i",
                locale: "id",
                disable: [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6);
                    },
                    ...window.appHolidays
                ]
            });
            
            flatpickr('input[type="date"]', {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "j F Y",
                locale: "id",
                disable: [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6);
                    },
                    ...window.appHolidays
                ]
            });
        });
    </script>
"""

for d in directories:
    filepath = os.path.join(d, 'show.blade.php')
    if os.path.exists(filepath):
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Avoid double inject
        if 'window.appHolidays' not in content:
            content = content.replace('</body>', script_to_inject + '\n</body>')
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Injected to {filepath}")
        else:
            print(f"Already injected in {filepath}")
