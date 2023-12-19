<?php
?>
    <!DOCTYPE html>

    <html lang="en">

    <head>
        <title>Language to Language Translator</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <link type="text/css" href="css/pixel.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <style>
        .footer {
            position: relative;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: red;
            color: white;
            text-align: center;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.btn-outline-primary').click(function(e) {
                e.preventDefault();
                var lang_src = $('#lang_src').val();
                var lang_target = $('#lang_target').val();
                var text = $('#text').val();
                $.ajax({
                    type: "POST",
                    url: "translate.php",
                    data: {
                        "lang_src": lang_src,
                        "lang_target": lang_target,
                        "text": text
                    },
                    success: function(data) {
                        $('.result').html(data);

                    }
                });
            });
        });
    </script>

    <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark navbar-theme-primary mb-4">
        <div class="container position-relative">
            <div class="d-flex align-items-center">
                <p class="text-white mb-0">Language Translator</p>

            </div>
            <div class="d-flex align-items-right">
                <button class="btn btn-primary bg-black text-white mb-0">Doc</button>

            </div>
        </div>
    </nav>



    <body>
        <form method="post" action="" id="contactform">

            <div class="container mt-n4" style="background-color: black;">
                <div class="row">
                    <div class="col col-md-6 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label class="my-1 mr-2 text-white" style="height: auto;" for="inlineFormCustomSelectPref">Source Language</label>
                            <select class="custom-select my-1 mr-sm-2 lang_src" name="lang_src" id="lang_src">
       
                        <option value="" disabled selected Style="text-align:center;">Select Source Language</option>
                        <option value="en">English</option>
                        <option value="kn">Kannada</option>
                        
         
                        <option value="hi">Hindi</option>
         
                        <option value="te">Telugu</option>
                        <option value="ta">Tamil</option>
                        <option value="ml">Malayalam</option>
                        <option value="gu">Gujarati</option>
                        <option value="de">German</option>
                        <option value="fr">French</option>
                        <option value="ja">Japanese</option>
                        <option value="el">Greek</option>
                        <option value="pt-BR">Portuguese (Brazil)</option>
                        <option value="nl">Dutch</option>
                    </select>
                        </div>
                    </div>
                    <div class="col col-md-6 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label class="my-1 mr-2 text-white" style="height: auto;" for="inlineFormCustomSelectPref">Target Language</label>
                            <select class="custom-select my-1 mr-sm-2 lang_target" name="lang_target" id="lang_target">
        
                      <option value="" disabled selected Style="text-align:center;">Select Your Target Language</option>
                  
                      <option value="en">English</option>
                        <option value="kn">Kannada</option>
                        <option value="hi">Hindi</option>
         
                        <option value="te">Telugu</option>
                        <option value="ta">Tamil</option>
                        <option value="ml">Malayalam</option>
                        <option value="gu">Gujarati</option>
                        <option value="de">German</option>
                        <option value="fr">French</option>
                        <option value="ja">Japanese</option>
                        <option value="el">Greek</option>
                        <option value="pt-BR">Portuguese (Brazil)</option>
                        <option value="nl">Dutch</option>
                    
         
  
    </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="background-color: black;">
                <div class="row">

                    <div class="form-group mx-3" style="width: 100%;">
                        <label class="text-white">Source Text</label>
                        <textarea class="form-control txt" id="text" placeholder="Enter Source Language Text" rows="6"></textarea>
                    </div>
                </div>

            </div>
            <div class="text-center pt-2 pb-2">

                <button class="btn btn-outline-primary " id="btn" type="button">
            Translate
            <span class="ml-1"><span class="fa fa-exchange"></span></span></button>
            </div>
        </form>

        <div class="result pb-2" id="result">

        </div>






        <footer class="footer pt-2 pb-3  bg-primary text-white text-center">
            <div class="container">


                <h6 class="pt-md-4"><b>Designed and Developed By Aradhya Pavan</b></h6>

        </footer>
    </body>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>


    </html>
    <?php
?>