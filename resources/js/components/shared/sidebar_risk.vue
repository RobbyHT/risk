<style scoped>
  .sidebar {
    width: 100%;
    height: 100%;
    background-color: #71C1DC;
  }
  main {
    display: flex;
    flex-wrap: nowrap;
    height: 100vh;
    height: -webkit-fill-available;
    max-height: 100vh;
    overflow-x: auto;
    overflow-y: hidden;
  }
  .b-example-divider {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
  }
  .bi {
    vertical-align: -.125em;
    pointer-events: none;
    fill: currentColor;
  }
  .dropdown-toggle { outline: 0; }
  .nav-flush .nav-link { border-radius: 0; }
  .link-dark.active {
    background-color: #FFDD7F;
  }
  .btn-toggle {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: .25rem .5rem;
    font-size: 1rem;
    font-weight: 900;
    color: rgba(0, 0, 0, .65);
    background-color: transparent;
    border: 0;
  }
  .btn-toggle:hover {
    color: rgba(0, 0, 0, .85);
    background-color: #FFDD7F;
  }
  .btn-toggle::after {
    width: 1.25em;
    line-height: 0;
    content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
    transition: transform .35s ease;
    transform-origin: .5em 50%;
  }
  .btn-toggle[aria-expanded="true"] {
    color: rgba(0, 0, 0, .85);
  }
  .btn-toggle[aria-expanded="true"]::after {
    transform: rotate(90deg);
  }
  .btn-toggle-nav a {
    width: 80%;
    display: inline-flex;
    padding: .4rem;
    margin-top: .125rem;
    margin-left: 1.25rem;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 600;
  }
  .btn-toggle-nav a:hover,
  .btn-toggle-nav a:focus { background-color: #FFDD7F; }
  .scrollarea { overflow-y: auto; }
  .fw-semibold { font-weight: 600; }
  .lh-tight { line-height: 1.25; }
  .border-top { color: black; }
</style>
<template>
  <div class="sidebar flex-shrink-0 p-3">
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" :aria-expanded="$page.url === '/risk/description'">
          ?????????????????????
        </button>
        <div class="collapse" id="home-collapse" :class="{ 'show': $page.url === '/risk/description' }">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><inertia-link href="/risk/description" class="link-dark rounded" :class="{ 'active': $page.url === '/risk/description' }">????????????????????????</inertia-link></li>
            <li><a href="#" class="link-dark rounded">????????????????????????</a></li>
          </ul>
        </div>
      </li>
      <li class="border-top border-secondary my-1"></li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          ??????&????????????
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">??????&????????????</a></li>
          </ul>
        </div>
      </li>
      <li class="border-top border-secondary my-1"></li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#fmea-collapse" :aria-expanded="$page.url.startsWith('/risk/FMEA')">
          FMEA
        </button>
        <div class="collapse" id="fmea-collapse" :class="{ 'show': $page.url.startsWith('/risk/FMEA') }">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><inertia-link href="/risk/FMEA" class="link-dark rounded" :class="{ 'active': $page.url === '/risk/FMEA' }">FMEA??????</inertia-link></li>
          </ul>
        </div>
      </li>
      <li class="border-top border-secondary my-1"></li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#hazop-collapse" :aria-expanded="$page.url.startsWith('/risk/HAZOP')">
          HAZOP
        </button>
        <div class="collapse" id="hazop-collapse" :class="{ 'show': $page.url.startsWith('/risk/HAZOP') }">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><inertia-link href="/risk/HAZOP" class="link-dark rounded" :class="{ 'active': $page.url === '/risk/HAZOP' }">HAZOP??????</inertia-link></li>
          </ul>
        </div>
      </li>
      <li class="border-top border-secondary my-1"></li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#whatif-collapse" :aria-expanded="$page.url.startsWith('/risk/WhatIf')">
          What-If
        </button>
        <div class="collapse" id="whatif-collapse" :class="{ 'show': $page.url.startsWith('/risk/WhatIf') }">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><inertia-link href="/risk/WhatIf" class="link-dark rounded" :class="{ 'active': $page.url === '/risk/WhatIf' }">What-If??????</inertia-link></li>
          </ul>
        </div>
      </li>
      <li class="border-top border-secondary my-1"></li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#jsa-collapse" :aria-expanded="$page.url.startsWith('/risk/JSA')">
          JSA
        </button>
        <div class="collapse" id="jsa-collapse" :class="{ 'show': $page.url.startsWith('/risk/JSA') }">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><inertia-link href="/risk/JSA" class="link-dark rounded" :class="{ 'active': $page.url === '/risk/JSA' }">JSA??????</inertia-link></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
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