<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">
            <?php
                echo 'Welcome ' . $_SESSION['userName'] . '!';
            ?>
        </h1>
        <p class="lead">
            <?php
                if($_SESSION['userRole'] == 1) {
                    echo 'Hello Satan!';
                }
                else {
                    echo 'This application is currently still in development, please report any bits and bobs (I\'m talking about bugs) by contacting me on the forums, TS, Discord (D3M0SiXz#8799) or through mail <a href="mailto:info@subatomisch.nl">info@subatomisch.nl</a>.';
                }
            ?>
        </p>
    </div>
</div>

<div class="custom-content-wrapper">
    <div class="row mt-4">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <p>Please see the list of features that still need to be added:</p>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Auto update of division/team/roster dropdowns according to the selection in one of them.</li>
                <li class="list-group-item">Data fetch through the DI API to make the adding process easier (API is currently deprecated butsimple features can be used).</li>
                <li class="list-group-item">The ability to create new divisions</li>
                <li class="list-group-item">The ability to create new teams</li>
                <li class="list-group-item">The ability to create new rosters</li>
                <li class="list-group-item">If there is anything else that you would like to see added please contact me on the forums, TS, Discord (D3M0SiXz#8799) or through mail <a href="mailto:info@subatomisch.nl">info@subatomisch.nl</a>.</li>
            </ul>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <button type="button" class="btn btn-primary btn-lg">Primary</button>
            <button type="button" class="btn btn-success btn-lg">Success</button>
            <button type="button" class="btn btn-danger btn-lg">Danger</button>
            <button type="button" class="btn btn-warning btn-lg">Warning</button>
            <button type="button" class="btn btn-info btn-lg">Info</button>
            <button type="button" class="btn btn-dark btn-lg">Dark</button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="list-group list-group-horizontal">
                <a href="#" class="list-group-item list-group-item-action active">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small>3 days ago</small>
                    </div>
                    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    <small>Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
            </div>
        </div>
    </div>
</div>
