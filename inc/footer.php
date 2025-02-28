 <!-- Footer -->
 <div class="container-fluid bg-white mt-5">
     <div class="row">
         <div class="col-lg-4 p-4">
             <h3 class="h-font fw-bold fs-3 mb-2">HOTEL</h3>
             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt cum,
                 optio animi eos libero blanditiis non numquam, enim adipisci laborum sunt temporibus expedita rerum porro minus repudiandae consequuntur.
                 Molestiae, necessitatibus?
             </p>
         </div>
         <div class="col-lg-4 p-4">
             <h5 class="mb-3">Links</h5>
             <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">HOME</a> <br>
             <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">ROOMS</a> <br>
             <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">FACILITIES</a> <br>
             <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">CONTACT US</a> <br>
             <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">ABOUT</a> <br>
         </div>
         <div class="col-lg-4 p-4">
             <h5 class="mb-3">Follow us</h5>
             <?php
                if ($contact_r['tw'] != '') {
                    echo <<<data
                        <a href="$contact_r[tw]" class="d-inline-block mb-2 text-dark text-decoration-none">
                            <i class="bi bi-twitter-x"></i> X
                        </a><br>
                    data;
                }
                ?>
             <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
                 <i class="bi bi-facebook"></i> Facebook
             </a><br>
             <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none">
                 <i class="bi bi-instagram"></i> Instagram
             </a><br>
         </div>
     </div>
 </div>

 <h6 class="bg-dark text-white text-center p-3 m-0">Designed and Develop by PHEAKTRA</h6>
 <script
     src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
     crossorigin="anonymous"></script>
 <script>
    function setActive(){
        let navbar=document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for(i=0; i<a_tags.length; i++){
            let file = a_tags[i].href.split("/").pop();
            let file_name =file.split('.')[0];

            if(document.location.href.indexOf(file_name) >= 0){
                a_tags[i].classList.add('active');
            }
        }
    }
    
    let register_form =document.getElementById('register-form');

    register_form.addEventListener('submit', (e)=>{
        e.preventDefault();

        let data =new FormData();

        data.append('name'),register_form.elements['name'].value;
        data.append('email'),register_form.elements['email'].value;
        data.append('phonenum'),register_form.elements['phonenum'].value;
        data.append('address'),register_form.elements['address'].value;
        data.append('pincode'),register_form.elements['pincode'].value;
        data.append('dob'),register_form.elements['dob'].value;
        data.append('pass'),register_form.elements['pass'].value;
        data.append('cpass'),register_form.elements['cpass'].value;
        data.append('profile'),register_form.elements['profile'].file[0];
        data.append('register','');

        var myModal = document.getElementById("registerModal");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);
        
        xhr.onload=function(){

        }

        xhr.send(data);
    })
    
    setActive();
 </script>