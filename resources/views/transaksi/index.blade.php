@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Data Transaksi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Data Transaksi</li>
        </ol>
    </nav>
    
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Transaksi</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Tanggal Mulai:</label>
                            <input type="date" id="start-date" class="form-control mb-3">
                        </div>
                        <div class="col-md-3">
                            <label>Tanggal Akhir:</label>
                            <input type="date" id="end-date" class="form-control mb-3">
                        </div>
                        <div class="col-md-3">
                            <label for="total-harga">Total Harga:</label>
                            <input type="text" id="total-harga" class="form-control" value="Rp 0" readonly>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <button id="export-excel" class="btn btn-success form-control">Download Excel</button>
                        </div>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th>Detail Pembelian - pcs</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                    <td class="total-harga-row">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @foreach($transaction->details as $detail)
                                            <li> {{ $detail->produk->nama_produk }} - {{ $detail->jumlah }} pcs</li> 
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($transaction->status == 2)
                                            <span class="badge bg-warning">Butuh Persetujuan</span>
                                        @elseif($transaction->status == 1)
                                            <span class="badge bg-success">Berhasil</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                        @if($transaction->status == 2)
                                        <form action="{{ route('transactions.approve', $transaction->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function filterData() {
    const startDate = new Date(document.getElementById('start-date').value);
    const endDate = new Date(document.getElementById('end-date').value);
    const rows = document.querySelectorAll('.datatable tbody tr');
    const totalHargaInput = document.getElementById('total-harga');
    let totalHarga = 0;

    rows.forEach(row => {
        const dateText = row.querySelector('td:nth-child(2)').textContent;
        const [day, month, year] = dateText.split('-').map(Number);
        const rowDate = new Date(year, month - 1, day);
        const hargaText = row.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, '');
        const harga = parseInt(hargaText, 10);

        const showRow = (!startDate || isNaN(startDate.getTime()) || rowDate >= startDate) && 
                     (!endDate || isNaN(endDate.getTime()) || rowDate <= endDate);
        
        row.style.display = showRow ? '' : 'none';
        if (showRow) {
            totalHarga += harga;
        }
    });

    totalHargaInput.value = `Rp ${totalHarga.toLocaleString('id-ID')}`;
}

// Event listeners
document.getElementById('start-date').addEventListener('change', filterData);
document.getElementById('end-date').addEventListener('change', filterData);
document.getElementById('export-excel').addEventListener('click', exportToExcel);

// Set default dates
const today = new Date();
const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

document.getElementById('start-date').valueAsDate = firstDayOfMonth;
document.getElementById('end-date').valueAsDate = today;

// Initial filter
document.addEventListener('DOMContentLoaded', filterData);

function exportToExcel() {
    // Get table and visible rows
    const table = document.querySelector('.datatable');
    const allRows = Array.from(table.querySelectorAll('tbody tr'));
    const visibleRows = allRows.filter(row => row.style.display !== 'none');
    
    const wb = XLSX.utils.book_new();
    
    // Get filtered period with proper formatting
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;
    const formatDate = (dateString) => {
        if (!dateString) return '';
        const [year, month, day] = dateString.split('-');
        return `${day}/${month}/${year}`;
    };
    
    // Format dates and ensure they're not empty
    const formattedStartDate = startDate ? formatDate(startDate) : 'Semua';
    const formattedEndDate = endDate ? formatDate(endDate) : 'Semua';
    
    // Get total from the input
    const totalHarga = document.getElementById('total-harga').value;

    // Prepare the header
    const headers = [
        ['LAPORAN TRANSAKSI'],
        [],
        [],
        [], // Empty row for spacing
        ['No', 'Tanggal', 'Total Harga', 'Detail Pembelian', 'Status'] // Reordered column headers
    ];

    // Prepare the data
    const data = visibleRows.map(row => {
        const cells = Array.from(row.cells);
        cells.pop(); // Remove Aksi column
        
        // Format the detail pembelian column (now index 3)
        const detailsCell = cells[3];
        const detailsList = Array.from(detailsCell.querySelectorAll('li'))
            .map(li => li.textContent.trim())
            .join(', ');
        
        return [
            cells[0].textContent.trim(), // No
            cells[1].textContent.trim(), // Tanggal
            cells[2].textContent.trim(), // Total Harga
            detailsList,                 // Detail Pembelian
            cells[4].textContent.trim()  // Status
        ];
    });

    // Calculate total from visible rows
    const totalAmount = visibleRows.reduce((sum, row) => {
        const hargaText = row.querySelector('.total-harga-row').textContent.replace(/[^\d]/g, '');
        return sum + parseInt(hargaText, 10);
    }, 0);

    // Add total row
    const totalRow = [
        '',                                         // No
        'TOTAL',                                         // Tanggal
        `Rp ${totalAmount.toLocaleString('id-ID')}`, // Total Harga
        '',                                         // Detail Pembelian
        ''                                     // Status
    ];
    
    // Combine headers, data, and total row
    const ws_data = [...headers, ...data, [], totalRow];
    
    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    
    // Set column widths
    const columnWidths = [
        { wch: 5 },  // No
        { wch: 12 }, // Tanggal
        { wch: 15 }, // Total Harga
        { wch: 50 }, // Detail Pembelian
        { wch: 15 }  // Status
    ];
    ws['!cols'] = columnWidths;
    
    // Set row heights
    const rowHeights = {};
    data.forEach((_, idx) => {
        rowHeights[idx + 5] = { hpt: 30 }; // Adjust for header rows
    });
    ws['!rows'] = rowHeights;
    
    // Styling
    const headerStyle = {
       font: { bold: true, sz: 16 },
       alignment: { horizontal: 'center' }
   };
   
   const subHeaderStyle = {
       font: { bold: true, sz: 12 },
       alignment: { horizontal: 'left' }
   };
   
   const columnHeaderStyle = {
       font: { bold: true, sz: 12 },
       fill: { fgColor: { rgb: "CCCCCC" } },
       alignment: { horizontal: 'center' }
   };
   
   // Apply styles
   ws['A1'] = { v: 'LAPORAN TRANSAKSI', s: headerStyle };
   ws['!merges'] = [
       { s: { r: 0, c: 0 }, e: { r: 0, c: 4 } }, // Merge first row
       { s: { r: 1, c: 0 }, e: { r: 1, c: 1 } }, // Merge Periode label
       { s: { r: 1, c: 2 }, e: { r: 1, c: 4 } }, // Merge Periode value
       { s: { r: 2, c: 0 }, e: { r: 2, c: 1 } }, // Merge Total label
       { s: { r: 2, c: 2 }, e: { r: 2, c: 4 } }  // Merge Total value
   ];
   
   // Apply styles to column headers (row 5)
   for (let i = 0; i < 5; i++) {
       const cell = XLSX.utils.encode_cell({ r: 4, c: i });
       ws[cell].s = columnHeaderStyle;
   }
   
   // Apply styles to data rows
   for (let i = 5; i < ws_data.length; i++) {
       for (let j = 0; j < 5; j++) {
           const cell = XLSX.utils.encode_cell({ r: i, c: j });
           if (ws[cell]) {
               ws[cell].s = {
                   alignment: { 
                       horizontal: j === 0 ? 'center' : 'left',
                       vertical: 'center',
                       wrapText: true
                   },
                   border: {
                       top: { style: 'thin' },
                       bottom: { style: 'thin' },
                       left: { style: 'thin' },
                       right: { style: 'thin' }
                   }
               };
           }
       }
   }
    XLSX.utils.book_append_sheet(wb, ws, "Transaksi");
    
    const date = new Date().toISOString().split('T')[0];
    XLSX.writeFile(wb, `laporan_transaksi_${date}.xlsx`);
}
</script>
<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
@endsection
