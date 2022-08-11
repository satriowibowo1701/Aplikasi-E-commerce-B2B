<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<style>
    .dt-button.green {

        color: black;
    }

    .dt-button.red {

        color: black;
    }

    .dt-button.black {
        color: black;
    }
</style>

<div id="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="col-md-12 col-md-6 col-lg-6">
                    <form class="mt-3" method="post" id="form" actions="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-default" style="background-color:white;color:black;border:0;" type="button">Pilih Tanggal</button>
                            </div>
                            <input type="text" class="form-control shawCalRanges" name="rangetgl" id="rangetgl">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button" id="btn-filter" style="background-color:dodgerblue;">Set</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions">
                        <!-- <a class=""><i class="ti-plus"></i></a> -->
                        <!-- <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a> -->
                    </div>
                    <h4 class="card-title mb-0"> Tabungan Siswa</h4>
                </div>
                <div class="card-body ">
                    <div class="table-responsive no-wrap">
                        <table class="table table-bordered table-striped nowrap display" width="100%" cellspacing="0" id="table-id">
                            <thead>
                                <tr>
                                    <th class="border-0 text-center">No</th>
                                    <th class="border-0 text-center">Nama Pelanggan</th>
                                    <th class="border-0 text-center">Nomer Orderan</th>
                                    <th class="border-0 text-center">Tanggal Orderan</th>
                                    <th class="border-0 text-center">Jumlah Orderan</th>
                                    <th class="border-0 text-center">Total Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>
                                <tr>
                                    <td class="text-center">Garrett Winters</td>
                                    <td class="text-center">Accountant</td>
                                    <td class="text-center">Tokyo</td>

                                </tr>

                            </tbody>


                            <tfoot>
                                <tr class="bg-dark text-white">
                                    <th style="text-align:center" colspan="4" >Total</th>
                                    <th style="text-align:center"> Total</th>
                                    <th style="text-align:center"> Total</th>
                                </tr>
                                
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->



    </div>



    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script>
        /*******************************************/
        // Always Show Calendar on Ranges
        /*******************************************/
        $('.shawCalRanges').daterangepicker({
            autoApply: true,

            locale: {
                format: 'YYYY-MM-DD',
                separator: " s.d "

            },
            startDate: moment().subtract(7, 'day'),

            ranges: {
                'Hari ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 hari yang lalu': [moment().subtract(6, 'days'), moment()],
                '30 hari yang lalu': [moment().subtract(29, 'days'), moment()],
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },

        });
    </script>



    <script type="text/javascript">
        $('#btn-filter').click(function() { //button filter event click
            $('#form').submit(); //submit form
        });
        $(document).ready(function() {

            //datatables
            $('#table-id').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 Data', '25 Data', '50 Data', 'Tampilkan Semua']
                ],
                buttons: [{
                        extend: 'pageLength',
                        text: 'Tampilkan Data   <i class="fa fa-caret-down ml-2"></i>',

                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-save"></i> Save As',
                        className: ['custom-html-collection', 'red'],
                        buttons: [{
                                extend: 'excelHtml5',
                                text: '<i class="fas fa-file-excel style="width:100px;" style="font-size:20px;color:green"></i> Excel',
                                className: 'green',
                                title: 'Data-Data',
                                filename: 'Data-Data',
                                exportOptions: {
                                    columns: [0, 1]
                                }


                            },
                            {
                                extend: 'csvHtml5',
                                className: 'green',
                                text: '<i class="fas fa-file-csv" style="font-size:20px;color:green"></i> CSV',
                                title: 'Data-Data',

                            },
                            {
                                extend: 'pdfHtml5',
                                className: 'red',
                                text: '<i class="fas fa-file-pdf" style="font-size:20px;color:red"></i> PDF',
                                title: 'Data-Data',

                            },
                            {
                                extend: 'print',
                                className: 'black',
                                text: '<i class="fa fa-print style="font-size:20px;"" ></i> Print',
                                title: 'Data-Data',

                            },
                        ],
                    },


                ],
                "pagingType": "full_numbers",

                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari Data",
                    "zeroRecords": "Data Tidak Ada",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                        "first": "Pertama",
                        "last": "Terakhir"
                    },

                },





            });

        });
    </script>