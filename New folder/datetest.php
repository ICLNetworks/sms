	<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <style>
        #sitehtn {
            display: none
        }

        .container {
            width: 100%;
            height: 600px;
            background-color: rgb(179, 174, 174);
        }
        #datepickerT {
            margin-left: 2em;
        }
        .eventDateDiv {
            height: 150px;
            width: 30%;
            margin-left: auto;
            margin-right: auto;
        }
        #daysBetween {
            margin-top: -1.4em;
            margin-left: 30%;
        }
        .eventShowDiv {
            height: 250px;
            width: 30%;
            margin-left: auto;
            margin-right: auto;
        }
        .event {
            color: green;
            margin-top: 5px;
        }
    </style>
    <script>
        $(function() {
           
            $('#agenceRadio').change(function() {
                $('#sitehtn').show()
             });
            $('#agenceRadio1').change(function() {
                $('#sitehtn').hide()
                
            });

			
        });
    </script>
</head>
<body>
    <div class="container">
        
        <div class="eventShowDiv">
            
            <label>
                <input type="radio" name="sitewebGroup" value="Agence" id="agenceRadio" value="yes"/>Yes
                <input type="radio" name="sitewebGroup" value="Agence" id="agenceRadio1" value="no"/>No
                
            </label>
            <input type="text" name="textfield3" id="sitehtn" />
        </div> 
    </div> 
</body>
</html>
										
							
										