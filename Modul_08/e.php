<?php
session_start();
// Fungsi untuk membaca data alumni (misalnya dari CSV atau database)
function readAlumniData($file) {
    $data = [];
    if (file_exists($file)) {
        $handle = fopen($file, 'r');
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = $row;
        }
        fclose($handle);
    }
    return $data;
}

?>

<div class="container">
    <h1>Daftar Alumni</h1>

    <!-- Pencarian Alumni -->
    <div class="mt-4">
        <label for="search" class="form-label">Cari Alumni</label>
        <input type="text" id="search" class="form-control" placeholder="Cari alumni berdasarkan nama...">
    </div>

    <!-- Tabel Daftar Alumni -->
    <h2 class="mt-4">Daftar Alumni</h2>
    <table class="table table-striped" id="alumniTable">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Angkatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Membaca data alumni dari file CSV
            $data = readAlumniData('alumni.csv');
            foreach ($data as $alumnus) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($alumnus[0]) . "</td>";
                echo "<td>" . htmlspecialchars($alumnus[1]) . "</td>";
                echo "<td>" . htmlspecialchars($alumnus[2]) . "</td>";
                echo "<td>" . htmlspecialchars($alumnus[3]) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    // jQuery untuk mencari alumni berdasarkan nama
    $('#search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $("#alumniTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
</script>
