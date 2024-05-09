
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
  
    </div>
  
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  
      <!-- Search -->
      <div class="navbar-nav align-items-center">
  
        <div class="nav-item d-flex align-items-center">
  
          <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none" placeholder="Pesquisar..." aria-label="Pesquisarx..."/>
        </div>
  
      </div>
      <!-- /Search -->
  
      <ul class="navbar-nav flex-row align-items-center ms-auto">
  
        <!-- Place this tag where you want the button to render. -->
        <li class="nav-item lh-1 me-3">
          <a>
        </li>
  
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
  
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              <img src="" alt class="w-px-40 h-auto rounded-circle" />
            </div>
          </a>
  
          <?php
            include "navbar-dropdown.php";
          ?>
          
        </li>
        <!--/ User -->
      </ul> 
  
    </div>
  
  </nav>


  <script>
    $(document).ready(function() {

      $("#modalnotes").on("hidden.bs.modal", function () {
        var listView = document.getElementById('listView');
    var formView = document.getElementById('formView');

    

      listView.style.display = 'block';
      formView.style.display = 'none';
    
      });
    });
  </script>