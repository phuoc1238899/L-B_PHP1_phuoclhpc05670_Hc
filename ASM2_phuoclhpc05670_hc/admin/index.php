<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./assets/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="./assets/dist/css/css.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php
    include "components/preloader.php";
    ?>
    <?php
    include "components/navbar.php";
    ?>
    <?php
    include "components/sidebar.php"
    ?>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">

          <?php

          if (isset($_GET["pages"])) {
            switch ($_GET["pages"]) {
              case "categorie":

                switch ($_GET['action']) {
                  case "list":
                    include "modules/categorie/list.php";
                    break;
                  case "add":
                    include "modules/categorie/add.php";
                    break;
                  case "edit":
                    include "modules/categorie/edit.php";
                    break;
                  default:
                    include "modules/categorie/list.php";
                    break;
                }

                break;

              case "user":

                switch ($_GET['action']) {
                  case "list":
                    include "modules/user/list.php";
                    break;
                  default:
                    include "modules/user/list.php";
                    break;
                }

                break;

              case "product":

                switch ($_GET['action']) {
                  case "list":
                    include "modules/product/list.php";
                    break;
                  case "add":
                    include "modules/product/add.php";
                    break;
                  case "edit":
                    include "modules/product/edit.php";
                    break;
                  default:
                    include "modules/product/list.php";
                    break;
                }

                break;

              default:
                include "pages/dashboard.php";
                break;
            }
          } else {

            include "pages/dashboard.php";
          }
          ?>

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="./assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/plugins/chart.js/Chart.min.js"></script>
  <script src="./assets/plugins/sparklines/sparkline.js"></script>
  <script src="./assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="./assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <script src="./assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <script src="./assets/plugins/moment/moment.min.js"></script>
  <script src="./assets/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="./assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="./assets/plugins/summernote/summernote-bs4.min.js"></script>
  <script src="./assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="./assets/dist/js/adminlte.js"></script>
  <script src="./assets/dist/js/demo.js"></script>
  <script src="./assets/dist/js/pages/dashboard.js"></script>
  <script>
    $(function() {
      // Summernote
      $('#summernote').summernote()

      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>