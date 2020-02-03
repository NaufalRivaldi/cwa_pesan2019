<!DOCTYPE html>
<html lang="en">
<head>
    
    
</head>
<body>
    <table>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $karyawan->nik }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $karyawan->nama }}</td>
        </tr>
        <tr>
            <td>Dep</td>
            <td>:</td>
            <td>{{ $karyawan->dep }}</td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td>{{ $periode->namaPeriode }}</td>
        </tr>
        <tr>
            <td>Menilai</td>
            <td>:</td>
            <td>{{ $tlhMenilai->count() }} karyawan telah menilai dari {{ $penilai->count() }} Karyawan</td>
        </tr>
    </table>
    <h3>Data Penilaian</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Indikator</th>
            <th>Jumlah Nilai</th>
            <th>Rata - Rata</th>
        </tr>
        <?php
            $totalJml = 0;
            $totalMean = 0;
        ?>
        @foreach($penilaianFirst as $indikator)
            <?php 
                $jml = Helper::jmlNilaiKabag($karyawan->id, $periode->id, $indikator->indikator->id);
                $mean = $jml / $tlhMenilai->count();
                $totalJml += $jml;
                $totalMean += $mean;
            ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $indikator->indikator->pertanyaan }}</td>
                <td>{{ $jml }}</td>
                <td>{{ $mean }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="2" class="text-center">Total</th>
            <th>{{ $totalJml }}</th>
            <th>{{ $totalMean }}</th>
        </tr>
    </table>
    <h3>Data Kuisioner</h3>
    @foreach($detailKuisioner as $kuisioner)
        <h3>{{ $kuisioner->kuisioner->pertanyaan }}</h3>
        @foreach(Helper::jawabanKuisioner($karyawan->id, $periode->id, $kuisioner->kuisioner->id) as $detailKuisioner)
            <p>
                {{ $detailKuisioner->jawaban }}
            </p>
        @endforeach
    @endforeach
</body>
</html>