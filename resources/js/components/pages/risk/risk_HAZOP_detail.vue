<style>
  :root {
    --tableWidth: 3400px;
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
        <div class="table-responsive">
          <table class="mt-3 table table-bordered border-dark align-middle text-center fw-bold">
            <thead class="align-middle">
              <tr>
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
            <tbody class="text-start">
              <tr v-for="(data, i) in deviceList" :id="i" :key="data.id">
                <!-- 1.設備、組件或元件 -->
                <td class="text-center">{{data.node}}</td>
                <td>{{data.cover_device}}</td>
                <td>{{data.node_description}}</td>
                <td>{{data.process_deviation}}</td>
                <!-- 2.危害類型、原因與影響 -->
                <td v-show="harmShow">{{data.failure_reason}}</td>
                <td v-show="harmShow">{{data.failure_affect}}</td>
                <!-- 3.現有防護設施 -->
                <td v-show="protectShow">{{data.protect_engineering}}</td>
                <td v-show="protectShow">{{data.protect_manage}}</td>
                <td v-show="protectShow">{{data.protect_personal}}</td>
                <!-- 4.控制前預估風險 -->
                <td v-show="beforeShow" class="text-center">
                  {{data.before_category.join(', ')}}
                </td>
                <td v-show="beforeShow" class="text-center">{{data.before_s}}</td>
                <td v-show="beforeShow" class="text-center">{{data.before_p}}</td>
                <td v-show="beforeShow" class="text-center">{{data.before_level}}</td>
                <!-- 5.降低風險所採取之控制措施 -->
                <td v-show="controlShow">{{data.reduce_risk}}</td>
                <!-- 6.控制後預估風險 -->
                <td v-show="afterShow" class="text-center">{{data.after_s}}</td>
                <td v-show="afterShow" class="text-center">{{data.after_p}}</td>
                <td v-show="afterShow" class="text-center">{{data.after_level}}</td>
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
        deviceName: "",
        deviceList: [],
      }
    },
    props: ["id"],
    setup(props) {
      //
    },
    mounted() {
      this.getData();
    }, 
    methods: {
      getData: function() {
        var vm = this;
        axios.get(`/api/HAZOP/subDevice`, { params: { id: vm.id } })
        .then(function (resp) {
          vm.deviceList = resp.data.data;
          vm.deviceName = resp.data.device;
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      changeShow: function() {
        const root = document.documentElement;
        var tableWidth = 3400;
        if(!this.harmShow) tableWidth -= 550;
        if(!this.protectShow) tableWidth -= 700;
        if(!this.beforeShow) tableWidth -= 560;
        if(!this.controlShow) tableWidth -= 400;
        if(!this.afterShow) tableWidth -= 360;
        console.log(tableWidth);
        root.style.setProperty('--tableWidth', `${tableWidth}px`);
      },
    },
  }
</script>