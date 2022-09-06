<template>
  <div>
    <navbar></navbar>
    <inertia-link href="/about">about</inertia-link>
    <h1>Home</h1>
    <div class="">
      <button class="btn btn-success rounded-5">123</button>
    </div>
  </div>
</template>
<script>
  import navbar from '../shared/navbar.vue';
  export default {
    components: {
      navbar: navbar,
    }
  }
</script>