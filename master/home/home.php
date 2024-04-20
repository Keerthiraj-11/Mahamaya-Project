
<?php include('../sidebar.php'); ?>
<section class="home">
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


    /*Home Page */
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap");

/* fonts: font-bold, font-normal

### Headings, Call-to-actions, Header Navigation
font-family: "Raleway", sans-serif; 400, 700

### Body
font-family: "Open Sans", sans-serif; 400, 700 

*/

/* colors:

### Primary

- Dark Blue (intro and email sign up background): hsl(217, 28%, 15%) - #1c2431
- Dark Blue (main background): hsl(218, 28%, 13%) - #181f2a
- Dark Blue (footer background): hsl(216, 53%, 9%) - #0b1523
- Dark Blue (testimonials background): hsl(219, 30%, 18%) - #202a3c

### Accent

- Cyan (inside call-to-action gradient): hsl(176, 68%, 64%) - #65e2d9
- Blue (inside call-to-action gradient): hsl(198, 60%, 50%) - #339ecc
- Light Red (error): hsl(0, 100%, 63%) - #ff4242

### Neutral

- White: hsl(0, 0%, 100%) - #ffffff

*/

.homePage nav ul li,
.homePage section p,
.homePage div p {
	font-family: "Open Sans", sans-serif;
	font-weight: 400;
}

.homePage section button,
.homePage div button {
	font-weight: 700;
}

.homePage section h1,
.homePage div h2 {
	font-family: "Raleway", sans-serif;
	font-weight: 700;
}

.homePage .custom-hover:hover {
	background-color: #65e2d9;
}

    </style>
    
    <title>Hello, world!</title>
    
  </head>
  <body class="min-h-screen bg-[#181f2a] homePage">

	<!-- Navigation -->

	<nav class="bg-[#1c2431] flex items-center justify-between py-6 px-5 sm:p-10">
		<a href="#" class="logo"><img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/logo.svg" alt="logo" class="w-20"></a>
		<ul class="links flex gap-5 text-[#ffffff] text-[0.8rem]">
			<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#" class="nav-link">Features</a></li>
			<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#" class="nav-link">Team</a></li>
			<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#" class="nav-link">Sign In</a></li>
		</ul>
	</nav>

	<!-- Main -->

	<main class="text-[#ffffff] text-center">

		<section class="bg-[#1c2431]">

			<div class="relative mb-[-5.72rem]">
				<img src="https://github.com/Deepali25-K/fylo-dark-theme-landing-page/blob/main/images/illustration-intro.png?raw=true" alt="" class="w-[20rem] pb-10 pt-6 m-auto relative z-10">
				<div><img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/bg-curvy-desktop.svg" alt="" class="absolute z-0 top-[14rem] w-full"></div>
				<img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/bg-curvy-desktop.svg" alt="" class="absolute z-0 top-[14rem]">
				<h1 class="text-[1.6rem] pb-4 relative z-10 px-5 sm:px-[6rem]">All your files in one secure location, accessible anywhere.</h1>
			</div>

			<div class="bg-[#181f2a] px-5 pb-6 mt-0">
				<p class="text-[0.9rem] w-[18.8rem] pt-[4.5rem] pb-4 m-auto sm:w-[24rem]">Fylo stores all your most important files in one secure location. Access them wherever
					you need, share and collaborate with friends family, and co-workers.</p>
				<button class="w-[15rem] text-[0.95rem] bg-gradient-to-r from-[#65e2d9] to-[#339ecc] hover:from-[#65e2d9] custom-hover py-4 px-6 rounded-[2rem] my-5">Get Started</button>
			</div>

		</section>

		<!-- Cards -->

		<div class="flex flex-col items-center justify-center flex-wrap sm:flex-row sm:gap-10 bg-[#181f2a] mt-[-5rem] px-5">

			<div class="text-center py-[5rem] max-w-[20rem] md:w-[50%]">
				<img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/icon-access-anywhere.svg" alt="icon-access-anywhere" class="mx-auto">
				<h2 class="text-[1.2rem] mt-8 mb-2">Access your files, anywhere</h2>
				<p class="text-[0.9rem]">The ability to use a smartphone, tablet, or computer to access your account means your
					files follow you everywhere.</p>
			</div>

			<div class="text-center pb-[5rem] max-w-[20rem] md:w-[50%]">
				<img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/icon-security.svg" alt="icon-security" class="mx-auto mt-8 mb-2">
				<h2 class="text-[1.2rem] mt-8 mb-2">Security you can trust</h2>
				<p class="text-[0.9rem]">2-factor authentication and user-controlled encryption are just a couple of the security
					features we allow to help secure your files.</p>
			</div>

			<div class="text-center pb-[5rem] max-w-[20rem] md:w-[50%]">
				<img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/icon-collaboration.svg" alt="icon-collaboration" class="mx-auto mt-8 mb-2">
				<h2 class="text-[1.2rem] mt-8 mb-2">Real-time collaboration</h2>
				<p class="text-[0.9rem]">Securely share files and folders with friends, family and colleagues for live collaboration.
					No email attachments required..</p>
			</div>

			<div class="text-center pb-[5rem] max-w-[20rem] md:w-[50%]">
				<img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/icon-any-file.svg" alt="icon-any-file" class="mx-auto mt-8 mb-2">
				<h2 class="text-[1.2rem] mt-8 mb-2">Store any type of file</h2>
				<p class="text-[0.9rem]">Whether you're sharing holidays photos or work documents, Fylo has you covered allowing for all
					file types to be securely stored and shared.</p>
			</div>

		</div>

		<section class="px-5 py-[5rem] text-left sm:text-center sm:px-[6rem]">
			<img src="https://github.com/Deepali25-K/fylo-dark-theme-landing-page/blob/main/images/illustration-stay-productive.png?raw=true" alt="" class="w-[20rem] mx-auto mb-12">
			<h1 class="text-[1.2rem]">Stay productive, wherever you are</h1>
			<p class="text-[0.9rem] my-4">Never let location be an issue when accessing your files. Fylo has you covered for all of your file
				storage needs.</p>
			<p class="text-[0.9rem] mb-4">Securely share files and folders with friends, family and colleagues for live collaboration. No email
				attachments required.</p>
			<div class="flex items-end justify-space-between border-b border-[#65e2d9] w-[9rem] gap-2 pb-2 hover:border-[#ffffff] transition duration-300 ease-in-out sm:mx-auto"><a href="#" class="text-[#65e2d9] text-[0.85rem] hover:text-[#ffffff] transition duration-300 ease-in-out">See how Fylo works<i class="fa-solid fa-circle-arrow-right ml-2"></i></a></div>

		</section>

		<!-- Testimonials Section -->

		<div class="mt-[4rem] mb-[18rem] px-8 sm:px-[6rem]">
			<div class="bg-[#202a3c] w-full text-left px-5 py-6">
				<p class="text-[0.74rem] mb-6">Fylo has improved our team productivity by an order of magnitude. Since making the switch our team has
					become a well-oiled collaboration machine.</p>
				<div class="flex items-center gap-2">
					<img src="https://github.com/Deepali25-K/fylo-dark-theme-landing-page/blob/main/images/profile-1.jpg?raw=true" alt="" class="w-[2rem] rounded-full">
					<div class="flex flex-col items-start">
						<p class="text-[0.8rem] font-bold tracking-wide">Satish Patel</p>
						<p class="text-[0.6rem]">Founder &amp; CEO, Huddle</p>
					</div>
				</div>
			</div>

			<div class="bg-[#202a3c] w-full text-left px-5 py-6 my-6">
				<p class="text-[0.74rem] mb-6">Fylo has improved our team productivity by an order of magnitude. Since making the switch our team has
					become a well-oiled collaboration machine.</p>
				<div class="flex items-center gap-2">
					<img src="https://github.com/Deepali25-K/fylo-dark-theme-landing-page/blob/main/images/profile-2.jpg?raw=true" alt="" class="w-[2rem] rounded-full">
					<div class="flex flex-col items-start">
						<p class="text-[0.8rem] font-bold tracking-wide">Bruce McKenzie</p>
						<p class="text-[0.6rem]">Founder &amp; CEO, Huddle</p>
					</div>
				</div>
			</div>

			<div class="bg-[#202a3c] w-full text-left px-5 py-6">
				<p class="text-[0.74rem] mb-6">Fylo has improved our team productivity by an order of magnitude. Since making the switch our team has
					become a well-oiled collaboration machine.</p>
				<div class="flex items-center gap-2">
					<img src="https://github.com/Deepali25-K/fylo-dark-theme-landing-page/blob/main/images/profile-3.jpg?raw=true" alt="" class="w-[2rem] rounded-full">
					<div class="flex flex-col items-start">
						<p class="text-[0.8rem] font-bold tracking-wide">Iva Boyd</p>
						<p class="text-[0.6rem]">Founder &amp; CEO, Huddle</p>
					</div>
				</div>
			</div>
		</div>

	</main>

	<footer class="bg-[#0b1523] text-[#ffffff] w-full px-5 absolute sm:px-10">

		<!-- Form starts here -->
		<div class="bg-[#1c2431] text-center px-6 py-6 mt-[-10rem] shadow-md rounded-lg shadow-[#0b1523] relative sm:w-[28rem] sm:mx-auto">
			<h2 class="text-[1.2rem]">Get early access today</h2>
			<p class="text-[0.88rem] mb-4">It only takes a minute to sign up and our free starter tier is extremely generous. If you have any
				questions, our support team would be happy to help you.</p>
			<form id="form" action="example.html" method="POST">
				<div>
					<input class="input w-full py-3 px-6 rounded-[2rem] my-6" type="text" id="email" name="email" placeholder="email@example.com" aria-label="e-mail" autocomplete="off">
					<p id="errorText" class="errorText"></p>
				</div>

				<button class="submit w-full text-[0.95rem] bg-gradient-to-r from-[#65e2d9] to-[#339ecc] hover:from-[#65e2d9] custom-hover py-3 px-6 rounded-[2rem]" type="submit">Get Started For Free</button>
			</form>
		</div>
		<!-- Form ends here -->

		<div class="my-8">

			<img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/logo.svg" alt="" class="mb-10 mt-[4rem] ml-4 md:mb-0">

			<div class="md:flex md:flex-wrap md:items-center md:gap-4 md:w-full md:justify-between">
				<div class="max-w-[20rem]">
					<ul class="">
						<li class="flex items-baseline gap-5 mb-5">
							<img src="https://raw.githubusercontent.com/Deepali25-K/fylo-dark-theme-landing-page/main/images/icon-location.svg" alt="Location-Icon">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
							dolore magna aliqua
						</li>
						<li class="flex items-center gap-5 mb-5">
							<img src="https://raw.githubusercontent.com/Deepali25-K/huddle-landing-page-with-alternating-feature-blocks/main/images/icon-phone.svg" alt="Phone-Icon">
							+1-543-123-4567
						</li>
						<li class="flex items-center gap-5 mb-5">
							<img src="https://raw.githubusercontent.com/Deepali25-K/huddle-landing-page-with-alternating-feature-blocks/main/images/icon-email.svg" alt="Mail-Icon">
							example@fylo.com
						</li>
					</ul>
				</div>

				<!-- 	navigation links	-->
				<ul class="my-[5rem]">
					<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#">About Us</a></li>
					<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#">Jobs</a></li>
					<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#">Press</a></li>
					<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out mb-10"><a href="#">Blog</a></li>
					<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#">Contact Us</a></li>
					<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#">Terms</a></li>
					<li class="hover:text-[#65e2d9] transition duration-300 ease-in-out"><a href="#">Privacy</a></li>
				</ul>

				<!-- 	social-media icons	-->
				<div class="flex items-center justify-center gap-2">
					<a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f border-[1px] border-white rounded-full w-8 h-8 p-2 text-center hover:text-[#65e2d9] hover:border-[#65e2d9] transition duration-300 ease-in-out"></i></a>
					<a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter border-[1px] border-white rounded-full w-8 h-8 p-2 text-center hover:text-[#65e2d9] hover:border-[#65e2d9] transition duration-300 ease-in-out"></i></a>
					<a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram border-[1px] border-white rounded-full w-8 h-8 p-2 text-center hover:text-[#65e2d9] hover:border-[#65e2d9] transition duration-300 ease-in-out"></i></a>
				</div>
			</div>

		</div>

	</footer>
<?php include('../include/footer.php'); ?>   
</section>