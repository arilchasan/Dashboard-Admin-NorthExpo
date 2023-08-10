

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin {{ auth('role_admins')->user()->username }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard Admin NorthExpo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
