@php
    $menuItems = [
        ['href' => route('admin.dashboard'), 'label' => 'Verifikasi Keluhan', 'active' => false],
        ['href' => route('admin.statistics.index'), 'label' => 'Statistik', 'active' => true],
        ['href' => route('admin.users.index'), 'label' => 'Kelola Pengguna', 'active' => false],
    ];
    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
@endphp

<x-templates.navigation-template :menu-items="$menuItems" title="Statistik Keluhan">

    {{-- Filter Periode --}}
    <x-atoms.card>
        <form method="GET" action="{{ route('admin.statistics.index') }}" class="flex items-end gap-4">
            <div>
                <x-atoms.select name="month" label="Bulan" :options="$months" :selectedValue="$selectedMonth" />
            </div>
            <div>
                <label for="year" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Tahun</label>
                <select name="year" id="year" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-atoms.button type="submit">Terapkan</x-atoms.button>
            </div>
        </form>
    </x-atoms.card>

    {{-- Tabel Ringkasan --}}
    <div class="mt-6">
        <x-atoms.card>
            <x-atoms.heading level="4">Ringkasan untuk {{ $months[$selectedMonth] }} {{ $selectedYear }}</x-atoms.heading>
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold">Total Keluhan</th>
                            <th class="px-4 py-2 text-left font-semibold text-green-600">Selesai</th>
                            <th class="px-4 py-2 text-left font-semibold text-blue-600">Aktif</th>
                            <th class="px-4 py-2 text-left font-semibold text-red-600">Ditolak</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-4 py-2 font-bold text-lg">{{ $stats['total'] }}</td>
                            <td class="px-4 py-2 font-bold text-lg text-green-600">{{ $stats['selesai'] }}</td>
                            <td class="px-4 py-2 font-bold text-lg text-blue-600">{{ $stats['aktif'] }}</td>
                            <td class="px-4 py-2 font-bold text-lg text-red-600">{{ $stats['ditolak'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-atoms.card>
    </div>

    {{-- Diagram Chart --}}
    <div class="mt-6">
        <x-atoms.card>
            <x-atoms.heading level="4">Diagram Status Keluhan</x-atoms.heading>
            <div class="mt-4">
                <canvas id="complaintChart"></canvas>
            </div>
        </x-atoms.card>
    </div>

</x-templates.navigation-template>

{{-- Script untuk Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('complaintChart');
        const chartLabels = @json($chartLabels);
        const chartValues = @json($chartValues);

        const backgroundColors = chartLabels.map((label) => {
            if (label === 'Ditolak') return 'rgba(255, 99, 132, 0.2)';
            if (label === 'Selesai') return 'rgba(75, 192, 192, 0.2)';
            if (label === 'Aktif') return 'rgba(54, 162, 235, 0.2)';
            return 'rgba(255, 205, 86, 0.2)';
        });

        const borderColors = chartLabels.map((label) => {
            if (label === 'Ditolak') return 'rgb(255, 99, 132)';
            if (label === 'Selesai') return 'rgb(75, 192, 192)';
            if (label === 'Aktif') return 'rgb(54, 162, 235)';
            return 'rgb(255, 205, 86)';
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Keluhan',
                    data: chartValues,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    });
</script>