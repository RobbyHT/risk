<style>
  .dataTables_filter, .dataTables_length { display: none; }
  .paginate_button {
    border-radius: 0.5rem !important;
    padding: 0.3em 0.8em !important;
  }
</style>
<style scoped>
  main {
    display: flex;
    min-height: 80vh;
    max-height: unset;
  }
  main .left {
    flex-basis: 240px;
  }
  main .right {
    flex: 1;
  }
  .outer-border-color {
    border-color: #868AA5 !important;
    background-color: #ECF2FE;
  }
  .inside-border-color {
    border-color: #0C4E82 !important;
  }
  hr.style5 {
    background-color: #fff;
    border-top: 2px dashed #868AA5;
    opacity: 1;
  }
  .custom-checkbox-size {
    width: 1.5em;
    height: 1.5em;
  }
  .rwd-table {
    color: #595C8A;
    font-size: 1rem;
    font-weight: 900;
    border-collapse: separate;
    border-spacing: 0px;
    border: 1px #0C4E82 solid;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
    border-bottom: 0;
  }
  .rwd-table tbody {
    background: #fff;
  }
  .rwd-table thead {
    -webkit-text-stroke: 0.2px #595C8A;
    background: #DADBF9;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
  }
  .rwd-table thead th:first-child {
    border-top-left-radius: 0.5rem;
  }
  .rwd-table thead th:last-child {
    border-top-right-radius: 0.5rem;
  }
  @media (max-width: 1000px) {
    .rwd-btn {
      margin-top: 0.5rem !important;
    }
    .rwd-table {
      background: #fff;
      overflow: hidden;
    }
    .rwd-table tr:nth-of-type(2n) {
      background: #eee;
    }
    .rwd-table th, .rwd-table td {
      margin: 0.5em 1em;
    }
    .rwd-table {
      min-width: 100%;
    }
    .rwd-table th {
      display: none;
    }
    .rwd-table td {
      display: block;
    }
    .rwd-table td[data-th=""]:before {
      content: none;
      font-weight: bold;
      width: 6.5em;
      display: inline-block;
    }
    .rwd-table td:not([data-th=""]):before {
      content: attr(data-th);
      font-weight: bold;
      width: 6.5em;
      display: inline-block;
    }
    .rwd-table th, .rwd-table td {
      text-align: left !important;
    }
    .rwd-table th, .rwd-table td:before {
      color: #D20B2A;
      font-weight: bold;
    }
  }
  @media (max-width: 500px) {
    .left {
      display: none;
    }
  }
</style>
<template>
  <div>
    <header>
      <navbar />
    </header>
    <main>
      <div class="left">
        <sidebar />
      </div>
      <div class="right">
        <div class="m-3 p-2 border border-2 outer-border-color rounded-3">
          <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="mb-0 fw-bold">????????????</h2>
            <div class="input-group w-50">
              <input type="search" class="form-control border border-2 border-end-0 inside-border-color" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
              <button class="btn btn-light border border-2 border-start-0 inside-border-color" type="button" id="button-addon2">
                <i class="bi bi-search"></i>
              </button>
            </div>
            <div class="rwd-btn">
              <inertia-link href="/device/manage/add" class="btn btn-info mx-1">??????+</inertia-link>
              <button type="button" class="btn btn-danger mx-1" @click="del">??????-</button>
            </div>
          </div>
          <hr class="style5 my-2">
          <table class="rwd-table table table-hover table-fixed align-middle" id="deviceTable">
            <thead class="align-center">
              <tr>
                <th scope="col" width="10%" class="text-center">
                  <input type="checkbox" class="form-check-input custom-checkbox-size" v-model="allSelected" @click="selectAll" />
                </th>
                <th scope="col" width="40%" class="text-start">????????????</th>
                <th scope="col" width="40%" class="text-center">????????????</th>
                <th scope="col" width="10%" class="text-center">??????</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="data in deviceList" :key="data.id">
                <td scope="row" class="text-center" data-th="">
                  <input type="checkbox" class="form-check-input custom-checkbox-size" v-model="selectedList" :value="data.id" />
                </td>
                <td class="text-left" data-th="????????????">{{data.name}}</td>
                <td class="text-center" data-th="????????????">{{data.region.name}}</td>
                <td class="text-center" data-th="??????">
                  <inertia-link :href="'/device/manage/edit/'+data.id" class="btn btn-warning mx-1">??????</inertia-link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
    <footer>
      <sitemap />
    </footer>
  </div>
</template>
<script>
  import navbar from '../../shared/navbar.vue';
  import sidebar from '../../shared/sidebar_exam.vue';
  import sitemap from '../../shared/sitemap.vue';
  export default {
    components: {
      navbar: navbar,
      sidebar: sidebar,
      sitemap: sitemap,
    },
    data() {
      return {
        allSelected: false,
        selectedList:[],
        deviceList: [],
        deviceTable: null
      }
    },
    props: {
      //
    },
    setup(props) {
      //
    },
    mounted() {
      const vm = this;
      vm.getData();
      
      $("input[type='search']").on('keyup', function () {
        vm.deviceTable.search( this.value ).draw();
      });
    }, 
    methods: {
      getData: async function() {
        const vm = this;
        if(vm.deviceTable != null) vm.deviceTable.destroy();

        await axios.get(`/api/device`)
        .then(function (resp) {
          vm.deviceList = resp.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });

        vm.deviceTable = $('#deviceTable').DataTable({
          columnDefs: [{
            orderable: false,
            targets: [0, 3]
          }],
          order: [[1, 'asc']],
          pageLength: 5,
          language: {
            zeroRecords: "????????????",
            info: "??? _TOTAL_ ???",
            infoEmpty: "??? 0 ???",
            infoFiltered: "(??? _MAX_ ??????????????????)",
            paginate: {
              first: "?????????",
              previous: "?????????",
              next: "?????????",
              last: "????????????"
            },
          },
        });
      },
      del: function() {
        const vm = this;
        vm.$swal.fire({
          title: '???????????????',
          icon: 'warning',
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonText: '??????',
          cancelButtonText: '??????',
          customClass: {
            confirmButton: 'btn btn-danger ms-3',
            cancelButton: 'btn btn-secondary'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {
            axios.post(`/api/device/0`, {
              _method: 'DELETE',
              ids: vm.selectedList
            })
            .then(async function (resp) {
              await vm.getData();

              vm.$swal.fire({
                title: '???????????????',
                icon: "success",
                confirmButtonText: '??????',
                customClass: {
                  confirmButton: 'btn btn-success'
                },
                buttonsStyling: false
              });
            })
            .catch(function (error) {
              vm.$swal.fire({
                title: 'Oops?????????????????????',
                icon: "error",
                confirmButtonText: '??????',
                customClass: {
                  confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
              });
            });

            vm.selectedList = [];
          }
        });
      },
      selectAll: function() {
        const vm = this;
        vm.selectedList = [];

        if (!vm.allSelected) {
          vm.deviceList.forEach(function (value, i) {
            vm.selectedList.push(value.id);
          });
        }
      },
    },
  }
</script>