<style scoped>
  .navbar-brand {
    max-width: 300px;
  }
</style>

<template>
  <div>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img class="w-75" src="/images/logo.png" alt="logo" />
        </a>
        <form class="d-flex">
          <span class="pe-3 align-middle">User</span>
        </form>
      </div>
    </nav>
    <navtab />
  </div>
</template>

<script>
  import navtab from './navtab.vue';
  export default {
    name: 'navbar',
    components: {
      navtab: navtab,
    },
    data() {
      return {
        isShow: false,
      }
    },
    methods: {
      logout() {
        axios.post("logout").then(response => { 
          location.reload();
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
      }
    }
  }
</script>