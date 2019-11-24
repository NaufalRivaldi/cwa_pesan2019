@extends('admin.master')

@section('title', '- Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Dashboard</h2>
            <hr>
            <div class="card">
                <div class="card-header">
                    <h4>Pengumuman Internal</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Tanggal</th>
                                <th>Pengirim</th>
                                <th>Subject</th>
                            </thead>
                            <tbody>
                                @if(!empty($pengumuman))
                                    @foreach($pengumuman as $row)
                                        <tr>
                                            <td width="20%">
                                                <a href="{{ url('/admin/dashboard/detailp/'.$row->id) }}" class="a-block"><span class="badge badge-warning">{{ $row->tgl }}</span></a>
                                            </td>
                                            <td width="30%">
                                                <a href="{{ url('/admin/dashboard/detailp/'.$row->id) }}" class="a-block">{{ $row->user->nama.' - '.$row->user->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/dashboard/detailp/'.$row->id) }}" class="a-block">{{ $row->subject }}
                                                <?php  
                                                    $date1 = new DateTime($row->tgl);
                                                    $date2 = new DateTime($date_now);
                                                    $diff = $date1->diff($date2);
                                                ?>
                                                @if($diff->days < 2)
                                                    <span class="text-blink">New!</span>
                                                @endif
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="margin-top:1%">
                        <div class="col-12">
                            {{ $pengumuman->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection