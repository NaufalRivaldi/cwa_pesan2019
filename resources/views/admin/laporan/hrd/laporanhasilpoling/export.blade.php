<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export All</title>
</head>
<body>
    <?php
        libxml_use_internal_errors(true);
    ?>
    <h2>Laporan Hasil Poling</h2>
    <p class="lead">Periode : {{$periode->namaPeriode}}</p>
    <div class="">
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dep as $dep)
                        <?php
                          $skor = 0;
                        ?>                        
                    @foreach(Helper::laporanHasilPoling($dep) as $hasil)
                      @if($dep == $hasil->karyawan->dep)                       
                        @if($skor <= $hasil->skor)
                          <?php 
                            $skor = $hasil->skor;
                          ?>
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$hasil->karyawan->nama}}</td>
                            <td>{{$hasil->karyawan->dep}}</td>
                            <td>{{$hasil->skor}}</td>
                         </tr>
                        @endif                      
                      @endif
                    @endforeach
                  @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>