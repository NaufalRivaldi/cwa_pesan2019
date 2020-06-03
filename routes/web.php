<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['middleware' => ['guest']], function(){
//     // home
//     Route::get('/', 'HomeController@index');
//     Route::get('/detail/{id}', 'HomeController@detail');
//     Route::get('/scoreboard', 'ScoreboardController@scoreboard');
//     Route::get('/scoreboarddetail', 'ScoreboardController@scoreboarddetail');
    
// });

// login & logout
Route::get('/', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

// admin
Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function(){
    // dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/detailp/{id}', 'DashboardController@detailp');

    Route::group(['prefix' => '/pesan'], function(){
        // inbox
        Route::get('/inbox', 'PesanController@inbox')->name('inbox');
        Route::get('/inbox/detail/{pesan_id}', 'PesanController@detail');
        Route::get('/inbox/hapus/{pesan_id}', 'PesanController@hapus');
        Route::get('/inbox/hapuscek/{pesan_id}', 'PesanController@hapuscek');
        // post pesan
        Route::get('/form', 'PesanController@form');
        Route::post('/store', 'PesanController@store');
        Route::post('/storefwd', 'PesanController@storeFwd');
        Route::get('/forward/{pesan_Id}', 'PesanController@forward');

        // outbox
        Route::get('/outbox', 'OutboxController@index');
        Route::get('/outbox/detail/{pesan_id}', 'OutboxController@detail');
        Route::get('/outbox/hapus/{pesan_id}', 'OutboxController@hapus');
        Route::get('/outbox/hapuscek/{pesan_id}', 'OutboxController@hapuscek');

        // Tempat sampah
        Route::get('/trash', 'TrashController@index');
        Route::get('/trash/detail/{pesan_id}', 'TrashController@detail');
        Route::get('/trash/hapusout/{pesan_id}', 'TrashController@hapusout');
        Route::get('/trash/hapusin/{pesan_id}', 'TrashController@hapusin');
        Route::get('/trash/buInbox/{pesan_id}', 'TrashController@buInbox');
        Route::get('/trash/buOutbox/{pesan_id}', 'TrashController@buOutbox');
    });

    // pengumuman
    Route::group(['prefix' => '/pengumuman', 'middleware' => ['checkDep:IT,SCM,HRD,Pajak,QA,GA,MT,Accounting,Finance,Office,Gudang']], function(){
        Route::get('/', 'PengumumanController@index')->name('pengumuman.index');
        Route::get('/form', 'PengumumanController@form');
        Route::get('/detail/{id}', 'PengumumanController@detail');
        Route::get('/edit/{id}', 'PengumumanController@edit');
        Route::post('/active', 'PengumumanController@active')->name('pengumuman.active');
        Route::post('/nonactive', 'PengumumanController@nonactive')->name('pengumuman.nonactive');
        Route::get('/delete/{id}', 'PengumumanController@delete');
        Route::get('/delattc/{id}', 'PengumumanController@delattc');
        Route::post('/store', 'PengumumanController@store');
        Route::put('/update', 'PengumumanController@update');
    });

    // scoreboard
    Route::get('/scoreboard', 'ScoreboardController@scoreboard');
    Route::get('/scoreboarddetail', 'ScoreboardController@scoreboarddetail');
    Route::get('/scoreboardexport', 'ScoreboardController@export')->name('scoreboard.export');
    Route::get('/scoreboardexportall', 'ScoreboardController@exportAll')->name('scoreboard.exportAll');

    // penjualan PU
    Route::group(['prefix' => '/penjualanpu', 'middleware' => ['checkDep:IT,SCM']], function(){
        Route::get('/', 'PenjualanPUController@index');
        Route::get('/detail', 'PenjualanPUController@detail');
        Route::get('/expall', 'PenjualanPUController@expall');
    });

    // Score Produk
    Route::group(['prefix' => '/scoreproduk', 'middleware' => ['checkDep:IT,Office']], function(){
        Route::get('/', 'ScoreProdukController@index')->name('score.produk');
        Route::get('/detail', 'ScoreProdukController@detail');
    });

    // ubah password
    Route::group(['prefix' => '/repassword'], function(){
        Route::get('/', 'RepasswordController@index')->name('repassword');
        Route::post('/save', 'RepasswordController@save');
    });

    // Update Master
    Route::group(['prefix' => '/master'], function(){
        Route::get('/', 'UpdateMasterController@index');
        Route::post('/save', 'UpdateMasterController@save');
    });

    // Prosedur
    Route::group(['prefix' => '/prosedur'], function(){
        Route::get('/', 'Prosedur\ProsedurGlobalController@index')->name('prosedur.index');
        Route::post('/login', 'Prosedur\ProsedurGlobalController@login')->name('prosedur.login');
        Route::get('/{id}/view', 'Prosedur\ProsedurGlobalController@view')->name('prosedur.view');
    });

    // Finance
    Route::group(['prefix' => '/finance'], function(){
        Route::get('/', 'FinanceController@index');
        Route::post('/save', 'FinanceController@save');
        Route::get('/detail/{nama}', 'FinanceController@detail');
    });

    // form hrd
    Route::group(['prefix' => '/formhrd'], function(){
        Route::get('/', 'FormHRDController@index')->name('form.hrd');
        Route::get('/form', 'FormHRDController@form');
        Route::post('/store', 'FormHRDController@store');
        Route::get('/detail/{id}', 'FormHRDController@detail');
        Route::post('/acc/{id}', 'FormHRDController@acc');
        Route::post('/tolak/{id}', 'FormHRDController@tolak');
        Route::post('/delete', 'FormHRDController@delete')->name('formhrd.delete');
        
        Route::group(['middleware' => ['checkDep:HRD,IT']], function(){
            Route::post('/accHRD/{id}', 'FormHRDController@accHRD');
            Route::post('/tolakHRD/{id}', 'FormHRDController@tolakHRD');
            Route::get('/laporan', 'FormHRDController@laporan')->name('laporan');
            Route::post('/laporan/view/', 'FormHRDController@view')->name('laporan.view');
            Route::get('/laporan/edit/{id}', 'FormHRDController@edit')->name('laporan.edit');
            Route::post('/laporan/update/', 'FormHRDController@update')->name('laporan.update');
            Route::get('/laporan/export/', 'FormHRDController@export');
            Route::post('/deletelaporan', 'FormHRDController@laporanDelete')->name('laporan.delete');
        });

        Route::group(['middleware' => ['checkDep:Office,HRD']], function(){
            Route::get('/verifikasi', 'FormHRDController@verivikasi')->name('verifikasi');
            Route::get('/verifikasi/detail/{id}', 'FormHRDController@detailVer')->name('verifikasi.detail');
        });

        Route::group(['prefix' => '/cuti'], function(){
            Route::get('/', 'Forms\Cuti\CutiController@index')->name('form.hrd.cuti');
            Route::get('/form', 'Forms\Cuti\CutiController@form')->name('form.hrd.cuti.form');
            Route::get('/{id}/edit', 'Forms\Cuti\CutiController@form')->name('form.hrd.cuti.edit');
            Route::post('/add', 'Forms\Cuti\CutiController@add')->name('form.hrd.cuti.add');
            Route::put('/update', 'Forms\Cuti\CutiController@update')->name('form.hrd.cuti.update');
            Route::post('/delete', 'Forms\Cuti\CutiController@delete')->name('form.hrd.cuti.delete');
            Route::get('/generate', 'Forms\Cuti\CutiController@generate')->name('form.hrd.cuti.generate');
            Route::get('/cari/karyawan', 'Forms\Cuti\CutiController@loadKaryawan')->name('form.hrd.cuti.loadKaryawan');

            Route::get('/fillCuti', 'Forms\Cuti\CutiController@fillCuti')->name('form.hrd.cuti.fillCuti');
            Route::get('/cekKaryawan', 'Forms\Cuti\CutiController@cekKaryawan')->name('form.hrd.cuti.cekKaryawan');
            Route::get('/cekBulan', 'Forms\Cuti\CutiController@cekBulan')->name('form.hrd.cuti.cekBulan');
            
            Route::group(['prefix' => '/kategori'], function(){

                Route::get('/', 'Forms\Cuti\KategoriCutiController@index')->name('form.hrd.cuti.kategori');
                Route::get('/form', 'Forms\Cuti\KategoriCutiController@form')->name('form.hrd.cuti.kategori.form');
                Route::post('/add', 'Forms\Cuti\KategoriCutiController@add')->name('form.hrd.cuti.kategori.add');
                Route::get('/{id}/edit', 'Forms\Cuti\KategoriCutiController@form')->name('form.hrd.cuti.kategori.edit');
                Route::post('/update', 'Forms\Cuti\KategoriCutiController@update')->name('form.hrd.cuti.kategori.update');
                Route::post('/delete', 'Forms\Cuti\KategoriCutiController@delete')->name('form.hrd.cuti.kategori.delete');
            });

            Route::group(['prefix' => '/formcuti'], function(){
                Route::get('/', 'Forms\Cuti\FormCutiController@index')->name('form.hrd.cuti.formcuti');
                Route::get('/form', 'Forms\Cuti\FormCutiController@form')->name('form.hrd.cuti.formcuti.form');
                Route::get('/periode', 'Forms\Cuti\FormCutiController@periode')->name('form.hrd.cuti.formcuti.periode');
                Route::get('/kategori', 'Forms\Cuti\FormCutiController@kategori')->name('form.hrd.cuti.formcuti.kategori');
                Route::get('/maxCuti', 'Forms\Cuti\FormCutiController@maxCuti')->name('form.hrd.cuti.formcuti.maxCuti');
                Route::post('/add', 'Forms\Cuti\FormCutiController@add')->name('form.hrd.cuti.formcuti.add');
                Route::get('/detail', 'Forms\Cuti\FormCutiController@detail')->name('form.hrd.cuti.formcuti.detail');
                Route::get('/detailCuti', 'Forms\Cuti\FormCutiController@detailCuti')->name('form.hrd.cuti.formcuti.detailCuti');
                Route::post('/verifikasi', 'Forms\Cuti\FormCutiController@verifikasi')->name('form.hrd.cuti.formcuti.verifikasi');
                Route::post('/delete', 'Forms\Cuti\FormCutiController@delete')->name('form.hrd.cuti.formcuti.delete');
            });


            Route::group(['prefix' => '/verifikasiCuti', 'middleware' => ['checkDep:Office,HRD']], function(){
                Route::get('/', 'Forms\Cuti\VerifikasiCutiController@index')->name('form.hrd.cuti.verifikasiCuti');
                Route::post('/verifikasiHRD', 'Forms\Cuti\VerifikasiCutiController@verifikasiHRD')->name('form.hrd.cuti.verifikasiCuti.hrd');
                Route::post('/verifikasiAM', 'Forms\Cuti\VerifikasiCutiController@verifikasiAM')->name('form.hrd.cuti.verifikasiCuti.am');
            });
        });
    });

    // form it
    Route::group(['prefix' => '/formit'], function(){
        Route::get('/', 'FormPenangananController@index')->name('penanganan.it');
        Route::get('/form', 'FormPenangananController@form')->name('penanganan.it.form');
        Route::get('/view/{id}', 'FormPenangananController@view')->name('penanganan.it.view');
        Route::post('/verifikasi', 'FormPenangananController@verifikasi')->name('penanganan.it.verifikasi');
        Route::post('/status', 'FormPenangananController@status')->name('penanganan.it.status');
        Route::post('/store', 'FormPenangananController@store')->name('penanganan.it.store');
        Route::get('/delete/{id}', 'FormPenangananController@delete');

        Route::group(['prefix' => 'detail', 'middleware' => ['checkDep:IT']], function(){
            Route::delete('delete', 'DetailFormPenangananController@delete')->name('penanganan.it.detail.delete');
        });

        // desain iklan
        Route::group(['prefix' => 'desain'], function(){
            Route::get('/', 'FormDesainController@index')->name('desainIklan');
            Route::get('/form', 'FormDesainController@form')->name('desainIklan.form');
            Route::get('/view', 'FormDesainController@view')->name('desainIklan.view');
            Route::get('/delete/{id}', 'FormDesainController@delete')->name('desainIklan.delete');
            Route::post('/store', 'FormDesainController@store')->name('desainIklan.store');
            Route::post('/validasi', 'FormDesainController@validasi')->name('desainIklan.validasi');
            Route::post('/updateStatus', 'FormDesainController@updateStatus')->name('desainIklan.status');
        });
    });

    // FORM SEMUANYA DISINI YAAA
    Route::group(['prefix' => 'form'], function(){
        // form GA
        Route::group(['prefix' => 'ga'], function(){
            Route::group(['prefix' => 'perbaikan-sarana'], function(){
                Route::get('/', 'FormPerbaikanController@index')->name('form.ga.perbaikan');
                Route::get('/form', 'FormPerbaikanController@form')->name('form.ga.perbaikan.form');
                Route::get('/view', 'FormPerbaikanController@view')->name('form.ga.perbaikan.view');
                Route::post('/store', 'FormPerbaikanController@store')->name('form.ga.perbaikan.store');
                Route::post('/validasi', 'FormPerbaikanController@validasi')->name('form.ga.perbaikan.validasi');
                Route::post('/status', 'FormPerbaikanController@updateStatus')->name('form.ga.perbaikan.status');
                Route::post('/delete', 'FormPerbaikanController@delete')->name('form.ga.perbaikan.delete');
            });
        });

        Route::group(['prefix' => 'ga'], function(){
            Route::group(['prefix' => 'peminjaman-sarana', 'middleware' => ['checkDep:IT,SCM,HRD,Pajak,QA,GA,MT,Accounting,Finance,Office,Gudang']], function(){
                Route::get('/', 'FormPeminjamanController@index')->name('form.ga.peminjaman');
                Route::get('/form', 'FormPeminjamanController@form')->name('form.ga.peminjaman.form');
                Route::get('/view', 'FormPeminjamanController@view')->name('form.ga.peminjaman.view');
                Route::get('/table', 'FormPeminjamanController@table')->name('form.ga.peminjaman.table');
                Route::post('/store', 'FormPeminjamanController@store')->name('form.ga.peminjaman.store');
                Route::post('/update-sarana', 'FormPeminjamanController@updateSarana')->name('form.ga.peminjaman.update.sarana');
                Route::post('/validasi', 'FormPeminjamanController@validasi')->name('form.ga.peminjaman.validasi');
                Route::get('/edit-sarana', 'FormPeminjamanController@editSarana')->name('form.ga.peminjaman.editSarana');
                Route::post('/delete', 'FormPeminjamanController@delete')->name('form.ga.peminjaman.delete');
                Route::post('/delete-sarana', 'FormPeminjamanController@deleteSarana')->name('form.ga.peminjaman.delete.sarana');
            });
        });

        Route::group(['prefix' => 'qa'], function(){
            Route::group(['prefix' => 'penambahancopy'], function(){
                Route::get('/', 'Forms\PenambahanFile\FormQaUsulanController@index')->name('form.qa.penambahanfile.index');
                Route::get('/form', 'Forms\PenambahanFile\FormQaUsulanController@form')->name('form.qa.penambahanfile.form');
                Route::get('/formDoc', 'Forms\PenambahanFile\FormQaUsulanController@formDoc')->name('form.qa.penambahanfile.formDoc');
                Route::post('/store', 'Forms\PenambahanFile\FormQaUsulanController@store')->name('form.qa.penambahanfile.store');
                Route::get('/view', 'Forms\PenambahanFile\FormQaUsulanController@view')->name('form.qa.penambahanfile.view');
                Route::get('/table', 'Forms\PenambahanFile\FormQaUsulanController@table')->name('form.qa.penambahanfile.table');
                Route::post('/acc', 'Forms\PenambahanFile\FormQaUsulanController@acc')->name('form.qa.penambahanfile.acc');
                Route::post('/tolak', 'Forms\PenambahanFile\FormQaUsulanController@tolak')->name('form.qa.penambahanfile.tolak');
                Route::post('/selesai', 'Forms\PenambahanFile\FormQaUsulanController@selesai')->name('form.qa.penambahanfile.selesai');
                Route::post('/destroy', 'Forms\PenambahanFile\FormQaUsulanController@destroy')->name('form.qa.penambahanfile.destroy');
            });
        });

    });

    // laporan semuanyaaa (Kodingan mulai bener wkwkw, ancur sebelumnya gara" baru nyoba FW)
    Route::group(['prefix' => 'laporan'], function(){
        Route::group(['prefix' => 'hrd', 'middleware' => ['checkDep:HRD,IT']], function(){
            // Penambahana karyawan oleh HRD
            Route::group(['prefix' => 'karyawan'], function(){
                Route::get('/', 'LaporanKaryawanController@index')->name('laporan.hrd.karyawan');
                Route::get('/form', 'LaporanKaryawanController@form')->name('laporan.hrd.karyawan.form');
                Route::post('/generate', 'LaporanKaryawanController@generate')->name('laporan.hrd.karyawan.generate');
                Route::get('/{id}/edit', 'LaporanKaryawanController@edit')->name('laporan.hrd.karyawan.edit');
                Route::get('/{id}/aktif', 'LaporanKaryawanController@aktif')->name('laporan.hrd.karyawan.aktif');
                Route::get('/{id}/nonaktif', 'LaporanKaryawanController@nonaktif')->name('laporan.hrd.karyawan.nonaktif');
                Route::post('/store', 'LaporanKaryawanController@store')->name('laporan.hrd.karyawan.store');
                Route::put('/update', 'LaporanKaryawanController@update')->name('laporan.hrd.karyawan.update');
                Route::post('/destroy', 'LaporanKaryawanController@destroy')->name('laporan.hrd.karyawan.destroy');
            });

            Route::group(['prefix' => 'hasilpoling'], function(){
                Route::get('/','PKK\LaporanHasilPolingController@index')->name('laporan.hrd.hasilpoling');
                Route::get('/detail','PKK\LaporanHasilPolingController@detail')->name('laporan.hrd.hasilpoling.detail');
                Route::get('/export','PKK\LaporanHasilPolingController@export')->name('laporan.hrd.hasilpoling.export');
            });

            Route::group(['prefix' => 'best-employee'], function(){
                Route::get('/', 'PKK\LaporanBestEmployeeController@index')->name('laporan.hrd.penilaian.bestemp');
                Route::get('/view/{periodeId}/{karyawanId}', 'PKK\LaporanBestEmployeeController@view')->name('laporan.hrd.penilaian.bestemp.view');
                Route::post('/reset', 'PKK\LaporanBestEmployeeController@reset')->name('laporan.hrd.penilaian.bestemp.reset');
            });

            Route::group(['prefix' => 'penilaiankabag'], function(){
                Route::get('/', 'PKK\LaporanPenilaianKabagController@index')->name('laporan.hrd.penilaian.kabag');
                Route::get('/{kategori}/export','PKK\LaporanPenilaianKabagController@export')->name('laporan.hrd.penilaiankabag.export');

                Route::group(['prefix' => 'departemen'], function(){
                    Route::get('/', 'PKK\LaporanPenilaianKabagController@indexKDepartemen')->name('laporan.hrd.penilaian.kabag.departemen');
                    Route::get('/{karyawanId}/{periodeId}/detail', 'PKK\LaporanPenilaianKabagController@detail')->name('laporan.hrd.penilaian.kabag.detail.departemen');
                });
                
                Route::group(['prefix' => 'toko'], function(){
                    Route::get('/', 'PKK\LaporanPenilaianKabagController@indexToko')->name('laporan.hrd.penilaian.kabag.toko');                    
                    Route::get('/{karyawanId}/{periodeId}/detail', 'PKK\LaporanPenilaianKabagController@detail')->name('laporan.hrd.penilaian.kabag.detail.toko');
                });
            });

            Route::group(['prefix'=>'formcuti'], function(){
                Route::get('/', 'Forms\Cuti\LaporanFormCutiController@index')->name('laporan.hrd.formcuti');
                Route::get('/detail/{id}', 'Forms\Cuti\LaporanFormCutiController@detail')->name('laporan.hrd.formcuti.detail');
            });
        });

        Route::group(['prefix' => 'ga', 'middleware' => ['checkDep:GA,IT']], function(){
            // perbaikan
            Route::group(['prefix' => 'perbaikan'], function(){
                Route::get('/', 'LaporanPerbaikanSaranaController@index')->name('laporan.ga.perbaikan');
                Route::get('/export', 'LaporanPerbaikanSaranaController@export')->name('laporan.ga.perbaikan.export');
            });

            Route::group(['prefix' => 'peminjaman'], function(){
                Route::get('/', 'LaporanPeminjamanSaranaController@index')->name('laporan.ga.peminjaman.index');
                Route::get('/export', 'LaporanPeminjamanSaranaController@export')->name('laporan.ga.peminjaman.export');
            });

            Route::group(['prefix' => 'sarana'], function(){
                Route::get('/', 'SaranaController@index')->name('laporan.ga.list.sarana');
                Route::get('/form', 'SaranaController@form')->name('laporan.ga.sarana.form');
                Route::get('/{id}/edit', 'SaranaController@edit')->name('laporan.ga.sarana.edit');
            });
        });

        Route::group(['prefix'=>'qa', 'middleware' => ['checkDep:QA,IT']], function(){
            Route::group(['prefix' => 'penambahanfile'], function(){
                Route::get('/', 'Forms\PenambahanFile\LaporanFormQaUsulanController@index')->name('laporan.qa.penambahanfile.index');
                Route::get('/export', 'Forms\PenambahanFile\LaporanFormQaUsulanController@export')->name('laporan.qa.penambahanfile.export');
            });
        });
    });

    // master
    Route::group(['prefix' => 'master', 'middleware' => ['checkDep:HRD,IT,GA,QA']], function(){
        Route::group(['prefix' => 'sarana', 'middleware' => ['checkDep:GA,IT']], function(){
            Route::get('/', 'Masters\SaranaController@index')->name('master.sarana.index');
            Route::get('/form', 'Masters\SaranaController@form')->name('master.sarana.form');
            Route::get('/{id}/edit', 'Masters\SaranaController@form')->name('master.sarana.edit');
            Route::post('/store', 'Masters\SaranaController@store')->name('master.sarana.store');
            Route::put('/update', 'Masters\SaranaController@update')->name('master.sarana.update');
            Route::post('/destroy', 'Masters\SaranaController@destroy')->name('master.sarana.destroy');
        });

        Route::group(['prefix' => 'master', 'middleware' => ['checkDep:QA,IT']], function(){
            Route::get('/', 'Masters\MasterFileController@index')->name('master.masterfile.index');
            Route::get('/form', 'Masters\MasterFileController@form')->name('master.masterfile.form');
            Route::post('/store', 'Masters\MasterFileController@store')->name('master.masterfile.store');
            Route::get('/edit/{id}', 'Masters\MasterFileController@edit')->name('master.masterfile.edit');
            Route::put('/update', 'Masters\MasterFileController@update')->name('master.masterfile.update');
            Route::post('/destroy', 'Masters\MasterFileController@destroy')->name('master.masterfile.destroy');
        });

        Route::group(['prefix' => 'departemen', 'middleware' => ['checkDep:HRD,IT']], function(){
            Route::get('/', 'Masters\DepartemenController@index')->name('master.departemen.index');
            Route::get('/form', 'Masters\DepartemenController@form')->name('master.departemen.form');
            Route::post('/store', 'Masters\DepartemenController@store')->name('master.departemen.store');
            Route::get('/{id}/edit', 'Masters\DepartemenController@form')->name('master.departemen.edit');
            Route::post('/delete', 'Masters\DepartemenController@destroy')->name('master.departemen.destroy');
            Route::put('/update', 'Masters\DepartemenController@update')->name('master.departemen.update');
        });

        Route::group(['prefix' => 'prosedur', 'middleware' => ['checkDep:QA,IT']], function(){
            Route::get('/', 'Masters\ProsedurController@index')->name('master.prosedur.index');
            Route::get('/form', 'Masters\ProsedurController@form')->name('master.prosedur.form');
            Route::post('/store',  'Masters\ProsedurController@store')->name('master.prosedur.store');
            Route::get('/{id}/edit', 'Masters\ProsedurController@form')->name('master.prosedur.edit');
            Route::put('/update', 'Masters\ProsedurController@update')->name('master.prosedur.update');
            Route::post('/destroy', 'Masters\ProsedurController@destroy')->name('master.prosedur.destroy');
            Route::get('/{id}/view', 'Masters\ProsedurController@view')->name('master.prosedur.view');
        });
    });

    // change kdoe verivikasi
    Route::group(['prefix' => '/kodeverifikasi'], function(){
        Route::get('/', 'KodeVerivikasiController@index')->name('kode.verifikasi');
        Route::post('/change', 'KodeVerivikasiController@change')->name('kode.verifikasi.change');
    });

    // notif
    route::get('/readnotif/{id}', 'NotifikasiController@readnotif')->name('readnotif');
    route::get('/clicknotif', 'NotifikasiController@clicknotif')->name('clicknotif');

    // mixing
    Route::group(['prefix' => 'mixing'], function(){
        Route::group(['prefix' => 'customers'], function(){
            Route::get('/', 'Mixing\CustomersController@index')->name('mixing.customers');
            Route::get('/form', 'Mixing\CustomersController@form')->name('mixing.customers.form');
            Route::post('/add', 'Mixing\CustomersController@add')->name('mixing.customers.add');
            Route::get('/edit', 'Mixing\CustomersController@edit')->name('mixing.customers.edit');
            Route::get('/{id}/view', 'Mixing\CustomersController@view')->name('mixing.customers.view');
            Route::post('/update', 'Mixing\CustomersController@update')->name('mixing.customers.update');
            Route::post('/delete', 'Mixing\CustomersController@delete')->name('mixing.customers.delete');     
        });
    
        Route::group(['prefix' => 'mixing'], function(){
            Route::get('/', 'Mixing\MixingController@index')->name('mixing.mixing');
            Route::get('/form', 'Mixing\MixingController@form')->name('mixing.mixing.form');
            Route::get('/fill', 'Mixing\MixingController@fill')->name('mixing.mixing.fill');
            Route::get('/showProduct', 'Mixing\MixingController@showProduct')->name('mixing.mixing.showProduct');
            Route::get('/showBase', 'Mixing\MixingController@showBase')->name('mixing.mixing.showBase');
            Route::get('/showFormula', 'Mixing\MixingController@showFormula')->name('mixing.mixing.showFormula');
            Route::post('/add', 'Mixing\MixingController@add')->name('mixing.mixing.add');
            Route::post('/delete', 'Mixing\MixingController@delete')->name('mixing.mixing.delete');
            Route::get('/view', 'Mixing\MixingController@view')->name('mixing.mixing.view');
            Route::get('/{id}/reorder', 'Mixing\MixingController@reorder')->name('mixing.mixing.reorder');
        });
    
        Route::group(['middleware' => ['auth', 'checkDep:IT']], function(){        
            Route::group(['prefix' => 'merk'], function(){
                Route::get('/', 'Mixing\MerkController@index')->name('mixing.merk');
                Route::get('/form', 'Mixing\MerkController@form')->name('mixing.merk.form');
                Route::post('/add', 'Mixing\MerkController@add')->name('mixing.merk.add');
                Route::get('/edit', 'Mixing\MerkController@edit')->name('mixing.merk.edit');
                Route::post('/update', 'Mixing\MerkController@update')->name('mixing.merk.update');
                Route::post('/delete', 'Mixing\MerkController@delete')->name('mixing.merk.delete');
            });
    
            Route::group(['prefix' => 'product'], function(){
                Route::get('/', 'Mixing\ProductController@index')->name('mixing.product');
                Route::get('/form', 'Mixing\ProductController@form')->name('mixing.product.form');
                Route::post('/add', 'Mixing\ProductController@add')->name('mixing.product.add');
                Route::get('/edit', 'Mixing\ProductController@edit')->name('mixing.product.edit');
                Route::post('/update', 'Mixing\ProductController@update')->name('mixing.product.update');
                Route::post('/delete', 'Mixing\ProductController@delete')->name('mixing.product.delete');
                Route::get('/showBase', 'Mixing\ProductController@showBase')->name('mixing.product.showBase');
            });

            Route::group(['prefix' => 'base'], function(){
                Route::get('/', 'Mixing\BaseController@index')->name('mixing.base');
                Route::get('/{productId}/form', 'Mixing\BaseController@form')->name('mixing.base.form');
                Route::post('/add', 'Mixing\BaseController@add')->name('mixing.base.add');
                Route::get('/edit', 'Mixing\BaseController@edit')->name('mixing.base.edit');
                Route::post('/update', 'Mixing\BaseController@update')->name('mixing.base.update');
                Route::post('/delete', 'Mixing\BaseController@delete')->name('mixing.base.delete');
            });
    
            Route::group(['prefix' => 'formula'], function(){
                Route::get('/', 'Mixing\FormulaController@index')->name('mixing.formula');
                Route::get('/form', 'Mixing\FormulaController@form')->name('mixing.formula.form');
                Route::get('/{merkId}/form', 'Mixing\FormulaController@formByMerk')->name('mixing.formula.formbymerk');
                Route::get('/{id}/detail', 'Mixing\FormulaController@detail')->name('mixing.formula.detail');
                Route::get('/edit', 'Mixing\FormulaController@edit')->name('mixing.formula.edit');
                Route::post('/add', 'Mixing\FormulaController@add')->name('mixing.formula.add');
                Route::put('/update', 'Mixing\FormulaController@update')->name('mixing.formula.update');
                Route::post('/delete', 'Mixing\FormulaController@delete')->name('mixing.formula.delete');
            });
        });
    });

    // penilaian kinerja karyawan
    Route::group(['prefix' => 'pkk'], function(){
        Route::group(['prefix' => 'periode', 'middleware' => ['checkDep:HRD,IT']], function(){
            Route::get('/', 'PKK\PeriodeController@index')->name('pkk.periode');
            Route::get('/form', 'PKK\PeriodeController@form')->name('pkk.periode.form');
            Route::post('/add', 'PKK\PeriodeController@add')->name('pkk.periode.add');
            Route::get('/edit', 'PKK\PeriodeController@edit')->name('pkk.periode.edit');
            Route::get('/{id}/status', 'PKK\PeriodeController@status')->name('pkk.periode.status');
            Route::post('/update', 'PKK\PeriodeController@update')->name('pkk.periode.update');
            Route::post('/delete', 'PKK\PeriodeController@delete')->name('pkk.periode.delete');     
        });

        Route::group(['prefix' => 'kuisioner', 'middleware' => ['checkDep:HRD,IT']], function(){
            Route::get('/', 'PKK\KuisionerController@index')->name('pkk.kuisioner');
            Route::get('/form', 'PKK\KuisionerController@form')->name('pkk.kuisioner.form');
            Route::post('/add', 'PKK\KuisionerController@add')->name('pkk.kuisioner.add');
            Route::get('/edit', 'PKK\KuisionerController@edit')->name('pkk.kuisioner.edit');
            Route::get('/{id}/status', 'PKK\KuisionerController@status')->name('pkk.kuisioner.status');
            Route::post('/update', 'PKK\KuisionerController@update')->name('pkk.kuisioner.update');
            Route::post('/delete', 'PKK\KuisionerController@delete')->name('pkk.kuisioner.delete');     
        });

        Route::group(['prefix' => 'indikator', 'middleware' => ['checkDep:HRD,IT']], function(){
            Route::get('/', 'PKK\IndikatorController@index')->name('pkk.indikator');
            Route::get('/form', 'PKK\IndikatorController@form')->name('pkk.indikator.form');
            Route::post('/add', 'PKK\IndikatorController@add')->name('pkk.indikator.add');
            Route::get('/edit', 'PKK\IndikatorController@edit')->name('pkk.indikator.edit');
            Route::get('/{id}/status', 'PKK\IndikatorController@status')->name('pkk.indikator.status');
            Route::post('/update', 'PKK\IndikatorController@update')->name('pkk.indikator.update');
            Route::post('/delete', 'PKK\IndikatorController@delete')->name('pkk.indikator.delete');     
        });

        Route::group(['prefix' => 'penilaian'], function(){
            Route::get('/', 'PKK\PenilaianController@index')->name('pkk.penilaian');
            Route::get('/form', 'PKK\PenilaianController@form')->name('pkk.penilaian.form');
            Route::post('/add', 'PKK\PenilaianController@add')->name('pkk.penilaian.add');
            Route::get('/edit', 'PKK\PenilaianController@edit')->name('pkk.penilaian.edit');
            Route::get('/{id}/status', 'PKK\PenilaianController@status')->name('pkk.penilaian.status');
            Route::post('/update', 'PKK\PenilaianController@update')->name('pkk.penilaian.update');
            Route::post('/delete', 'PKK\PenilaianController@delete')->name('pkk.penilaian.delete');     
            Route::post('/delete', 'PKK\PenilaianController@delete')->name('pkk.penilaian.delete'); 
            Route::post('/poling', 'PKK\PenilaianController@poling')->name('pkk.penilaian.poling'); 
            Route::group(['prefix' => 'poling'], function(){
                Route::post('/', 'PKK\PolingController@index')->name('pkk.penilaian.poling'); 
                Route::post('/add', 'PKK\PolingController@add')->name('pkk.penilaian.poling.add');   
            });   

            // Penilaian Kepala Bagian
            Route::group(['prefix' => 'kabag'], function(){
                Route::get('/', 'PKK\PenilaianKepalaBagianController@index')->name('pkk.penilaian.kabag');
                Route::post('/store', 'PKK\PenilaianKepalaBagianController@store')->name('pkk.penilaian.kabag.store');
            });
        });

        Route::group(['prefix' => 'kanidat'], function(){
            Route::get('/{periodeId}/import', 'PKK\KanidatController@import')->name('pkk.kanidat.import');
            Route::get('/{id}/edit', 'PKK\KanidatController@edit')->name('pkk.kanidat.edit');
            Route::put('/update', 'PKK\KanidatController@update')->name('pkk.kanidat.update');
            Route::post('/destroy', 'PKK\KanidatController@destroy')->name('pkk.kanidat.destroy');
        });

        Route::group(['prefix' => 'penilaian-bestemployee'], function(){
            Route::get('/', 'PKK\PenilaianEmployeeController@index')->name('pkk.bestemp.index');
            Route::post('/validasi', 'PKK\PenilaianEmployeeController@validasi')->name('pkk.bestemp.validasi');
            Route::post('/store', 'PKK\PenilaianEmployeeController@store')->name('pkk.bestemp.store');
            Route::get('/penilaian', 'PKK\PenilaianEmployeeController@penilaian')->name('pkk.bestemp.penilaian');
            Route::get('/{periodeId}/import', 'PKK\PenilaianEmployeeController@import')->name('pkk.bestemp.import');
        });
    });
});


// Backend
Route::group(['prefix' => '/backend'], function(){
    Route::get('/', 'HomeController@backend');
    Route::post('/postlogin', 'AuthController@postloginbackend');

    Route::group(['middleware' => ['checkUser:it']], function(){
        Route::get('/logout', 'AuthController@logoutbackend');
    
        // scoreboard
        Route::group(['prefix' => '/scoreboard'], function(){
            Route::get('/', 'ScoreboardController@index');
            Route::post('/save', 'ScoreboardController@save');
        });

        // User
        Route::group(['prefix' => 'user'], function(){
            Route::get('/', 'UserController@index')->name('backend.user');
            Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
            Route::put('/update', 'UserController@update');
            Route::post('/save', 'UserController@save');
            Route::get('/reset/{id}', 'UserController@resetPassword');
            Route::get('/nonactive/{id}', 'UserController@nonactive');
            Route::get('/active/{id}', 'UserController@active');
        });

        // Karyawan
        Route::group(['prefix' => 'karyawan'], function(){
            Route::get('/', 'KaryawanAllController@index')->name('karyawan.all');
            Route::get('/resetall', 'KaryawanAllController@resetAll');
            Route::post('/save', 'KaryawanAllController@save');
            Route::post('/import', 'KaryawanAllController@import')->name('karyawan.all.import');
            Route::get('/edit/{id}', 'KaryawanAllController@edit');
            Route::put('/update', 'KaryawanAllController@update');
            Route::get('/delete/{id}', 'KaryawanAllController@delete');
            Route::get('/reset/{id}', 'KaryawanAllController@reset');
        });

        // cabang
        Route::group(['prefix' => 'cabang'], function(){
            Route::get('/', 'CabangController@index');
            Route::post('/save', 'CabangController@save');
            Route::get('/edit/{id}', 'CabangController@edit');
            Route::put('/update', 'CabangController@update');
            Route::get('/delete/{id}', 'CabangController@delete');
        });

        // kodebarang
        Route::group(['prefix' => 'kodebarang'], function(){
            Route::get('/', 'KodeBarangController@index');
            Route::post('/save', 'KodeBarangController@save');
        });

        // ultah
        Route::group(['prefix' => 'ultah'], function(){
            Route::get('/', 'UltahController@index');
            Route::post('/save', 'UltahController@save');
        });
    });
});