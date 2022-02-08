
<nav class="navbar navbar-expand-lg navbar-light bg-primary w-100 flex-row">
  <p class="navbar-brand w-25 d-flex">POKE2000 </p>

  <?php if (isset($_COOKIE['logged-in'])) { ?>
  
  <div class="d-flex flex-row-reverse bd-highlight w-50 ml-5" id="navbarNav">
    <ul class="navbar-nav flex-row">

        <li class="dropdown" id="pokes_dropdown">
            <a class="nav-link mr-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-hand-point-right fa-2x"></i>
            </a>
            
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <div class="spinner-border" style="display:none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <?php require_once("users_poke_list.php"); ?>

            </div>
        </li>
    
        <li class="nav-item mr-3">
            <a class="nav-link" href="edit_user.php" type="button"><i class="fas fa-user-circle fa-2x"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" type="button" id="logout" name="logout" href="logout.php?logout"><i class="fas fa-sign-out-alt fa-2x"></i></span></a>
        </li>
    </ul>
  </div>
  <?php } ?>
</nav>
