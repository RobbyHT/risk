<style>
  :root {
    --tableWidth: 3400px;
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
  /*.table {
    font-size: 1.2em;
    font-weight: 900;
    background: #EAFCFF;
    width: var(--tableWidth);
  }*/
  .sorting {
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
  td.has-nested-table {
  	cursor:pointer;
  	padding:0;
  }
  td.has-nested-table > .table {
  	border: 0;
    margin: 0;
  }
  td.has-nested-table td {
    border-width: 1px;
  }
  td.has-nested-table td:first-child {
  	border-left:0;
  }
  td.has-nested-table td:last-child {
  	border-right:0;
  }
  td.has-nested-table > table > tbody:not(.no-multiple):first-child > tr > td {
  	border-top: 0;
  }
  td.has-nested-table > table > tbody:not(.no-multiple):last-child > tr > td {
  	border-bottom: 0;
  }
  td.has-nested-table > table > tbody.no-multiple > tr:first-child > td {
  	border-top: 0;
  }
  td.has-nested-table > table > tbody.no-multiple > tr > td {
  	border-bottom: 0;
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
            <li class="breadcrumb-item"><inertia-link href="/risk/JSA">JSA列表</inertia-link></li>
            <li class="breadcrumb-item active" aria-current="page">JSA分析結果</li>
          </ol>
        </nav>
      </div>
    </header>
    <main>
      <div class="m-3 p-2 border border-2 outer-border-color rounded-3">
        <div class="text-center">
          <h2 class="mb-0 fw-bold">JSA分析結果</h2>
        </div>
        <div class="mt-2 pt-3 pb-1 px-3 bg-white">
          <p>設備名稱：0503-C01 誘引抽風機</p>
          <p class="d-flex flex-wrap align-items-center">
            顯示內容：
            <label for="harm" class="me-3 custom-lable">
              <input type="checkbox" v-model="harmShow" @change="changeShow" class="form-check-input custom-checkbox-size me-1" name="showContent[]" id="harm" />
              危害類型、原因與影響
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
            <button class="btn btn-primary mx-1" @click="addMainTitle">
              <i class="bi bi-plus-square"></i>
              新增主標
            </button>
            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addSubModal">
              <i class="bi bi-plus-square"></i>
              新增次標
            </button>
            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addContentModal">
              <i class="bi bi-plus-square"></i>
              新增內容
            </button>
            <button class="btn btn-danger mx-1" @click="del">
              <i class="bi bi-dash-square"></i>
              刪除
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="sorting table table-bordered border-dark align-middle text-center fw-bold main-sort">
            <thead class="align-middle">
              <tr>
                <td class="" rowspan="2" width="60px">順序調整</td>
                <td class="" rowspan="2" width="40px"><input type="checkbox" class="form-check-input custom-checkbox-size" v-model="allSelected" @click="selectAll" /></td>
                <td class="head head-bg-1" colspan="3">1.設備、組件或元件</td>
                <td v-show="harmShow" class="head head-bg-2" colspan="2">2.危害類型、原因與影響</td>
                <td v-show="protectShow" class="head head-bg-3" colspan="3">3.現有防護設施</td>
                <td v-show="beforeShow" class="head head-bg-4" colspan="4">4.控制前預估風險</td>
                <td v-show="controlShow" class="head head-bg-5" rowspan="2" width="400px">5.降低風險所採取之控制措施</td>
                <td v-show="afterShow" class="head head-bg-6" colspan="3">6.控制後預估風險</td>
              </tr>
              <tr>
                <!-- 1.設備、組件或元件 -->
                <td class="th-color-1" width="100px">步驟序號</td>
                <td class="th-color-1" width="320px">操作動作</td>
                <td class="th-color-1" width="310px">說明</td>
                <!-- 2.危害類型、原因與影響 -->
                <td v-show="harmShow" class="th-color-2" width="250px">動作不確實<br/>(跳過、部分完成、反向動作)</td>
                <td v-show="harmShow" class="th-color-2" width="350px">可能造成影響之情境描述</td>
                <!-- 3.現有防護設施 -->
                <td v-show="protectShow" class="th-color-3" width="250px">工程控制<br/>(含偵測或連鎖)</td>
                <td v-show="protectShow" class="th-color-3" width="200px">管理控制</td>
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
            <tbody v-for="(device, x) in deviceList" :id="x" :key="device.id">
              <!-- 主標 -->
              <tr>
                <td class="text-center" width="60px"><i class="bi bi-list user-handle handle"></i></td>
                <td class="text-center" width="40px"><input type="checkbox" class="form-check-input custom-checkbox-size" v-model="mainSelectedList" :value="x" @click="selectMain(x);" /></td>
                <td colspan="3" style="min-width: 730px;"><input type="text" class="form-control" v-model="device.main_title" placeholder="請輸入內容" /></td>
              </tr>
              <tr v-if="device.subList.length > 0">
                <td colspan="18" class="has-nested-table">
                  <table class="sub-sort table align-middle text-center fw-bold">
                    <tbody v-for="(sub, y) in device.subList" :id="x+'-'+y" :key="sub.id">
                      <tr>
                        <td class="text-center" width="60px"><i class="bi bi-list user-handle handle"></i></td>
                        <td class="text-center" width="40px"><input type="checkbox" class="form-check-input custom-checkbox-size" v-model="device.subSelectedList" :value="y" @click="selectSub(x, y);" /></td>
                        <td colspan="2" style="min-width: 420px;"><input type="text" class="form-control" v-model="sub.sub_title" placeholder="請輸入內容" /></td>
                        <td width="310px"></td>
                        <!-- 2.危害類型、原因與影響 -->
                        <td v-show="harmShow" width="250px"></td>
                        <td v-show="harmShow" width="350px"></td>
                        <!-- 3.現有防護設施 -->
                        <td v-show="protectShow" width="250px"></td>
                        <td v-show="protectShow" width="200px"></td>
                        <td v-show="protectShow" width="200px"></td>
                        <!-- 4.控制前預估風險 -->
                        <td v-show="beforeShow" width="200px"></td>
                        <td v-show="beforeShow" width="120px"></td>
                        <td v-show="beforeShow" width="120px"></td>
                        <td v-show="beforeShow" width="120px"></td>
                        <!-- 5.降低風險所採取之控制措施 -->
                        <td v-show="controlShow" width="400px"></td>
                        <!-- 6.控制後預估風險 -->
                        <td v-show="afterShow" width="120px"></td>
                        <td v-show="afterShow" width="120px"></td>
                        <td v-show="afterShow" width="120px"></td>
                      </tr>
                      <tr v-if="sub.contentList.length > 0">
                        <td colspan="18" class="has-nested-table">
                          <table class=" table align-middle text-center fw-bold">
                            <tbody class="no-multiple content-sort">
                              <!-- 內容 -->
                              <tr v-for="(content, z) in sub.contentList" :id="x+'-'+y+'-'+z" :key="content.id">
                                <td class="text-center" width="60px"><i class="bi bi-list user-handle handle"></i></td>
                                <td class="text-center" width="40px"><input type="checkbox" class="form-check-input custom-checkbox-size" v-model="sub.contentSelectedList" :value="z" @click="selectContent(x, y, z);" /></td>
                                <!-- 1.設備、組件或元件 -->
                                <td class="text-center" width="100px">{{sub.contentSortArr!=null ? sub.contentSortArr.indexOf(x+'-'+y+'-'+z)+1 : z+1}}</td>
                                <td width="320px"><input type="text" class="form-control" v-model="content.action" placeholder="請輸入內容" /></td>
                                <td width="310px"><input type="text" class="form-control" v-model="content.description" placeholder="請輸入內容" /></td>
                                <!-- 2.危害類型、原因與影響 -->
                                <td v-show="harmShow" width="250px"><input type="text" class="form-control" v-model="content.inaccurate" placeholder="請輸入內容" /></td>
                                <td v-show="harmShow" width="350px"><input type="text" class="form-control" v-model="content.affect" placeholder="請輸入內容" /></td>
                                <!-- 3.現有防護設施 -->
                                <td v-show="protectShow" width="250px"><input type="text" class="form-control" v-model="content.protect_engineering" placeholder="請輸入內容" /></td>
                                <td v-show="protectShow" width="200px"><input type="text" class="form-control" v-model="content.protect_manage" placeholder="請輸入內容" /></td>
                                <td v-show="protectShow" width="200px"><input type="text" class="form-control" v-model="content.protect_personal" placeholder="請輸入內容" /></td>
                                <!-- 4.控制前預估風險 -->
                                <td v-show="beforeShow" class="text-center" width="200px">
                                  <label :for="'safety'+x+y+z" class="me-3 custom-lable">
                                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="content.before_category" :id="'safety'+x+y+z" value="安全" />安全
                                  </label>
                                  <label :for="'environment'+x+y+z" class="me-3 custom-lable">
                                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="content.before_category" :id="'environment'+x+y+z" value="環保" />環保
                                  </label>
                                  <br/>
                                  <label :for="'operate'+x+y+z" class="me-3 custom-lable">
                                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="content.before_category" :id="'operate'+x+y+z" value="營運" />營運
                                  </label>
                                  <label :for="'device'+x+y+z" class="me-3 custom-lable">
                                    <input type="checkbox" class="form-check-input custom-checkbox-size me-1" v-model="content.before_category" :id="'device'+x+y+z" value="設備" />設備
                                  </label>
                                </td>
                                <td v-show="beforeShow" class="text-center" width="120px">
                                  <select class="form-select" v-model="content.before_s">
                                    <option value="">請選擇</option>
                                    <option value="S4">S4</option>
                                    <option value="S3">S3</option>
                                    <option value="S2">S2</option>
                                    <option value="S1">S1</option>
                                  </select>
                                </td>
                                <td v-show="beforeShow" class="text-center" width="120px">
                                  <select class="form-select" v-model="content.before_p">
                                    <option value="">請選擇</option>
                                    <option value="P4">P4</option>
                                    <option value="P3">P3</option>
                                    <option value="P2">P2</option>
                                    <option value="P1">P1</option>
                                  </select>
                                </td>
                                <td v-show="beforeShow" class="text-center" width="120px">
                                  <select class="form-select" v-model="content.before_level">
                                    <option value="">請選擇</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                  </select>
                                </td>
                                <!-- 5.降低風險所採取之控制措施 -->
                                <td v-show="controlShow" width="400px"><input type="text" class="form-control" v-model="content.reduce_risk" placeholder="請輸入內容" /></td>
                                <!-- 6.控制後預估風險 -->
                                <td v-show="afterShow" class="text-center" width="120px">
                                  <select class="form-select" v-model="content.after_s">
                                    <option value="">請選擇</option>
                                    <option value="S4">S4</option>
                                    <option value="S3">S3</option>
                                    <option value="S2">S2</option>
                                    <option value="S1">S1</option>
                                  </select>
                                </td>
                                <td v-show="afterShow" class="text-center" width="120px">
                                  <select class="form-select" v-model="content.after_p">
                                    <option value="">請選擇</option>
                                    <option value="P4">P4</option>
                                    <option value="P3">P3</option>
                                    <option value="P2">P2</option>
                                    <option value="P1">P1</option>
                                  </select>
                                </td>
                                <td v-show="afterShow" class="text-center" width="120px">
                                  <select class="form-select" v-model="content.after_level">
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
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
    <!-- 新增次標 -->
    <div class="modal fade" id="addSubModal" ref="addSubModal" tabindex="-1" aria-labelledby="addSubModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addSubModalLabel">新增次標</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 d-flex row">
              <div class="col-3 text-center">
                <label for="addDeviceName" class="col-form-label">選擇主標：</label>
              </div>
              <div class="col-8 p-0">
                <select class="form-select" v-model="choseMain">
                  <option value=-1>請選擇</option>
                  <option v-for="(device, index) in deviceList" :key="index" :value="index">
                    {{device.main_title}}
                  </option>
                </select>
              </div>
              <div class="col-1 p-0"></div>
            </div>
            <div class="mb-3 d-flex row" v-for="(subTitle, index) in subTitleList" :key="index">
              <div class="col-3 text-center"><label for="addDeviceName" class="col-form-label">次標名稱：</label></div>
              <div class="col-8 p-0"><input type="text" class="form-control" v-model="subTitle.title" /></div>
              <div class="col-1 p-0 fs-5 d-flex justify-content-center align-items-center">
                <i class="bi bi-dash-circle-fill text-danger" @click="delSubTitle(index)" v-show="index!=0"></i>
              </div>
            </div>
            <div class="text-center">
              <button class="btn btn-info" @click="addSubTitle">新增次標</button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="subTitleList=[{title: ''}]">取消</button>
            <button type="button" class="btn btn-primary" @click="saveSubTitle" :disabled="choseMain==-1">確認</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 新增內容 -->
    <div class="modal fade" id="addContentModal" ref="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addContentModalLabel">新增內容</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 d-flex row">
              <div class="col-3 text-center">
                <label for="addDeviceName" class="col-form-label">選擇主標：</label>
              </div>
              <div class="col-8 p-0">
                <select class="form-select" v-model="choseMain">
                  <option value=-1>請選擇</option>
                  <option v-for="(device, index) in deviceList" :key="index" :value="index">
                    {{device.main_title}}
                  </option>
                </select>
              </div>
              <div class="col-1 p-0"></div>
            </div>
            <div class="mb-3 d-flex row">
              <div class="col-3 text-center">
                <label for="addDeviceName" class="col-form-label">選擇次標：</label>
              </div>
              <div class="col-8 p-0">
                <select class="form-select" v-model="choseSub">
                  <option value=-1>請選擇</option>
                  <template v-if="choseMain!=-1">
                    <option v-for="(sub, index) in deviceList[choseMain].subList" :key="index" :value="index" >
                      {{sub.sub_title}}
                    </option>
                  </template>
                </select>
              </div>
              <div class="col-1 p-0"></div>
            </div>
            <div class="mb-3 d-flex row">
              <div class="col-3 text-center"><label for="addDeviceName" class="col-form-label">內容數量：</label></div>
              <div class="col-8 p-0"><input type="number" class="form-control" v-model="contentNum" /></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" @click="saveContent" :disabled="choseSub==-1">確認</button>
          </div>
        </div>
      </div>
    </div>
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
        addSubModal: null,
        addContentModal: null,
        mainSortArr: [],
        mainSelectedList: [],
        choseMain: -1,
        choseSub: -1,
        contentNum: 0,
        subTitleList: [{
          title: ""
        }],
        deviceList: [],
        deviceData: {
          id: -1,
          main_title: "",
          subList: [],
          subSortArr: [],
          subSelectedList: [],
        },
        subData: {
          id: -1,
          sub_title: "",
          contentList: [],
          contentSortArr: [],
          contentSelectedList: [],
        },
        contentData: {
          id: -1,
          action: "",
          description: "",
          inaccurate: "",
          affect: "",
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
          after_level: "",
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
      vm.addSubModal = new Modal(vm.$refs.addSubModal);
      vm.addContentModal = new Modal(vm.$refs.addContentModal);
    }, 
    updated() {
      const vm = this;
      $(".main-sort").sortable({
        handle: ".user-handle",
        placeholder: "drag-location",
        axis: "y",
        start: function (e, ui) {
          ui.placeholder.height(ui.helper.outerHeight());
        },
        update: function(event, ui) {
          vm.mainSortArr = $(this).sortable('toArray');
          console.log(vm.mainSortArr);
        }
      });
      $(".sub-sort").sortable({
        handle: ".user-handle",
        placeholder: "drag-location",
        axis: "y",
        start: function (e, ui) {
          ui.placeholder.height(ui.helper.outerHeight());
        },
        update: function(event, ui) {
          vm.doSorting();
        }
      });
      $(".content-sort").sortable({
        handle: ".user-handle",
        placeholder: "drag-location",
        axis: "y",
        start: function (e, ui) {
          ui.placeholder.height(ui.helper.outerHeight());
        },
        update: function(event, ui) {
          vm.doSorting();
        }
      });
    },
    methods: {
      doSorting: async function() {
        const vm = this;
        await nextTick();
        for (let x of [...Array(vm.deviceList.length).keys()]) {
          let arr = [];
          $(`#${x} > tr > td > table > tbody`).each(function() {
            arr.push($(this).attr('id'));
          });
          vm.deviceList[x].subSortArr = arr;
          for (let y of [...Array(vm.deviceList[x].subList.length).keys()]) {
            arr = [];
            $(`#${x}-${y} > tr > td > table > tbody > tr`).each(function() {
              arr.push($(this).attr('id'));
            });
            vm.deviceList[x].subList[y].contentSortArr = arr;
          }
        }
      },
      getData: async function() {
        const vm = this;
        await axios.get(`/api/JSA/subDevice`, { params: { id: vm.id } })
        .then(function (resp) {
          vm.deviceList = resp.data.data;
          vm.deviceName = resp.data.device;
          vm.doSorting();
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      selectAll: function() {
        const vm = this;
        vm.deviceList.forEach(function (value, i) {
          vm.selectMain(i);
        });
      },
      selectMain: function(x) {
        const vm = this;
        const mainIndex = vm.mainSelectedList.indexOf(x);
        if(mainIndex == -1) {
          vm.mainSelectedList.push(x);

          vm.deviceList[x].subSelectedList = [];
          vm.deviceList[x].subList.forEach(function (value, y) {
            vm.deviceList[x].subSelectedList.push(y);

            vm.deviceList[x].subList[y].contentSelectedList = [];
            vm.deviceList[x].subList[y].contentList.forEach(function (value, z) {
              vm.deviceList[x].subList[y].contentSelectedList.push(z);
            });
          });
        }else{
          vm.mainSelectedList.splice(mainIndex, 1);
          vm.deviceList[x].subSelectedList = [];
          vm.deviceList[x].subList.forEach(function (value, y) {
            vm.deviceList[x].subList[y].contentSelectedList = [];
          });
        }
        if(vm.allSelected){
          vm.mainSelectedList.splice(mainIndex, 1);
          vm.deviceList[x].subSelectedList = [];
          vm.deviceList[x].subList.forEach(function (value, y) {
            vm.deviceList[x].subList[y].contentSelectedList = [];
          });
        }
      },
      selectSub: function(x, y) {
        const vm = this;
        if(vm.deviceList[x].subSelectedList == null) {
          vm.deviceList[x].subSelectedList = [];
        }
        const subIndex = vm.deviceList[x].subSelectedList.indexOf(y);
        if(subIndex == -1) {
          vm.deviceList[x].subSelectedList.push(y);

          vm.deviceList[x].subList[y].contentSelectedList = [];
          vm.deviceList[x].subList[y].contentList.forEach(function (value, z) {
            vm.deviceList[x].subList[y].contentSelectedList.push(z);
          });
        }else{
          vm.deviceList[x].subSelectedList.splice(subIndex, 1);
          vm.deviceList[x].subList[y].contentSelectedList = [];
        }
        const mainIndex = vm.mainSelectedList.indexOf(x);
        if(vm.deviceList[x].subSelectedList.length != vm.deviceList[x].subList.length) {
          if(mainIndex != -1) vm.mainSelectedList.splice(mainIndex, 1);
        }else{
          vm.mainSelectedList.push(x);
        }
      },
      selectContent: function(x, y, z) {
        const vm = this;
        if(vm.deviceList[x].subSelectedList == null) vm.deviceList[x].subSelectedList = [];
        if(vm.deviceList[x].subList[y].contentSelectedList == null) vm.deviceList[x].subList[y].contentSelectedList = [];

        const contentIndex = vm.deviceList[x].subList[y].contentSelectedList.indexOf(z);
        if(contentIndex == -1) {
          vm.deviceList[x].subList[y].contentSelectedList.push(z);
        }else{
          vm.deviceList[x].subList[y].contentSelectedList.splice(contentIndex, 1);
        }
        const subIndex = vm.deviceList[x].subSelectedList.indexOf(y);
        if(vm.deviceList[x].subList[y].contentSelectedList.length != vm.deviceList[x].subList[y].contentList.length) {
          if(subIndex!=-1) vm.deviceList[x].subSelectedList.splice(subIndex, 1);
        }else{
          vm.deviceList[x].subSelectedList.push(y);
        }
        const mainIndex = vm.mainSelectedList.indexOf(x);
        if(vm.deviceList[x].subSelectedList.length != vm.deviceList[x].subList.length) {
          if(mainIndex != -1) vm.mainSelectedList.splice(mainIndex, 1);
        }else{
          vm.mainSelectedList.push(x);
        }
      },
      addMainTitle: async function() {
        const vm = this;
        await vm.deviceList.push({...vm.deviceData});
        vm.mainSortArr = $(".main-sort").sortable("toArray");
      },
      addSubTitle: function() {
        const vm = this;
        vm.subTitleList.push({title: ""});
      },
      delSubTitle: function(index) {
        const vm = this;
        vm.subTitleList.splice(index, 1);
      },
      saveSubTitle: async function() {
        const vm = this;
        for await (let subTitle of vm.subTitleList) {
          let temp = {...vm.subData};
          temp.sub_title = subTitle.title;
          vm.deviceList[vm.choseMain].subList = [...vm.deviceList[vm.choseMain].subList, temp];
        }
        vm.addSubModal.hide();
        vm.doSorting();
      },
      saveContent: async function() {
        const vm = this;
        for await (let i of [...Array(vm.contentNum)]) {
          vm.deviceList[vm.choseMain].subList[vm.choseSub].contentList = [...vm.deviceList[vm.choseMain].subList[vm.choseSub].contentList,{...vm.contentData}];
        }
        vm.addContentModal.hide();
        vm.doSorting();
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
            let mainDel = [];
            let subDel = [];
            let contentDel = [];
            //main
            vm.mainSelectedList.forEach(function (x) {
              if(vm.deviceList[x].id != -1) mainDel.push(vm.deviceList[x].id);
            });
            //sub
            let subBuild = [];
            let contentBuild = [];
            vm.deviceList.forEach(function (main, x) {
              if(main.subSelectedList != null) {
                subBuild.push({
                  mainIndex: x,
                  subArr: main.subSelectedList
                });
                main.subSelectedList.forEach(function (y) {
                  if(main.subList[y].id != -1) subDel.push(main.subList[y].id);
                });
              }
              main.subList.forEach(function (sub, y) {
                contentBuild.push({
                  mainIndex: x,
                  subIndex: y,
                  contentArr: sub.contentSelectedList??[]
                });
                if(sub.contentSelectedList != null) {
                  sub.contentSelectedList.forEach(function (z) {
                    if(sub.contentList[z].id != -1) contentDel.push(sub.contentList[z].id);
                  });
                }
              });
            });
            
            axios.post(`/api/JSA/subDevice/0`, {
              _method: 'DELETE',
              mainDel: mainDel,
              subDel: subDel,
              contentDel: contentDel,
            })
            .then(async function (resp) {
              // 前端刪除，就不重新讀取資料了
              contentBuild.sort((f, s) => s - f);
              contentBuild.forEach(function (build) {
                build.contentArr.forEach(function (value) {
                  vm.deviceList[build.mainIndex].subList[build.subIndex].contentList.splice(value, 1);
                });
                vm.deviceList[build.mainIndex].subList[build.subIndex].contentSelectedList = [];
              });
              subBuild.sort((f, s) => s - f);
              subBuild.forEach(function (build) {
                build.subArr.forEach(function (value) {
                  vm.deviceList[build.mainIndex].subList.splice(value, 1);
                });
                vm.deviceList[build.mainIndex].subSelectedList = [];
              });
              vm.mainSelectedList.sort((f, s) => s - f);
              vm.mainSelectedList.forEach(function (value) {
                vm.deviceList.splice(value, 1);
              });
              vm.mainSelectedList = [];
              
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

        axios.post(`/api/JSA/subDevice`, {
          deviceList: vm.deviceList,
          mainSortArr: vm.mainSortArr,
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
        var tableWidth = 3400;
        if(!this.harmShow) tableWidth -= 600;
        if(!this.protectShow) tableWidth -= 650;
        if(!this.beforeShow) tableWidth -= 560;
        if(!this.controlShow) tableWidth -= 400;
        if(!this.afterShow) tableWidth -= 360;
        root.style.setProperty('--tableWidth', `${tableWidth}px`);
      },
    },
  }
</script>