
        <div class="nav">
            <div class="navLeft"><div class="logoT"><i class="fas fa-home" style="margin-top: 0.4rem; margin-right: 0.4rem;"></i>Rooft.</div></div>
            <div class="navCenter">
                <a href="index.php">Home</a>
                <a href="list.php">List</a>
                <a href="test/">Contact</a>
            </div>
            <div class="navRight">
                <?php if(isset($_SESSION) && isset($_SESSION['login'])) { 
                    $users = "SELECT *
                              FROM users
                              WHERE id=?";
                    $userRes = $db->prepare($users);
                    $userRes->execute(array($_SESSION['id']));
                    $user = $userRes->fetch(PDO::FETCH_ASSOC);
                    if($userRes) { ?>
                        <button class="myBtn" onclick="location.href='logout.php';">
                        <span class="pill-primary" style="font-size: 1rem;">Logout</span>
                        </button>
                    <?php }else{ }                  
                }else{ ?>

                <button class="myBtn" id="myBtn">
                    <span class="pill-primary" style="font-size: 1rem;">Login</span>
                </button>
                <?php } ?>
                <div class="toggle-button">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </div>
        <div class="navCenter2">
        <a href="index.php">Home</a>
                <a href="list.php">List</a>
                <a href="test/">Contact</a>
                <?php if(isset($_SESSION) && isset($_SESSION['login'])) { 
                    $users = "SELECT *
                              FROM users
                              WHERE id=?";
                    $userRes = $db->prepare($users);
                    $userRes->execute(array($_SESSION['id']));
                    $user = $userRes->fetch(PDO::FETCH_ASSOC);
                    if($userRes) { ?>
                        <a href="logout.php">Logout</a>
                    <?php }else{ }                  
                }else{ ?>
                <button id="myBtn2">Login</button>
               
                </div>
        <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <form id="loginForm1" class="login">
      <div id="errors" class="none error">
      </div>
      <div class="form-group">
        <input type="text" name="loginUser" placeholder="Username/Email"/>
        <input type="password" name="loginPassword" placeholder="Password"/>
                </div>
        <div class="form-group">
        <button type="submit" name="login" class="myButton">Login</button>
                </div>
    </form>
    </div>
    <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

btn2.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
        </script>
               <script>
    $(function(){ 
        $('#loginForm1').on('submit', function(e) {
            e.preventDefault();
            let $errors = $('#errors');
            $.ajax({
                type: 'POST',
                url: 'incl/do.login.php',
                data: $(this).serialize()
            }).then(function(res) {
                try {
                    JSON.parse(res);
                }
                catch (error) {
                    console.log('Error parsing JSON:', error, res);
                }
                let data = JSON.parse(res);

                if(data.errors) {
                    $errors.removeClass('none').html(data.errors);
                    return;
                }

                localStorage.setItem('id', data.id)
                location.href='index.php';
            }).fail(function(res){
                    $errors.removeClass('none').html('Error logging in');
            })
        });
    });
</script>
    <?php } ?>
  </div>
        
<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
            const toggleBtn = document.getElementsByClassName('toggle-button')[0]
            const navC = document.getElementsByClassName('navCenter2')[0]
            
            toggleBtn.addEventListener('click', () => {
                navC.classList.toggle('active')
                navC.classList.toggle('downAnim')
            })
            
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBne4JlPQsu7hihflY8R9IYgd7pQSlaH6U&callback=initMap&v=weekly" async ></script>
        