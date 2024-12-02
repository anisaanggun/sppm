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
  <link rel="stylesheet" href="/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar-->
  <link rel="stylesheet" href="/asset/plugins/fullcalendar/fullcalendar.main.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/assets/style.css">
  <link rel="stylesheet" href="/assets/bootstrap.css"/>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

{{-- Navbar --}}
@include('admin/header')

{{-- Sidebar --}}
@include('admin/sidebar')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content mt-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5">
            <div class="sticky-top mb-5">
              <div class="card" style="border-radius: 20px">
                <div class="header" style="background-color:white border-radius: 20px">
                    <h4 class="card-title" style="margin-top: 20px;"><b style="margin-left: 15px;">Jadwal Hari Ini</b><p><small style="margin-left: 15px; font-size: 14px"><b>Senin, 11 November 2024</b></small></p></h4>
                </div>

                <div class="card-body">
                  <!-- the events -->
                  <ul class="navbar-nav ml-auto">
                    <div class="sticky-top mb-2 external-event" style="background-color:#FF9B50; border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name" style="margin-left: 7px; font-size: 17px font-weight: normal;">Radiman</span>
                                <span class="phone-number"  style="font-weight: normal; font-size: 14px">+62 8123456789</span>
                            </div>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" style="color: white"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="?cs=Edit-Jadwal">
                                        <span class="text-primary">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                        </span>
                                    </a>
                                    <a class="dropdown-item" href="?cs=Hapus-Jadwal">
                                        <span class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px; display: flex; flex-direction: column;" >
                            <p><span style="margin-left: 7px; font-size: 14px">AC Midea</span><span style="margin-left: 80px; font-size: 14px">Perawatan</span></p>
                            <p><span style="margin-left: 7px; font-size: 14px">MSAF-05CRN2</span><span  style="margin-left: 42px; font-size: 14px">Jl. Kartini no 10 Sidoarjo</span></p>
                        </div>
                    </div>
                    <div class="sticky-top mb-2 external-event" style="background-color:#FFBB5C; border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name" style="margin-left: 7px; font-size: 17px font-weight: normal;">Rudiman</span>
                                <span class="phone-number"  style="font-weight: normal; font-size: 14px">+62 8123456789</span>
                            </div>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" style="color: white"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="?cs=Edit-Jadwal">
                                        <span class="text-primary">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                        </span>
                                    </a>
                                    <a class="dropdown-item" href="?cs=Hapus-Jadwal">
                                        <span class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px; display: flex; flex-direction: column;" >
                            <p><span style="margin-left: 7px; font-size: 14px">AC Daikin</span><span style="margin-left: 80px; font-size: 14px">Perawatan</span></p>
                            <p><span style="margin-left: 7px; font-size: 14px">FTC 15NV14</span><span  style="margin-left: 60px; font-size: 14px">Jl. Pahlawan no 15 Sidoarjo</span></p>
                        </div>
                    </div>
                    <div class="sticky-top mb-2 external-event" style="background-color:#FF9B50; border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name" style="margin-left: 7px; font-size: 17px font-weight: normal;">Sukiman</span>
                                <span class="phone-number"  style="font-weight: normal; font-size: 14px">+62 8123456789</span>
                            </div>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" style="color: white"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="?cs=Edit-Jadwal">
                                        <span class="text-primary">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                        </span>
                                    </a>
                                    <a class="dropdown-item" href="?cs=Hapus-Jadwal">
                                        <span class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px; display: flex; flex-direction: column;" >
                            <p><span style="margin-left: 7px; font-size: 14px">AC Gree</span><span style="margin-left: 87px; font-size: 14px">Perbaikan</span></p>
                            <p><span style="margin-left: 7px; font-size: 14px">GWC-05MOO3</span><span  style="margin-left: 42px; font-size: 14px">Jl. Patimura no 20 Sidoarjo</span></p>
                        </div>
                    </div>
                    <div class="sticky-top mb-2 external-event" style="background-color:#FFBB5C; border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name" style="margin-left: 7px; font-size: 17px font-weight: normal;">Supri</span>
                                <span class="phone-number"  style="font-weight: normal; font-size: 14px">+62 8123456789</span>
                            </div>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" style="color: white"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="?cs=Edit-Jadwal">
                                        <span class="text-primary">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                        </span>
                                    </a>
                                    <a class="dropdown-item" href="?cs=Hapus-Jadwal">
                                        <span class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px; display: flex; flex-direction: column;" >
                            <p><span style="margin-left: 7px; font-size: 14px">AC AUX</span><span style="margin-left: 90px; font-size: 14px">Perawatan</span></p>
                            <p><span style="margin-left: 7px; font-size: 14px">ASW-09A4/FHR1</span><span  style="margin-left: 29px; font-size: 14px">Jl. Kartini no 20 Sidoarjo</span></p>
                        </div>
                    </div>
                    <div class="sticky-top mb-2 external-event" style="background-color:#FF9B50; border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name" style="margin-left: 7px; font-size: 17px font-weight: normal;">Supratman</span>
                                <span class="phone-number"  style="font-weight: normal; font-size: 14px">+62 8123456789</span>
                            </div>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" style="color: white"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="?cs=Edit-Jadwal">
                                        <span class="text-primary">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                        </span>
                                    </a>
                                    <a class="dropdown-item" href="?cs=Hapus-Jadwal">
                                        <span class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px; display: flex; flex-direction: column;" >
                            <p><span style="margin-left: 7px; font-size: 14px">AC Changhong</span><span style="margin-left: 40px; font-size: 14px">Perbaikan</span></p>
                            <p><span style="margin-left: 7px; font-size: 14px">CHOL-05L</span><span  style="margin-left: 70px; font-size: 14px">Jl. Pahlawan no 34 Sidoarjo</span></p>
                        </div>
                    </div>

                </ul>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-primary">
              <div class="card-body p-0">
                <div id="calendar"></div>
              </div>
            </div>
        </div>
    </div>
</div>
</section>

{{-- Footer --}}
@include('admin/footer')



<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script src="/assets/plugins/fullcalendar/main.js"></script>
<script>
$(document).ready(function(){
    var calendarEL = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        //themeSystem: 'bootstrap',
        //Random default events
        //events: [
            //{
            //title          : 'All Day Event',
            //start          : new Date(y, m, 1),
            //backgroundColor: '#f56954', //red
            //borderColor    : '#f56954', //red
            //allDay         : true
            //},
            //{
            //title          : 'Long Event',
            //start          : new Date(y, m, d - 5),
            //end            : new Date(y, m, d - 2),
            //backgroundColor: '#f39c12', //yellow
            //borderColor    : '#f39c12' //yellow
            //},
            //{
            //title          : 'Meeting',
            //start          : new Date(y, m, d, 10, 30),
            //allDay         : false,
            //backgroundColor: '#0073b7', //Blue
            //borderColor    : '#0073b7' //Blue
            //},
            //{
            //title          : 'Lunch',
            //start          : new Date(y, m, d, 12, 0),
            //end            : new Date(y, m, d, 14, 0),
            //allDay         : false,
            //backgroundColor: '#00c0ef', //Info (aqua)
            //borderColor    : '#00c0ef' //Info (aqua)
            //},
            //{
            // title          : 'Birthday Party',
            //start          : new Date(y, m, d + 1, 19, 0),
            //end            : new Date(y, m, d + 1, 22, 30),
            //allDay         : false,
            //backgroundColor: '#00a65a', //Success (green)
            //borderColor    : '#00a65a' //Success (green)
        // },
        // {
            // title          : 'Click for Google',
            //start          : new Date(y, m, 28),
            //end            : new Date(y, m, 29),
            //url            : 'https://www.google.com/',
            //backgroundColor: '#3c8dbc', //Primary (light-blue)
            // borderColor    : '#3c8dbc' //Primary (light-blue)
        }
        ],
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        }
        });

        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
            'background-color': currColor,
            'border-color'    : currColor
        })
        })
        $('#add-new-event').click(function (e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
            return
        }

        // Create events
        var event = $('<div />')
        event.css({
            'background-color': currColor,
            'border-color'    : currColor,
            'color'           : '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)

        // Add draggable funtionality
        ini_events(event)

        // Remove event from text input
        $('#new-event').val('')
        })
    })
    </script>
    </body>
    </html>








