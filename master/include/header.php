<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/master/include/validation.css">
    <!--<link rel="stylesheet" href="js/multiselect/jquery.multiselect.css">-->
    <style>  
        
  
        table td {
            max-width: 120px;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-break: break-all;
            overflow: hidden;
        }

        body.dark table thead{
            background-color: rgb(8, 35, 61);
        }
        body.dark  .dataTables_length  label,  body.dark  .dataTables_filter  label{
            color: white !important;
        }

        body.dark .dataTables_filter label input, body.dark  .dataTables_length  label select{
            background-color: rgb(61, 68, 73);
            border: solid 1px rgb(61, 68, 73);
            color: white;
        }

        body.dark table tbody tr:nth-child(even){
            background-color: rgb(61, 68, 73);
        }

        body.dark table tbody tr td{
            color: white;
            
        }

        body.dark table tbody tr:hover {
             background-color: #3282b8;
        }
        
        body.dark .container .pagination li a{
            background-color: rgb(61, 68, 73) !important;
            
        }

        body.dark .container .pagination li.active a, body.dark .container .pagination li a:hover{
            background-color: rgb(37, 142, 217) !important;
        }

        body.dark .container .pagination li a:not(li.disabled a), body.dark .container .dataTables_info, body.dark .panel-heading h1{
            color: white;
        }

         .form-select option{
            height: 10px !important;
            width: 100%;
        }

        .action{
            padding : 1px 10px 1px 10px ;
        }

        .action .btn-icon {
            background-color: transparent !important; 
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .view i {
            color: green;
        }

        .edit i {
            color: orange;
        }

        .delete i {
            color: red;
        }


        body.dark .studentDetails table th {  
            background-color: rgb(8, 35, 61);
            color: #fff;
            
        }
        body.dark .studentDetails table td {  
            background: #2C2E28;
            color: #fff;
            
        }

        .studentDetails table th,
        .studentDetails table td {
            background: #fff;
            border: 1px solid #ccc;
        }

        .studentDetails th:nth-child(-n+3),
        .studentDetails td:nth-child(-n+3) {
            position: sticky !important;
            left: 0 !important;
            z-index: 2 !important;
        }

        .studentDetails th:nth-child(1),
        .studentDetails td:nth-child(1) {
            z-index: 3 !important;
        }

        .studentDetails th:nth-child(2),
        .studentDetails td:nth-child(2) {
            left: 60px !important; /* Adjust this value based on the width of your first column */
        }

        .studentDetails th:nth-child(3),
        .studentDetails td:nth-child(3) {
            left: 213px !important; /* Adjust this value based on the width of your first two columns */
        }

        /*Body White*/
        .studentDetails td:nth-child(3), 
        .studentDetails td:nth-child(2), 
        .studentDetails td:nth-child(1){
            background-color: #FEF9EB;
        }
        .studentDetails th:nth-child(3), 
        .studentDetails th:nth-child(2), 
        .studentDetails th:nth-child(1){
            background-color: #EBEBEB;
        }

        /*Body Dark*/
        body.dark .studentDetails td:nth-child(3), 
        body.dark .studentDetails td:nth-child(2), 
        body.dark .studentDetails td:nth-child(1){
            background-color: #3F3F40 !important;
        }
        body.dark .studentDetails th:nth-child(3), 
        body.dark .studentDetails th:nth-child(2), 
        body.dark .studentDetails th:nth-child(1){
            background-color: #301E4B;
        }

        body.dark .studentDetails table tbody tr:nth-child(even) > td {
            background-color: rgb(61, 68, 73);
        }

    /*        
        .dropdown-menu {
        max-height: 200px;
        overflow-y: auto;
        }
        .form-check-label {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        }

        .dropdownUser {
            width: 12rem;
            height: 1.5rem;
            font-size: 1.3rem;
            padding: 0.6 0.5rem;
            background-color: aqua;
            cursor: pointer;
            border-radius: 10px;
            border: 2px solid yellow;
        }
        #userPermission {
            margin: 0.5rem 0;
            width: 12rem;
            background-color: lightgrey;
            display: none;
            flex-direction: column;
            border-radius: 12px;
        }
        #userPermission label {
            padding: 0.2rem;
        }
        #userPermission label:hover {
            background-color: aqua;
        }
        .userPermissionBtn{
            font-size: 1rem;
            border-radius: 10px;
            padding: 0.5rem;
            background-color: yellow;
            border: 2px solid green;
            margin: 1rem 0;
        }
    */

    .admissionPic {
    display: flex;
    flex-direction: column;
    align-items: center;
}

    .admissionPic .image-container {
        position: relative;
        display: inline-block;
    }

    .admissionPic .image-container input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }


    </style>
    
    <title>Mahamaya Foundation</title>
    
  </head>
  <body>