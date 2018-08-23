@extends('layouts.main')

@section('content')
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">@{{title}}</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>รายการผ้าเซตห้องคลอด</span>
        <a class="btn btn-primary pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New
        </a>
    </div>

    <hr />
    <!-- page title -->
  
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 3%; text-align: center;">#</th>
                        <th style="width: 3%; text-align: center;">ID</th>
                        <th style="width: 20%; text-align: center;">รายละเอียด</th>        
                        <th style="width: 6%; text-align: center;">สี</th>
                        <th style="width: 6%; text-align: center;">จำนวน</th>
                        <th style="width: 6%; text-align: center;">ซื้อปีล่าสุด</th>
                        <th style="width: 10%; text-align: center;">หมายเหตุ</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>

                    <?php $cx = 0; ?>
                    @foreach($drapes as $drape)

                    <tr>
                        <td style="text-align: center;">
                            {{ ++$cx }}
                        </td>
                        <td style="text-align: center;">
                            {{ $drape->id }}
                        </td>
                        <td>
                            <a href="{{ url('/maintainedofdrape') }}/">
                                {{ $drape->name }}
                            </a>
                        </td>
                        <td style="text-align: center;">
                            {{ $drape->color }}
                        </td>
                        <td style="text-align: center;">
                            {{ $drape->stock_amt }}
                        </td>
                        <td style="text-align: center;">
                            {{ $drape->last_year }}
                        </td>
                        <td style="text-align: center;">
                            
                        </td>
                        <td style="text-align: center;">
                            <a href="" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($drapes->currentPage() !== 1)
                    <li>
                        <a href="{{ $drapes->url($drapes->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$drapes->lastPage(); $i++)
                    <li class="{{ ($drapes->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $drapes->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($drapes->currentPage() !== $drapes->lastPage())
                    <li>
                        <a href="{{ $drapes->url($drapes->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</div>
@endsection
