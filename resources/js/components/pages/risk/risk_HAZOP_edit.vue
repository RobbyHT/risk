<style>
  :root {
    --tableWidth: 3500px;
  }
  .drag-location {
    border: 2px dashed #999;
    background: #ede8e8;
  }
  .ui-sortable-helper {
    display: table;
    background: #FFFDF7;
  }
  .ui-sortable-helper td {
    padding: 0;
  }
</style>
<style scoped>
  .banner {
    background-color: #E6FECA;
    width: 100%;
    padding: 6% 0;
    text-align: center;
    position: relative;
  }
  h1 {
    padding: 5px 0;
    color: #004F60;
    font-size: 2.8em;
    font-weight: bolder;
    letter-spacing: 10px;
    /* 二次加粗 */
    -webkit-text-stroke: 1px #004F60;
  }
  h2 {
    color: #104C7D;
    font-size: 1.8em;
  }
  .banner-img {
    position: absolute;
    bottom: 0;
    right: 10%;
    width: 18%;
  }
  main {
    min-height: 80vh;
    max-height: unset;
  }
  .outer-border-color {
    border-color: #868AA5 !important;
    background-color: #ECF2FE;
  }
  .table {
    font-size: 1.2em;
    font-weight: 900;
    background: #EAFCFF;
    width: var(--tableWidth);
  }
  .table tr:nth-of-type(2n) {
    background: #fff;
  }
  .custom-checkbox-size {
    width: 1.2em;
    height: 1.2em;
    margin-top: 0;
  }
  .custom-lable {
    display: inline-flex;
    align-items: center;
  }
  p {
    font-size: 1.2em;
    font-weight: 900;
  }
  .breadcrumb {
    margin: 0;
    font-size: 1.2em;
    font-weight: 600;
  }
  .head { color: #fff; }
  .head-bg-1 { background-color: #054A81; }
  .head-bg-2 { background-color: #FE9F69; }
  .head-bg-3 { background-color: #24681F; }
  .head-bg-4 { background-color: #5D6097; }
  .head-bg-5 { background-color: #955D5C; }
  .head-bg-6 { background-color: #34A6FF; }
  .th-color-1 { color: #054A81; }
  .th-color-2 { color: #FE9F69; }
  .th-color-3 { color: #24681F; }
  .th-color-4-1 { color: #5D6097; }
  .th-color-6-1, .th-color-4-2 { color: #000094; }
  .th-color-6-2, .th-color-4-3 { color: #398B4E; }
  .th-color-6-3, .th-color-4-4 { color: #E7732F; }
  .user-handle {
    cursor: all-scroll;
    font-size: 1.4em;
  }
</style>
<template>
  <div>
    <header>
      <navbar />
      <!-- <div class="banner">
        <h1>風險評估</h1>
        <img class="banner-img" src="/images/safety-img.png" alt="banner-img">
      </div> -->
      <div class="m-3 d-flex align-items-center">
        <button class="btn btn-secondary" onclick="history.go(-1);">
          <i class="bi bi-caret-left-fill"></i>
          返回
        </button>
        <nav class="ms-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><inertia-link href="/risk/HAZOP">HAZOP列表</inertia-link></li>
            <li class="breadcrumb-item active" aria-current="page">HAZOP分析結果</li>
          </ol>
        </nav>
      </div>
    </header>
    <main>
      <div class="m-3 p-2 border border-2 outer-border-color rounded-3">
        <div class="text-center">
          <h2 class="mb-0 fw-bold">HAZOP分析結果</h2>
        </div>
        <div class="mt-2 pt-3 pb-1 px-3 bg-white">
          <p>設備名稱：{{deviceName}}</p>
          <p class="d-flex flex-wrap align-items-center">
            顯示內容：
            <label for="harm" class="me-3 custom-lable">
              <input type="checkbox" v-model="harmShow" @change="changeShow" class="form-check-input custom-checkbox-size me-1" name="showContent[]" id="harm" />
              危害原因與影響
            </label>
            <label for="protect" class="me-3 custom-lable">
              <input type="checkbox" v-model="protectShow" @change="changeShow" class="form-check-input custom-checkbox-size me-1" name="showContent[]" id="protect" />
              現有防護設施
            </label>
            <label for="before" class="me-3 custom-lable">
              <input type="checkbox" v-model="beforeShow" @change="changeShow" class="form-check-input custom-checkbox-size me-1" name="showContent[]" id="before" />
              控制前預估風險
            </label>
            <label for="control" class="me-3 custom-lable">
              <input type="checkbox" v-model="controlShow" @change="changeShow" class="form-check-input custom-checkbox-size me-1" name="showContent[]" id="control" />
              降低風險所採取之控制措施
            </label>
            <label for="after" class="me-3 custom-lable">
              <input type="checkbox" v-model="afterShow" @change="changeShow" class="form-check-input custom-checkbox-size me-1" name="showContent[]" id="after" />
              控制後預估風險
            </label>
          </p>
        </div>
        <div class="d-flex justify-content-between my-2">
          <div>
            <button class="btn btn-success mx-1" @click="save">
              <i class="bi bi-save"></i>
              儲存
            </button>
          </div>
          <div>
            <button class="btn btn-primary mx-1" @click="add">
              <i class="bi bi-plus-square"></i>
              新增欄位
            </button>
            <button class="btn btn-danger mx-1" @click="del">
              <i class="bi bi-dash-square"></i>
              刪除
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="sorting table table-bordered border-dark align-middle text-center fw-bold">
            <thead class="align-middle">
              <tr>
                <td class="" rowspan="2" width="60px">順序調整</td>
                <td class="" rowspan="2" width="40px"><input type="checkbox" class="form-check-input custom-checkbox-size" v-model="allSelected" @click="selectAll" /></td>
                <td class="head head-bg-1" colspan="4">1.設備、組件或元件</td>
                <td v-show="harmShow" class="head head-bg-2" colspan="2">2.危害原因與影響</td>
                <td v-show="protectShow" class="head head-bg-3" colspan="3">3.現有防護設施</td>
                <td v-show="beforeShow" class="head head-bg-4" colspan="4">4.控制前預估風險</td>
                <td v-show="controlShow" class="head head-bg-5" rowspan="2" width="400px">5.降低風險所採取之控制措施</td>
                <td v-show="afterShow" class="head head-bg-6" colspan="3">6.控制後預估風險</td>
              </tr>
              <tr>
                <!-- 1.設備、組件或元件 -->
                <td class="th-color-1" width="100px">節點</td>
                <td class="th-color-1" width="230px">涵蓋設備</td>
                <td class="th-color-1" width="250px">節點功能描述</td>
                <td class="th-color-1" width="250px">製程參數偏離</td>
                <!-- 2.危害類型、原因與影響 -->
                <td v-show="harmShow" class="th-color-2" width="250px">失效原因<br/>(八大方向思考)</td>
                <td v-show="harmShow" class="th-color-2" width="300px">可能造成影響之情境描述</td>
                <!-- 3.現有防護設施 -->
                <td v-show="protectShow" class="th-color-3" width="250px">工程控制<br/>(含偵測或連鎖)</td>
                <td v-show="protectShow" class="th-color-3" width="250px">管理控制</td>
                <td v-show="protectShow" class="th-color-3" width="200px">個人防護具</td>
                <!-- 4.控制前預估風險 -->
                <td v-show="beforeShow" class="th-color-4-1" width="200px">類別<br/>(安、環、營、設)</td>
                <td v-show="beforeShow" class="th-color-4-2" width="120px">嚴重性(S)</td>
                <td v-show="beforeShow" class="th-color-4-3" width="120px">事件機率(P)</td>
                <td v-show="beforeShow" class="th-color-4-4" width="120px">風險等級</td>
                <!-- 6.控制後預估風險 -->
                <td v-show="afterShow" class="th-color-6-1" width="120px">嚴重性(S)</td>
                <td v-show="afterShow" class="th-color-6-2" width="120px">事件機率(P)</td>
                <td v-show="afterShow" class="th-color-6-3" width="120px">風險等級</td>
              </tr>
            </thead>
            <tbody class="text-start dropzone-users">
              <tr class="tr_clone" v-for="(data, i) in deviceList" :id="i" :key="data.id">
                <td class="text-center"><i class="bi bi-list user-handle"></i></td>
                <td class="text-center"><input type="checkbox" class="form-check-input custom-checkbox-size" v-model="selectedList" :value="i" /></td>
                <!-- 1.設備、組件或元件 -->
                <td class="text-center"><input type="text" class="form-control" v-model="data.node" /></td>
                <td class="text-center"><input type="text" class="form-control" v-model="data.cover_device" placeholder="請輸入內容" /></td>
                <td><input type="text" class="form-control" v-model="data.node_description" placeholder="請輸入內容" /></td>
                <td><input type="text" class="form-control" v-model="data.process_deviation" placeholder="請輸入內容" /></td>
                <!-- 2.危害類型、原因與影響 -->
                <td v-show="harmShow"><input type="text" class="form-control" v-model="data.failure_reason" placeholder="請輸入內容" /></td>
                <td v-show="harmShow"><input type="text" class="form-control" v-model="data.failure_affect" placeholder="請輸入內容" /></td>
                <!-- 3.現有防護設施 -->
                <td v-show="protectShow"><input type="text" class="form-control" v-model="data.protect_engineering" placeholder="請輸入內容" /></td>
                <td v-show="protectShow"><input type="text" class="form-control" v-model="data.protect_manage" placeholder="請輸入內容" /></td>
                <td v-show="protectShow"><input type="text" class="form-control" v-model="data.protect_personal" placeholder="請輸入內容" /></td>
                <!-- 4.控制前預估風險 -->
                <td v-show="beforeShow" class="text-center">
                  <label :for="'safety'+i" class="me-3 custom-lable">
                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="data.before_category" :id="'safety'+i" value="安全" />安全
                  </label>
                  <label :for="'environment'+i" class="me-3 custom-lable">
                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="data.before_category" :id="'environment'+i" value="環保" />環保
                  </label>
                  <br/>
                  <label :for="'operate'+i" class="me-3 custom-lable">
                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="data.before_category" :id="'operate'+i" value="營運" />營運
                  </label>
                  <label :for="'device'+i" class="me-3 custom-lable">
                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="data.before_category" :id="'device'+i" value="設備" />設備
                  </label>
                </td>
                <td v-show="beforeShow" class="text-center">
                  <select class="form-select" v-model="data.before_s">
                    <option value="">請選擇</option>
                    <option value="S4">S4</option>
                    <option value="S3">S3</option>
                    <option value="S2">S2</option>
                    <option value="S1">S1</option>
                  </select>
                </td>
                <td v-show="beforeShow" class="text-center">
                  <select class="form-select" v-model="data.before_p">
                    <option value="">請選擇</option>
                    <option value="P4">P4</option>
                    <option value="P3">P3</option>
                    <option value="P2">P2</option>
                    <option value="P1">P1</option>
                  </select>
                </td>
                <td v-show="beforeShow" class="text-center">
                  <select class="form-select" v-model="data.before_level">
                    <option value="">請選擇</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                  </select>
                </td>
                <!-- 5.降低風險所採取之控制措施 -->
                <td v-show="controlShow"><input type="text" class="form-control" v-model="data.reduce_risk" placeholder="請輸入內容" /></td>
                <!-- 6.控制後預估風險 -->
                <td v-show="afterShow" class="text-center">
                  <select class="form-select" v-model="data.after_s">
                    <option value="">請選擇</option>
                    <option value="S4">S4</option>
                    <option value="S3">S3</option>
                    <option value="S2">S2</option>
                    <option value="S1">S1</option>
                  </select>
                </td>
                <td v-show="afterShow" class="text-center">
                  <select class="form-select" v-model="data.after_p">
                    <option value="">請選擇</option>
                    <option value="P4">P4</option>
                    <option value="P3">P3</option>
                    <option value="P2">P2</option>
                    <option value="P1">P1</option>
                  </select>
                </td>
                <td v-show="afterShow" class="text-center">
                  <select class="form-select" v-model="data.after_level">
                    <option value="">請選擇</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                  </select>
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
  import sitemap from '../../shared/sitemap.vue';
  export default {
    components: {
      navbar: navbar,
      sitemap: sitemap,
    },
    data() {
      return {
        harmShow: true,
        protectShow: true,
        beforeShow: true,
        controlShow: true,
        afterShow: true,
        allSelected: false,
        deviceName: "",
        selectedList:[],
        deviceList: [],
        deviceData: {
          id: -1,
          node: "",
          cover_device: "",
          node_description: "",
          process_deviation: "",
          failure_reason: "",
          failure_affect: "",
          protect_engineering: "",
          protect_manage: "",
          protect_personal: "",
          before_category: [],
          before_s: "",
          before_p: "",
          before_level: "",
          reduce_risk: "",
          after_s: "",
          after_p: "",
          after_level: ""
        }
      }
    },
    props: ["id"],
    setup(props) {
      //
    },
    mounted() {
      this.getData();
      $(".dropzone-users").sortable({
        connectWith: ".dropzone-users",
        handle: ".user-handle",
        placeholder: "drag-location",
        axis: "y",
        start: function (e, ui) {
          ui.placeholder.height(ui.helper.outerHeight());
        },
      });
    }, 
    methods: {
      getData: async function() {
        var vm = this;
        await axios.get(`/api/HAZOP/subDevice`, { params: { id: vm.id } })
        .then(function (resp) {
          vm.deviceList = resp.data.data;
          vm.deviceName = resp.data.device;
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      selectAll: function() {
        const vm = this;
        vm.selectedList = [];

        if (!vm.allSelected) {
          vm.deviceList.forEach(function (value, i) {
            vm.selectedList.push(i);
          });
        }
      },
      add: function() {
        this.deviceList.push({...this.deviceData});
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
          var selected = [];
          vm.selectedList.forEach(function (value) {
            if(vm.deviceList[value].id != -1) selected.push(vm.deviceList[value].id);
          });

          if (result.value) {
            axios.post(`/api/HAZOP/subDevice/0`, {
              _method: 'DELETE',
              ids: selected
            })
            .then(function (resp) {
              vm.selectedList.sort((f, s) => s - f);
              vm.selectedList.forEach(function (value) {
                vm.deviceList.splice(value, 1);
              });
              vm.selectedList = [];
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
          }
        });
      },
      save: function() {
        const vm = this;
        var sortArr = $(".dropzone-users").sortable("toArray");

        axios.post(`/api/HAZOP/subDevice`, {
          deviceList: vm.deviceList,
          sortArr: sortArr,
          device_id: vm.id
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
      changeShow: function() {
        const root = document.documentElement;
        var tableWidth = 3500;
        if(!this.harmShow) tableWidth -= 550;
        if(!this.protectShow) tableWidth -= 700;
        if(!this.beforeShow) tableWidth -= 560;
        if(!this.controlShow) tableWidth -= 400;
        if(!this.afterShow) tableWidth -= 360;
        root.style.setProperty('--tableWidth', `${tableWidth}px`);
      },
    },
  }
</script>