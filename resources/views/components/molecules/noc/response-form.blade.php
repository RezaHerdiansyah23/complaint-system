@props(['complaint'])

@php
    $statusOptions = [
        'in_progress' => 'In Progress',
        'resolved' => 'Resolved',
    ];
@endphp

<x-atoms.card>
    {{-- Cek status keluhan di sini --}}
    @if ($complaint->status === 'resolved')
        {{-- JIKA SUDAH SELESAI, TAMPILKAN INFO --}}
        <x-atoms.info-box variant="success">
            <h4 class="font-bold">Keluhan Selesai</h4>
            <p class="mt-1">Keluhan ini sudah ditandai sebagai 'resolved' dan tidak bisa di-update lagi.</p>
        </x-atoms.info-box>

    @else
        {{-- JIKA BELUM SELESAI, TAMPILKAN FORM --}}
        <x-atoms.heading level="4" class="mb-2">Update Status Keluhan</x-atoms.heading>
        
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 pb-4 space-y-1">
            <p><strong>Perusahaan:</strong> {{ $complaint->company_name }}</p>
            @if($complaint->response && $complaint->response->notes)
                <p><strong>Catatan:</strong> {{ $complaint->response->notes }}</p>
            @endif
        </div>

        <form method="POST" action="{{ route('noc.complaints.updateStatus', $complaint->id) }}" id="noc-response-form">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                {{-- Status --}}
                <x-atoms.select
                    name="status"
                    id="status-select"
                    label="Update Status"
                    :options="$statusOptions"
                    :selectedValue="$complaint->status"
                    :required="true"
                />

                {{-- Catatan Teknis --}}
                <x-atoms.textarea
                    name="notes"
                    id="notes-textarea"
                    label="Catatan"
                    rows="4"
                    :required="true"
                >{{ old('notes', $complaint->response?->notes ?? '') }}</x-atoms.textarea>

                <div class="flex items-center gap-4">
                    {{-- Tombol utama "Update Keluhan" --}}
                    <x-molecules.confirmation-modal variant="success" confirm-text="Ya, Update">
                        <x-slot name="trigger">
                            <x-atoms.button variant="success" type="button">Update Keluhan</x-atoms.button>
                        </x-slot>
                        <x-slot name="title">Konfirmasi Update</x-slot>
                        Anda yakin ingin meng-update status dan catatan untuk keluhan ini?
                        <x-slot name="confirmAction">
                            <x-atoms.button variant="success" type="button" onclick="document.getElementById('noc-response-form').submit();">Ya, Update</x-atoms.button>
                        </x-slot>
                    </x-molecules.confirmation-modal>
                    
                    {{-- Tombol pintas "Tandai Selesai" --}}
                    <x-molecules.confirmation-modal variant="primary" confirm-text="Ya, Tandai Selesai">
                        <x-slot name="trigger">
                            <x-atoms.button variant="primary" type="button">Tandai Selesai</x-atoms.button>
                        </x-slot>
                        <x-slot name="title">Konfirmasi Penyelesaian</x-slot>
                        Anda yakin ingin menandai keluhan ini sebagai 'Resolved'? Catatan teknis akan otomatis diisi.
                        <x-slot name="confirmAction">
                            <x-atoms.button
                                variant="primary"
                                type="button"
                                onclick="
                                    document.getElementById('status-select').value = 'resolved';
                                    document.getElementById('notes-textarea').value = 'Issue resolved and closed by NOC.';
                                    document.getElementById('noc-response-form').submit();
                                "
                            >Ya, Tandai Selesai</x-atoms.button>
                        </x-slot>
                    </x-molecules.confirmation-modal>
                </div>
            </div>
        </form>
    @endif
</x-atoms.card>