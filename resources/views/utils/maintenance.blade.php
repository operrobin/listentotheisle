<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

    <title>Maintenance</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap-grid.min.css" integrity="sha512-cKoGpmS4czjv58PNt1YTHxg0wUDlctZyp9KUxQpdbAft+XqnyKvDvcGX0QYCgCohQenOuyGSl8l1f7/+axAqyg==" crossorigin="anonymous" />

    <link 
        rel="stylesheet" 
        href="{{ asset('/css/font.css') }}"
        type="text/css" />

    <style>
        body{
            background-image: url('{{ asset('/assets/logo-muter-muter-merah-desktop.gif') }}');
            background-size: cover;

            height: 100vh;
            max-height: calc(100vh - 150px);
            font-family: Soulmaze, italic;
        }

        #caption{
            font-size: 3.445rem;
            color: #FFFFFF;
            max-height: 100vh;
            max-width: 65vw;
            font-style: italic;
        }

        #logo{
            display: none;
        }

        /**
         * Mobile View
        */
        @media only screen and (max-width: 768px){
            body{
                background: none;
                
                background-color: #F52A00;
                max-height: calc(100vh - 150px);
                max-width: calc(100vw - 0px);
            }

            #caption{
                font-size: 2.62vh;
                max-height: 100vh;
                max-width: 100vw;
            }

            #logo{
                display: block;
                width: 100vw;
                /* max-height: 30vh; */
            }
        }

        /**
        * End Of Mobile View
        */
    </style>

</head>
<body>
    <img id="logo" src="{{ asset('/assets/logo-muter-muter-merah-kotak.gif') }}" />

    <div id="caption">
        ISLE IS A COOPERATIVE ORGANIZATION DESIGNED TO SERVE THE PURPOSE OF PROVIDING VARIOUS COLLECTIVES MUSICAL GENRES, THAT ARE PROPERLY ARCHIVED IN OUR DATABASE THAT CAN BE ACCESSED BY EVERYONE. THE ORGANIZATION ALSO GIVES A WIDE RANGE OF MUSICAL KNOWLEDGE FOR OUR LISTENERS. TO BE BRIEF, ISLE IS A PROVIDER FOR LIVE MIXES THAT CAN BE HEARD  BY ALL MUSIC ENTHUSIASTS.
    </div>
</body>
</html>