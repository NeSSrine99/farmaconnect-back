@extends('admin.layout.layout')

@section('content')
    <div class="p-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">💊 Prescriptions</h1>

            <!-- Filters -->
            <div class="flex flex-wrap gap-2 mt-3 md:mt-0">

                <button onclick="filterStatus('all')"
                    class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-lg text-xs font-medium">
                    All
                </button>

                <button onclick="filterStatus('pending')"
                    class="px-3 py-1 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-lg text-xs font-medium">
                    Pending
                </button>

                <button onclick="filterStatus('accepted')"
                    class="px-3 py-1 bg-green-100 text-green-700 hover:bg-green-200 rounded-lg text-xs font-medium">
                    Accepted
                </button>

                <button onclick="filterStatus('rejected')"
                    class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg text-xs font-medium">
                    Rejected
                </button>

                <input type="date" id="fromDate" class="border rounded-lg px-2 py-1 text-xs">
                <input type="date" id="toDate" class="border rounded-lg px-2 py-1 text-xs">

                <button onclick="filterByDate()"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">
                    Filter
                </button>

            </div>
        </div>

        <!-- CARD -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">

                    <!-- HEAD -->
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">File</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Reviewed</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y">

                        @foreach ($prescriptions as $p)
                            <tr data-status="{{ $p->status }}" data-date="{{ $p->created_at->format('Y-m-d') }}"
                                class="hover:bg-gray-50 transition">

                                <!-- ID -->
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    #{{ $p->id }}
                                </td>

                                <!-- USER -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <!-- Avatar -->
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold">
                                            {{ strtoupper(substr($p->user->name ?? 'U', 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-800">
                                                {{ $p->user->name ?? 'User' }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                <!-- FILE -->
                                <td class="px-6 py-4">
                                    @if ($p->file)
                                        <button onclick="openModal('{{ asset('storage/' . $p->file) }}')"
                                            class="text-blue-500 hover:underline text-xs font-medium">
                                            View Image
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-xs">No File</span>
                                    @endif
                                </td>

                                <!-- STATUS -->
                                <td class="px-6 py-4" id="status-{{ $p->id }}">
                                    @if ($p->status == 'accepted')
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Accepted
                                        </span>
                                    @elseif($p->status == 'rejected')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Rejected
                                        </span>
                                    @else
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <!-- REVIEWED -->
                                <td class="px-6 py-4 text-gray-500 text-sm" id="reviewed-{{ $p->id }}">
                                    {{ $p->reviewed_by ?? '-' }}
                                </td>

                                <!-- ACTIONS -->
                                <td class="px-6 py-4 text-center space-x-2">

                                    <button onclick="updateStatus({{ $p->id }}, 'accepted')"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs">
                                        ✔ Accept
                                    </button>

                                    <button onclick="updateStatus({{ $p->id }}, 'rejected')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">
                                        ✖ Reject
                                    </button>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

    </div>

    <!-- MODAL -->
    <div id="fileModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full relative animate-scaleIn">

            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl">
                ✕
            </button>

            <img id="modalImage" class="w-full max-h-[600px] object-contain rounded-2xl">

        </div>

    </div>

    <!-- NOTIFICATION -->
    <div id="notifBox" class="fixed top-6 right-6 bg-green-500 text-white px-4 py-2 rounded-xl shadow-lg hidden">
    </div>

    <!-- JS -->
    <script>
        function updateStatus(id, status) {

            console.log("Clicked:", id, status);

            // disable buttons
            document.querySelectorAll(`#row-${id} button`)
                .forEach(btn => btn.disabled = true);

            fetch(`/admin/prescriptions/${id}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(res => {
                    if (!res.ok) throw new Error("Network error");
                    return res.json();
                })
                .then(data => {

                    console.log("Data:", data);

                    let statusCell = document.getElementById('status-' + id);

                    let badge = '';
                    if (status === 'accepted') {
                        badge =
                            `<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Accepted</span>`;
                    } else {
                        badge =
                            `<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">Rejected</span>`;
                    }

                    statusCell.innerHTML = badge;
                    document.getElementById('reviewed-' + id).innerText = "You";

                    if (status === 'accepted') {
                        setTimeout(() => {
                            window.location.href = `/admin/prescriptions/${id}/create-order`;
                        }, 500);
                    }
                })
                .catch(err => {
                    console.error("ERROR:", err);
                    alert("Something went wrong");
                });
        }

        function filterStatus(status) {
            document.querySelectorAll('tbody tr').forEach(row => {
                let s = row.getAttribute('data-status');
                row.style.display = (status === 'all' || s === status) ? '' : 'none';
            });
        }

        function filterByDate() {
            let from = document.getElementById('fromDate').value;
            let to = document.getElementById('toDate').value;

            document.querySelectorAll('tbody tr').forEach(row => {
                let d = row.getAttribute('data-date');

                if ((!from || d >= from) && (!to || d <= to)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('fileModal').classList.remove('hidden');
            document.getElementById('fileModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('fileModal').classList.add('hidden');
        }

        let lastCount = {{ count($prescriptions) }};

        setInterval(() => {
            fetch('/admin/prescriptions/count')
                .then(res => res.json())
                .then(data => {
                    if (data.count > lastCount) {
                        showNotification("🆕 New Prescription!");
                        lastCount = data.count;
                    }
                });
        }, 5000);

        function showNotification(msg) {
            let box = document.getElementById('notifBox');
            box.innerText = msg;
            box.classList.remove('hidden');

            setTimeout(() => box.classList.add('hidden'), 3000);
        }
    </script>
@endsection
