<style scoped>
  .nav-tab-bg {
    background-color: #18494D;
    padding: 5px 0;
  }
  .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    background-color: #17A2BB40;
    border-bottom: 3px #FFC300 solid;
  }
  .bi-chevron-down {
    display: inline-block;
    transition: 0.3s ease-in-out;
  }
  .navbar-toggler {
    border: none;
    box-shadow: none !important;
  }
  .navbar-toggler:not(.collapsed) .bi-chevron-down {
    transform: rotate(180deg);
  }
  .nav-link {
    font-size: 1rem;
    font-weight: bolder;
    margin: 0 20px;
  }
  .navbar-nav .show > .nav-link, .navbar-nav .nav-link.active {
    background-color: #17A2BB40;
    border-bottom: 3px #FFC300 solid;
  }
  .navbar-collapse {
    flex-grow: unset;
  }
</style>
<template>
  <nav class="navbar navbar-expand-lg nav-tab-bg">
    <div class="container-fluid navbar-center justify-content-center">
      <button class="navbar-toggler justify-content-center collapsed w-100" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-chevron-down"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
          <li class="nav-item">
            <inertia-link class="nav-link text-white" href="/device/region" :class="{ 'active': $page.url.startsWith('/device')}">智慧巡檢平台</inertia-link>
          </li>
          <li class="nav-item">
            <inertia-link class="nav-link text-white" href="/page2" :class="{ 'active': $page.url === '/page2' }">3D視覺化人員安全管理平台</inertia-link>
          </li>
          <li class="nav-item">
            <inertia-link class="nav-link text-white" href="/page3" :class="{ 'active': $page.url === '/page3' }">定位平台</inertia-link>
          </li>
          <li class="nav-item">
            <inertia-link 
                class="nav-link text-white" 
                href="/risk" 
                :class="{ 'active': $page.url.startsWith('/risk')}"
              >
                風險評估
            </inertia-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
  export default {
    props: {
      //
    },
    setup(props) {
      //
    }
  }
</script>