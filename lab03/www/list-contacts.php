<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contacts</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">     
    <link href="/css/sticky-footer.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">   
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="/list-contacts.php">
                    Contacts
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Page Content --> 
    <div class="container">
        <section id="inner" class="inner-section section">
                <!-- SECTION HEADING -->
                <h2 class="section-heading text-center wow fadeIn" data-wow-duration="1s">Contacts</h2>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <p class="wow fadeIn" data-wow-duration="2s">View your all contacs here.</p>
                    </div>
                </div>

                <div class="inner-wrapper row">
                    <div class="col-md-12">

                        <a href="/add-contact.php" class="btn btn-primary" style="margin-bottom: 30px;">
                            <i class="fa fa-plus"></i> New Contact</a>

                        <!-- Table Starts Here -->
                        <table id="contacts" class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Date Created</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- Table Ends Here -->
                    </div>
                </div>
        </section>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright &copy; 2016 Web Development Course</p>
      </div>
    </footer>    

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script>
        $(document).ready(function(){
            new WOW().init();
            $('#contacts').DataTable();           
        });
    </script>
</body>
</html>
