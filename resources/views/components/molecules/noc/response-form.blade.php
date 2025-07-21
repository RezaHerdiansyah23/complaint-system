@props(['complaint'])

@php
    $statusOptions = [
        'in_progress' => 'In Progress',
        'resolved' => 'Resolved',
    ];
@endphp

<x-atoms.card>
    <x-atoms.heading level="4" class="mb-4">Update Status Keluhan</x-atoms.heading>

    <form method="POST" action="{{ route('noc.complaints.updateStatus', $complaint->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            {{-- Status --}}
            <x-atoms.select
                name="status"
                label="Update Status"
                :options="$statusOptions"
                :selectedValue="$complaint->status"
                :required="true"
            />

            {{-- Technical Notes --}}
            <x-atoms.textarea
                name="notes"
                label="Catatan Teknis"
                rows="4"
                :required="true"
            >{{ $complaint->response->notes ?? old('notes') }}</x-atoms.textarea>

            <div class="flex items-center gap-4">
                {{-- Tombol utama --}}
                <x-atoms.button variant="success" type="submit">
                    Update Keluhan
                </x-atoms.button>
                
                {{-- Tombol pintas untuk Resolved --}}
                <x-atoms.button
                    variant="primary"
                    type="submit"
                    name="status"
                    value="resolved"
                    onclick="document.querySelector('textarea[name=notes]').value = 'Issue resolved and closed by NOC.'; return confirm('Anda yakin ingin menandai keluhan ini sebagai Selesai?')"
                >
                    Tandai Selesai
                </x-atoms.button>
            </div>
        </div>
    </form>
</x-atoms.card>