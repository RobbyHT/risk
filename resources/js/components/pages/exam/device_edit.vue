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
  main .right-content {
    border-color: #0C4E82 !important;
    background-color: #FFF;
  }
  .outer-border-color {
    border-color: #868AA5 !important;
    background-color: #ECF2FE;
  }
  .thead-bgcolor {
    background-color: #ECF2FE;
  }
  .table {
    border-collapse: separate;
    border-spacing: 0.5em 0;
  }
  .table-custom {
    border-collapse: separate;
    border-spacing: 0.5em 0.5em;
  }
  hr.style5 {
    background-color: #fff;
    border-top: 2px dashed #868AA5;
    opacity: 1;
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
          <h2 class="mb-0 fw-bold">{{deviceId == -1 ? "新增" : "編輯"}}設備</h2>
          <hr class="style5 my-2">
          <div class="border border-2 right-content rounded-3 pb-3">
            <table class="table table-borderless table-custom mb-0 align-middle">
              <tr>
                <th class="thead-bgcolor text-end" width="150px">設備代碼：</th>
                <td class="p-0" width="300px"><input type="text" class="form-control" v-model="deviceCode" /></td>
                <td></td>
              </tr>
              <tr>
                <th class="thead-bgcolor text-end" width="150px">設備名稱：</th>
                <td class="p-0" width="300px"><input type="text" class="form-control" v-model="deviceName" /></td>
                <td></td>
              </tr>
              <tr>
                <th class="thead-bgcolor text-end" width="150px">所屬區域：</th>
                <td class="p-0" width="300px">
                  <select class="form-select" v-model="deviceRegion">
                    <option value="">請選擇</option>
                    <option v-for="(region, index) in regionList" :key="index" :value="region.id">
                      {{region.name}}
                    </option>
                  </select>
                </td>
                <td></td>
              </tr>
            </table>
            <table class="table table-borderless mb-0 align-middle">
              <thead class="text-center align-center thead-bgcolor">
                <tr>
                  <th scope="col" width="40%">巡檢項目名稱</th>
                  <th scope="col" width="30%">管理值</th>
                  <th scope="col" width="10%">單位</th>
                  <th scope="col" width="20%">備註</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, i) in deviceList" :id="i" :key="data.id">
                  <td>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-dash-square-fill fs-4 lh-1 me-2 text-danger" @click="del(i);"></i>
                      <input type="text" class="form-control" v-model="data.exam_item" />
                    </div>
                  </td>
                  <td class="d-flex">
                    <select class="form-select me-1" v-model="data.accept" style="width: 40%;">
                      <option value="">請選擇</option>
                      <option value="numeric">數值</option>
                      <option value="validation">是否正常</option>
                    </select>
                    <div v-if="data.accept == 'numeric'" class="d-flex align-items-center" style="width: 60%;">
                      <input type="text" class="form-control" v-model="data.accept_min" />
                      ~
                      <input type="text" class="form-control" v-model="data.accept_max" />
                    </div>
                    <div v-else style="width: 60%;">
                      <input type="text" class="form-control" />
                    </div>
                  </td>
                  <td>
                    <select class="form-select" v-model="data.accept_unit">
                      <option value="">請選擇</option>
                      <option value="℃">℃</option>
                      <option value="kgf/cm2">kgf/cm2</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control" v-model="data.desc" /></td>
                </tr>
              </tbody>
            </table>
            <div class="ms-3 mt-2">
              <i class="bi bi-plus-square-fill fs-4 lh-1 text-primary" @click="add();"></i>
            </div>
          </div>
          <div class="d-flex justify-content-center mt-2">
            <button type="button" class="btn btn-success d-flex align-items-center p-1 mx-2" @click="save">
              <i class="bi bi-file-earmark-check fs-4"></i>
              <div class="ms-2 px-2 py-1 bg-white text-success fw-bold rounded-3">
                儲存
              </div>
            </button>
            <inertia-link href="/device/manage" class="btn btn-danger d-flex align-items-center p-1 mx-2">
              <i class="bi bi-file-earmark-excel fs-4"></i>
              <div class="ms-2 px-2 py-1 bg-white text-danger fw-bold rounded-3">
                取消
              </div>
            </inertia-link>
          </div>
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
        deviceId: -1,
        deviceCode: "",
        deviceName: "",
        deviceRegion: "",
        deleteList: [],
        regionList: [],
        deviceList: [],
        deviceData: {
          id: -1,
          exam_item: "",
          accept: "",
          accept_min: "",
          accept_max: "",
          accept_unit: "",
          desc: "",
        }
      }
    },
    props: ["id"],
    setup(props) {
      //
    },
    mounted() {
      const vm = this;
      vm.getData();
    }, 
    methods: {
      getData: async function() {
        const vm = this;
        await axios.get(`/api/device/region`)
        .then(function (resp) {
          vm.regionList = resp.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
        if(vm.id != null) {
          vm.deviceId = vm.id;
          await axios.get(`/api/device/${vm.id}`)
          .then(function (resp) {
            vm.deviceCode = resp.data.data.code;
            vm.deviceName = resp.data.data.name;
            vm.deviceRegion = resp.data.data.region_id;
            vm.deviceList = resp.data.data.exam_items;
          })
          .catch(function (error) {
            console.log(error);
          });
        }
      },
      save: function() {
        const vm = this;
        axios.post('/api/device', {
          deviceId: vm.deviceId,
          deviceCode: vm.deviceCode,
          deviceName: vm.deviceName,
          deviceRegion: vm.deviceRegion,
          deviceList: vm.deviceList,
          deleteList: vm.deleteList
        })
        .then(async function (resp) {
          await vm.getData();
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
      add: function() {
        this.deviceList.push({...this.deviceData});
      },
      del: function(index) {
        if(this.deviceList[index].id != -1) {
          this.deleteList.push(this.deviceList[index].id);
        }
        this.deviceList.splice(index, 1);
      },
    },
  }
</script>