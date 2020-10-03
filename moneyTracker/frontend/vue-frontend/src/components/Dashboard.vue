<template>
    <div class=" container-fluid dashboard">
        <div class="row">
            <div class="col-md-2 side-bar side">
                <span><button class="btn btn-primary" id="s-toggle">x</button></span>
                <Sidebar/>
            </div>
            <div class="col-md-10 main-cont">
                <div class="main">
                    <router-view></router-view>
                </div>
                
            </div>
        </div>
    </div>
    
</template>

<script>
import Sidebar from './Sidebar';
import $ from 'jquery';


$(document).ready(function() {
    $('#s-toggle').click(function(e) {
        e.preventDefault();
        $(".dashboard").toggleClass("toggled");
    });
});

export default {
    name: 'dashboard',
    components: {
        Sidebar
    },
    data () {
        return {
          
        }
    }
}
</script>

<style scoped>
.side-bar {
    height: 100vh;
    box-shadow: 0 0 4px #000;
    /* background-image: url('../assets/sidebar-2.jpg'); */
    /* background-image: linear-gradient(to bottom, #001d38 0%, rgba(0, 29, 56, 0.6) 100%),
                    url('imgs/banner.png');); */
    background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../assets/sidebar-2.jpg');
    background-size: cover;
    background-position: center;

}
.main-cont {
    padding-top: 10px ;
    widows: 100%;
}
.main {
    height: auto;
    /* padding: 80px 10px 60px 20px; */
    /* box-shadow: 0 0 1px rgb(95, 8, 8); */
}
.side-bar {
  min-height: 100vh;
  /* margin-left: -15rem; */
  /* position: fixed; */
  /* z-index: 1000; */
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

  /* Hide for mobile, show later */
  
  @media (max-width: 600px) {
    .side-bar {
      position: fixed;
      margin-left: -25rem;
      /* top: 51px; */
      width: 70%;
      bottom: 0;
      left: 0;
      z-index: 1000;
      display: block;
      padding: 20px;
      overflow-x: hidden;
      overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
      background-color: #f5f5f5;
      border-right: 1px solid #eee;
      padding-top: 50px;
    }
    .dashboard.toggled .side-bar {
      margin-left: -50rem;
    }
  }
@media (max-width: 768px) {
    .side-bar {
      position: fixed;
      margin-left: -25rem;
      width: 70%;
      bottom: 0;
      left: 0;
      z-index: 1000;
      display: block;
      padding: 20px;
      overflow-x: hidden;
      overflow-y: auto; 
      background-color: #f5f5f5;
      border-right: 1px solid #eee;
      padding-top: 50px;
    }
    .dashboard.toggled .side-bar {
      margin-left: -50rem;
    }
  }
@media (min-width: 768px) {
  .side-bar {
    width: 50%;
  }
}
.side-bar {
    margin-left: 0;
  }
.dashboard.toggled .side-bar {
    margin-left: -100%;
}
.dashboard.toggled .main-cont {
  width: 100%;
}
@media (min-width: 931px) {
  .dashboard.toggled .side-bar {
    margin-left: -13rem;
  }
}
#a {
  width: 20px;
  height: 2px;
  background-color: #000;
  margin: 3px;
}

@media (min-width: 768px) {
  #s-toggle {
    display: none;
  }
}
</style>