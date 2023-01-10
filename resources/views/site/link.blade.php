@extends('adminlte.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Admin
            <small>Managerment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div style="overflow: auto">
            <table class="table table-responsive table-borderless">

                <thead>
                <tr class="bg-light">
                    <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="40%">Date</th>
                    <th scope="col" width="10%">Link File</th>
                    <th scope="col" width="20%">Link Youtube</th>
                    <th scope="col" width="20%">domain</th>
{{--                    <th scope="col" class="text-end" width="20%"><span>Revenue</span></th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                    <tr>
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>
                        <td>{{$link->id}}</td>
                        <td width="40%">{{$link->created_at}}</td>
                        <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">{{$link->linkfile}}</span></td>
                        <td><img src="https://i.imgur.com/VKOeFyS.png" width="25">{{$link->linkyoutube}}</td>
                        <td>/site/view?id={{$link->slug}}</td>
{{--                        <td class="text-end"><span class="fw-bolder">$0.99</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>
    <!-- /.content -->
@endsection
<style>
    @media only screen and (max-width: 600px) {
        .view-total {
            width: 100% !important;
        }
    }
</style>

