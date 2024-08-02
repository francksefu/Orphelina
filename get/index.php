<?php flash('index'); ?>
<div class="d-flex justify-content-center align-items-center ">
        <div class="col-md-4">
        <h2 class="text-secondary text-center mt-3 pt-3">Connectez vous</h2>
            <form class='mb-2 mt-2' method="post" action="index.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nom d utilisateur</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" name='password' class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <img src='compassion.png' class='img-fluid rounded mx-auto d-block'>
        </div>
    </div>