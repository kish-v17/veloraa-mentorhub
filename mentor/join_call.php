<?php include('header.php');
// call.php
?>
<script src='https://8x8.vc/vpaas-magic-cookie-c4604cec7a16490fbea68e04eefd77b4/external_api.js' async></script>
<script type="text/javascript">
    window.onload = () => {
    const api = new JitsiMeetExternalAPI("8x8.vc", {
        roomName: "vpaas-magic-cookie-c4604cec7a16490fbea68e04eefd77b4/<?php echo $_GET['room_id']; ?>",
        parentNode: document.querySelector('#jaas-container'),
                    // Make sure to include a JWT if you intend to record,
                    // make outbound calls or use any other premium features!
                    // jwt: "eyJraWQiOiJ2cGFhcy1tYWdpYy1jb29raWUtYzQ2MDRjZWM3YTE2NDkwZmJlYTY4ZTA0ZWVmZDc3YjQvYjFjZmZiLVNBTVBMRV9BUFAiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJqaXRzaSIsImlzcyI6ImNoYXQiLCJpYXQiOjE3MjY4MDYyODUsImV4cCI6MTcyNjgxMzQ4NSwibmJmIjoxNzI2ODA2MjgwLCJzdWIiOiJ2cGFhcy1tYWdpYy1jb29raWUtYzQ2MDRjZWM3YTE2NDkwZmJlYTY4ZTA0ZWVmZDc3YjQiLCJjb250ZXh0Ijp7ImZlYXR1cmVzIjp7ImxpdmVzdHJlYW1pbmciOmZhbHNlLCJvdXRib3VuZC1jYWxsIjpmYWxzZSwic2lwLW91dGJvdW5kLWNhbGwiOmZhbHNlLCJ0cmFuc2NyaXB0aW9uIjpmYWxzZSwicmVjb3JkaW5nIjpmYWxzZX0sInVzZXIiOnsiaGlkZGVuLWZyb20tcmVjb3JkZXIiOmZhbHNlLCJtb2RlcmF0b3IiOnRydWUsIm5hbWUiOiJUZXN0IFVzZXIiLCJpZCI6Imdvb2dsZS1vYXV0aDJ8MTE0MzI1NTQ0MDExOTMxOTQwNzY3IiwiYXZhdGFyIjoiIiwiZW1haWwiOiJ0ZXN0LnVzZXJAY29tcGFueS5jb20ifX0sInJvb20iOiIqIn0.KcOrd2Rc-ezNTaL6G6w8x219oko2JHGxsTttZnD1hSJo7zIrN8Ebnn-RYENA1NhfAFyMfCo1Eb89zPXdsAtZL7kB6MUkY_wWhRq-u_9qpIReEkB4ypHZO7VxEF8xoHUAkRkVbHaM7yL_b5Ln4NeQTwq8mDt9bPO0XY2uDJ-EPW1QBbcVLWxPjjblOGDnLK-RtLKOMkDwq7x3sOYEZ0yhCzHUJAuiE5cxalYMIQoXe6-kIIm0broaC5jB6-aL0A-b47ol39laOB0A0GOow_e6Gq3QrgiT2HG_dMAGZ_dsggpR-jfPlLmdm9kRjbNS4TpkuupGtWdfjZzEGgpjRnq2RA"
    });
    }
</script>
        <!-- main content -->
        <div class="main-content right-chat-active">
            
            <div class="middle-sidebar-bottom">
                <div class="middle-sidebar-left pe-0 ms-0 me-0" style="max-width: 100%;">
                    <div class="row">
                        <div class="col">
                            <div class="card border-0 mb-0 rounded-3 overflow-hidden chat-wrapper bg-image-center bg-image-cover" id="jaas-container" style="background-image: url(images/video-bg-1.jpg);">
                                <!-- <div class="card-body position-absolute mt-0 ms-0 left-0">
                                    
                                    <video id="cameraVideo" autoplay playsinline class="w150 h200 rounded-3 position-relative z-index-1 shadow-xss"></video>
                                </div>
                                <div class="card-body text-center p-2 position-absolute w-100 bottom-0 bg-gradiant-bottom">
                                    <a href="#" class="btn-round-xl d-md-inline-block d-none bg-blur m-3 me-0 z-index-1"><i class="feather-grid text-white font-md"></i></a>
                                    <a href="#" class="btn-round-xl d-md-inline-block d-none bg-blur m-3 z-index-1"><i class="feather-mic-off text-white font-md"></i></a>       
                                    <a href="#" class="btn-round-xxl bg-danger z-index-1"><i class="feather-phone-off text-white font-md"></i></a>   
                                    <a href="#" class="btn-round-xl d-md-inline-block d-none bg-blur m-3 z-index-1"><i class="ti-video-camera text-white font-md"></i></a>   
                                    <a href="#" class="btn-round-xl d-md-inline-block d-none bg-blur m-3 ms-0 z-index-1"><i class="ti-settings text-white font-md"></i></a>  
                                    <span class="p-2 bg-blur z-index-1 text-white fw-700 font-xssss rounded-3 right-15 position-absolute mb-4 bottom-0">44:00</span>    
                                    <span class="live-tag position-absolute left-15 mt-2 bottom-0 mb-4 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                </div> -->
                            </div>
                        </div>              
                        <!-- <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0 ps-0">
                            <div class="card w-100 d-block chat-body p-0 border-0 shadow-xss rounded-3 mb-3 position-relative">
                                <div class="messages-content chat-wrapper scroll-bar p-3">
                                    <div class="message-item">
                                        <div class="message-user">
                                            <figure class="avatar">
                                                <img src="images/user-9.png" alt="image">
                                            </figure>
                                            <div>
                                                <h5 class="font-xssss mt-2">Byrom Guittet</h5>
                                                <div class="time">01:35 PM</div>
                                            </div>
                                        </div>
                                        <div class="message-wrap shadow-none">I'm fine, how are you ðŸ˜ƒ</div>
                                    </div>

                                    <div class="message-item">
                                        <div class="message-user">
                                            <figure class="avatar">
                                                <img src="images/user-1.png" alt="image">
                                            </figure>
                                            <div>
                                                <h5 class="font-xssss mt-2">Byrom Guittet</h5>
                                                <div class="time">01:35 PM<i class="ti-double-check text-info"></i></div>
                                            </div>
                                        </div>
                                        <div class="message-wrap shadow-none">I want those files for you. I want you to send 1 PDF and 1 image file.</div>
                                    </div>

                                    <div class="message-item">
                                        <div class="message-user">
                                            <figure class="avatar">
                                                <img src="images/user-9.png" alt="image">
                                            </figure>
                                            <div>
                                                <h5 class="font-xssss mt-2">Byrom Guittet</h5>
                                                <div class="time">01:35 PM</div>
                                            </div>
                                        </div>
                                        <div class="message-wrap shadow-none">I've found some cool photos for our travel app.</div>
                                    </div>

                                    <div class="message-item outgoing-message">
                                        <div class="message-user">
                                            <figure class="avatar">
                                                <img src="images/user-1.png" alt="image">
                                            </figure>
                                            <div>
                                                <h5>You</h5>
                                                <div class="time">01:35 PM<i class="ti-double-check text-info"></i></div>
                                            </div>
                                        </div>
                                        <div class="message-wrap">Hey mate! How are things going ?</div>
                                    </div>

                                    <div class="message-item">
                                        <div class="message-user">
                                            <figure class="avatar">
                                                <img src="images/user-9.png" alt="image">
                                            </figure>
                                            <div>
                                                <h5 class="font-xssss mt-2">Byrom Guittet</h5>
                                                <div class="time">01:35 PM</div>
                                            </div>
                                        </div>
                                        <div class="message-wrap shadow-none">I'm fine, how are you ðŸ˜ƒ</div>
                                    </div>

                                    <div class="message-item">
                                        <div class="message-user">
                                            <figure class="avatar">
                                                <img src="images/user-1.png" alt="image">
                                            </figure>
                                            <div>
                                                <h5 class="font-xssss mt-2">Byrom Guittet</h5>
                                                <div class="time">01:35 PM<i class="ti-double-check text-info"></i></div>
                                            </div>
                                        </div>
                                        <div class="message-wrap shadow-none">I want those files for you. I want you to send 1 PDF and 1 image file.</div>
                                    </div>

                                    <div class="message-item">
                                        <div class="message-user">
                                            <figure class="avatar">
                                                <img src="images/user-9.png" alt="image">
                                            </figure>
                                            <div>
                                                <h5 class="font-xssss mt-2">Byrom Guittet</h5>
                                                <div class="time">01:35 PM</div>
                                            </div>
                                        </div>
                                        <div class="message-wrap shadow-none">I've found some cool photos for our travel app.</div>
                                    </div>

                                </div>
                                <form class="chat-form position-absolute bottom-0 w-100 left-0 bg-white z-index-1 p-3 shadow-xs theme-dark-bg ">
                                    <button class="bg-grey float-left"><i class="ti-microphone text-white"></i></button>
                                    <div class="form-group"><input type="text" placeholder="Start typing.." class="pos-top text-grey-900"></div>          
                                    <button class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                                </form>
                            </div>
                        </div> -->
                    </div>
                </div>
                 
            </div>            
        </div>
        <!-- main content -->

        <!-- right chat -->
        <div class="right-chat nav-wrap mt-2 right-scroll-bar">
            <div class="middle-sidebar-right-content bg-white shadow-xss rounded-xxl">

                <!-- loader wrapper -->
                <div class="preloader-wrap p-3">
                    <div class="box shimmer">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                    <div class="box shimmer mb-3">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                    <div class="box shimmer">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                </div>
                <!-- loader wrapper -->

                <div class="section full pe-3 ps-4 pt-4 position-relative feed-body">
                    <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">CONTACTS</h4>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-8.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                            </h3>
                            <span class="badge badge-primary text-white badge-pill fw-500 mt-0">2</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-7.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Victor Exrixon</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-6.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Surfiya Zakir</a>
                            </h3>
                            <span class="bg-warning ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-5.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Goria Coast</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-4.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Hurin Seary</a>
                            </h3>
                            <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">4:09 pm</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-3.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">David Goria</a>
                            </h3>
                            <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 days</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-2.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Seary Victor</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="images/user-12.png" alt="image" class="w35">
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Ana Seary</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        
                    </ul>
                </div>
                <div class="section full pe-3 ps-4 pt-4 pb-4 position-relative feed-body">
                    <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">GROUPS</h4>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Studio Express</a>
                            </h3>
                            <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 min</span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany Design</a>
                            </h3>
                            <span class="bg-warning ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-mini-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">De fabous</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                    </ul>
                </div>
                <div class="section full pe-3 ps-4 pt-0 pb-4 position-relative feed-body">
                    <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">Pages</h4>
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Armany Seary</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        <li class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            
                            <span class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat" href="#">Entropio Inc</a>
                            </h3>
                            <span class="bg-success ms-auto btn-round-xss"></span>
                        </li>
                        
                    </ul>
                </div>

            </div>
        </div>

        
        <!-- right chat -->
        
        <div class="app-footer border-0 shadow-lg bg-primary-gradiant">
            <a href="default.php" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
            <a href="default-video.php" class="nav-content-bttn"><i class="feather-package"></i></a>
            <a href="default-live-stream.php" class="nav-content-bttn" data-tab="chats"><i class="feather-layout"></i></a>            
            <a href="shop-2.php" class="nav-content-bttn"><i class="feather-layers"></i></a>
            <a href="default-settings.php" class="nav-content-bttn"><img src="images/female-profile.png" alt="user" class="w30 shadow-xss"></a>
        </div>

        <div class="app-header-search">
            <form class="search-form">
                <div class="form-group searchbox mb-0 border-0 p-1">
                    <input type="text" class="form-control border-0" placeholder="Search...">
                    <i class="input-icon">
                        <ion-icon name="search-outline" role="img" class="md hydrated" aria-label="search outline"></ion-icon>
                    </i>
                    <a href="#" class="ms-1 mt-1 d-inline-block close searchbox-close">
                        <i class="ti-close font-xs"></i>
                    </a>
                </div>
            </form>
        </div>

    </div> 

    <div class="modal bottom side fade" id="Modalstries" tabindex="-1" role="dialog" style=" overflow-y: auto;">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 bg-transparent">
                <button type="button" class="close mt-0 position-absolute top--30 right--10" data-dismiss="modal" aria-label="Close"><i class="ti-close text-white font-xssss"></i></button>
                <div class="modal-body p-0">
                    <div class="card w-100 border-0 rounded-3 overflow-hidden bg-gradiant-bottom bg-gradiant-top">
                        <div class="owl-carousel owl-theme dot-style3 story-slider owl-dot-nav nav-none">
                            <div class="item"><img src="images/story-5.jpg" alt="image"></div>
                            <div class="item"><img src="images/story-6.jpg" alt="image"></div>
                            <div class="item"><img src="images/story-7.jpg" alt="image"></div>
                            <div class="item"><img src="images/story-8.jpg" alt="image"></div>
                            
                        </div>
                    </div>
                    <div class="form-group mt-3 mb-0 p-3 position-absolute bottom-0 z-index-1 w-100">
                        <input type="text" class="style2-input w-100 bg-transparent border-light-md p-3 pe-5 font-xssss fw-500 text-white" value="Write Comments">               
                        <span class="feather-send text-white font-md text-white position-absolute" style="bottom: 35px;right:30px;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-popup-chat">
        <div class="modal-popup-wrap bg-white p-0 shadow-lg rounded-3">
            <div class="modal-popup-header w-100 border-bottom">
                <div class="card p-3 d-block border-0 d-block">
                    <figure class="avatar mb-0 float-left me-2">
                        <img src="images/user-12.png" alt="image" class="w35 me-1">
                    </figure>
                    <h5 class="fw-700 text-primary font-xssss mt-1 mb-1">Hendrix Stamp</h5>
                    <h4 class="text-grey-500 font-xsssss mt-0 mb-0"><span class="d-inline-block bg-success btn-round-xss m-0"></span> Available</h4>
                    <a href="#" class="font-xssss position-absolute right-0 top-0 mt-3 me-4"><i class="ti-close text-grey-900 mt-2 d-inline-block"></i></a>
                </div>
            </div>
            <div class="modal-popup-body w-100 p-3 h-auto">
                <div class="message"><div class="message-content font-xssss lh-24 fw-500">Hi, how can I help you?</div></div>
                <div class="date-break font-xsssss lh-24 fw-500 text-grey-500 mt-2 mb-2">Mon 10:20am</div>
                <div class="message self text-right mt-2"><div class="message-content font-xssss lh-24 fw-500">I want those files for you. I want you to send 1 PDF and 1 image file.</div></div>
                <div class="snippet pt-3 ps-4 pb-2 pe-3 mt-2 bg-grey rounded-xl float-right" data-title=".dot-typing"><div class="stage"><div class="dot-typing"></div></div></div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-popup-footer w-100 border-top">
                <div class="card p-3 d-block border-0 d-block">
                    <div class="form-group icon-right-input style1-input mb-0"><input type="text" placeholder="Start typing.." class="form-control rounded-xl bg-greylight border-0 font-xssss fw-500 ps-3"><i class="feather-send text-grey-500 font-md"></i></div>
                </div>
            </div>
        </div> 
    </div>

    <script src="js/plugin.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/video-player.js"></script>
    
</body>

</html>