<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="476808783359-veh2alrji9hbfjvtocmden3806mfrq9o.apps.googleusercontent.com">
<script>
    // If we made it this far on the local network, that means that we're already logged in.
    var is_local_network = <?=$is_local_network?>;
    if(is_local_network) {
        window.location = '/med_tracker';
    }

    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        var email = profile.getEmail();
        if(email == 'snakeransom@gmail.com' || email == 'mrs.kransom@gmail.com') {
            window.location = '/med_tracker';
        }
    }
</script>
<div id="main_div" class="container" >
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col" >
                    <h1>Please log in.</h1>
                    <h4 id="sign_in_label" >You must log in using a gmail address and that address must be authorized to use this site.</h4>
                </div>
            </div>
        </div>
        <div class="card-body" >
            <div class="g-signin2 py-4" data-onsuccess="onSignIn" id="sign_in_btn" ></div>
        </div>
    </div>
</div>
