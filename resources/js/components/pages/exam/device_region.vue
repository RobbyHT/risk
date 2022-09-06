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
            <h2 class="mb-0 fw-bold">區域管理</h2>
            <div class="input-group w-50">
              <input type="search" class="form-control border border-2 border-end-0 inside-border-color" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
              <button class="btn btn-light border border-2 border-start-0 inside-border-color" type="button" id="button-addon2">
                <i class="bi bi-search"></i>
              </button>
            </div>
            <div class="rwd-btn">
              <button type="button" class="btn btn-info mx-1" @click="modalSwitch('add');">新增+</button>
              <button type="button" class="btn btn-danger mx-1" @click="del">刪除-</button>
            </div>
          </div>
          <hr class="style5 my-2">
          <table class="rwd-table table table-hover table-fixed align-middle" id="regionTable">
            <thead class="align-center">
              <tr>
                <th scope="col" width="10%" class="text-center">
                  <input type="checkbox" class="form-check-input custom-checkbox-size" v-model="allSelected" @click="selectAll" />
                </th>
                <th scope="col" width="60%" class="text-start">區域名稱</th>
                <th scope="col" width="20%" class="text-center">建立日期</th>
                <th scope="col" width="10%" class="text-center">編輯</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(data, i) in regionList" :key="data.id">
                <td scope="row" class="text-center" data-th="">
                  <input type="checkbox" class="form-check-input custom-checkbox-size" v-model="selectedList" :value="data.id" />
                </td>
                <td class="text-left" data-th="區域名稱">{{data.name}}</td>
                <td class="text-center" data-th="建立日期">{{data.created_at.substr(0, 10)}}</td>
                <td class="text-center" data-th="編輯">
                  <button type="button" class="btn btn-warning mx-1" @click="modalSwitch('upd', data);">編輯</button>
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
    <!-- 新增視窗 -->
    <div class="modal fade" id="operateModal" ref="operateModal" tabindex="-1" aria-labelledby="operateModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="operateModalLabel">{{modalType == "add" ? "新增" : "編輯"}}區域</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="regionName" class="col-form-label">區域名稱:</label>
                <input type="text" class="form-control" id="regionName" v-model="regionName">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" @click="save" :disabled="regionName==''">確認</button>
          </div>
        </div>
      </div>
    </div>
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
        regionList: [],
        region_id: -1,
        regionName: "",
        modalType: "add",
        modal: null,
        regionTable: null
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
      vm.modal = new Modal(vm.$refs.operateModal);
      
      $("input[type='search']").on('keyup', function () {
        vm.regionTable.search( this.value ).draw();
      });
    }, 
    methods: {
      modalSwitch: function(type, data) {
        const vm = this;
        vm.region_id = -1;
        vm.regionName = "";
        if(type == 'upd'){
          vm.region_id = data.id;
          vm.regionName = data.name;
        }
        vm.modalType = type;
        vm.modal.show();
      },
      getData: async function() {
        const vm = this;
        if(vm.regionTable != null) vm.regionTable.destroy();

        await axios.get(`/api/device/region`)
        .then(function (resp) {
          vm.regionList = resp.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });

        vm.regionTable = $('#regionTable').DataTable({
          columnDefs: [{
            orderable: false,
            targets: [0, 3]
          }],
          order: [[1, 'asc']],
          pageLength: 5,
          language: {
            zeroRecords: "尚無資料",
            info: "共 _TOTAL_ 項",
            infoEmpty: "共 0 項",
            infoFiltered: "(從 _MAX_ 項結果中過濾)",
            paginate: {
              first: "第一頁",
              previous: "上一頁",
              next: "下一頁",
              last: "最後一頁"
            },
          },
        });
      },
      save: function() {
        const vm = this;
        let url = '/api/device/region';
        let method = 'POST';
        if(vm.modalType == 'upd') {
          method = 'PUT';
          url += `/${vm.region_id}`
        }
        axios.post(url, {
          _method: method,
          name: vm.regionName
        })
        .then(async function (resp) {
          await vm.getData();
          await vm.modal.hide();
          vm.$swal.fire({
            title: '儲存成功！',
            icon: "success",
            confirmButtonText: '確認',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          });
        })
        .catch(function (error) {
          vm.$swal.fire({
            title: 'Oops！儲存失敗！！',
            icon: "error",
            confirmButtonText: '確認',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
        });
      },
      del: function() {
        const vm = this;
        vm.$swal.fire({
          title: '確認刪除？',
          icon: 'warning',
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonText: '確認',
          cancelButtonText: '取消',
          customClass: {
            confirmButton: 'btn btn-danger ms-3',
            cancelButton: 'btn btn-secondary'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {
            axios.post(`/api/device/region/0`, {
              _method: 'DELETE',
              ids: vm.selectedList
            })
            .then(async function (resp) {
              await vm.getData();

              vm.$swal.fire({
                title: '刪除成功！',
                icon: "success",
                confirmButtonText: '確認',
                customClass: {
                  confirmButton: 'btn btn-success'
                },
                buttonsStyling: false
              });
            })
            .catch(function (error) {
              vm.$swal.fire({
                title: 'Oops！刪除失敗！！',
                icon: "error",
                confirmButtonText: '確認',
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
          vm.regionList.forEach(function (value, i) {
            vm.selectedList.push(value.id);
          });
        }
      },
    },
  }
</script>