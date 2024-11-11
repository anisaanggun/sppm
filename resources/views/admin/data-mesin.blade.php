@extends('layouts.main')


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pantau Mesin</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/Logo.png">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="/assets/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="/assets/style.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

{{-- Navbar --}}
@include('admin/header')

{{-- Sidebar --}}
@include('admin/sidebar')

{{-- Content --}}


<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mt-2">
           <p>Data Mesin</p>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Responsive Hover Table</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Reason</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>183</td>
                        <td>John Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-success">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      </tr>
                      <tr>
                        <td>219</td>
                        <td>Alexander Pierce</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-warning">Pending</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      </tr>
                      <tr>
                        <td>657</td>
                        <td>Bob Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-primary">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      </tr>
                      <tr>
                        <td>175</td>
                        <td>Mike Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-danger">Denied</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>








{{-- Footer --}}
@include('admin/footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
</body>
</html>
