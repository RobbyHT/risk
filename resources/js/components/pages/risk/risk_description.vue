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
  h3 {
    color: #104C7D;
    font-size: 1.5em;
  }
  .banner-img {
    position: absolute;
    bottom: 0;
    right: 10%;
    width: 18%;
  }
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
  hr.style5 {
    background-color: #fff;
    border-top: 2px dashed #868AA5;
    opacity: 1;
  }
  .bg-5 {background-color: #F05030 !important;}
  .bg-4 {background-color: #E5B7B7 !important;}
  .bg-3 {background-color: #FBD4B3 !important;}
  .bg-2 {background-color: #C7D9F1 !important;}
  .bg-1 {background-color: #92D14F !important;}
  .td-auto {
    width: calc(40vh - 120px);
  }
  .table {
    font-size: 1.2em;
    font-weight: 900;
  }
  .ill-table thead {
    background-color: #C4B1CD;
  }
  .ill-table tbody {
    color: #0B4E81;
  }
  .ill-table tbody td:nth-child(1), .ill-table tbody td:nth-child(2) {
    background-color: #CCF9FE;
  }
  .ill-table tbody td:nth-child(3), .ill-table tbody td:nth-child(4) {
    background-color: #FFFDF1;
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
    </header>
    <main>
      <div class="left">
        <sidebar />
      </div>
      <div class="right">
        <div class="m-3 p-2 border border-2 outer-border-color rounded-3">
          <div class="text-center">
            <h2 class="mb-0 fw-bold">風險基準圖文說明</h2>
          </div>
          <hr class="style5 my-2">
          <div class="mx-2 my-3 p-2 border border-2 outer-border-color rounded-3">
            <h3 class="mb-0 fw-bold">風險矩陣法（Risk matrix）</h3>
            <table class="table table-bordered border-dark align-middle text-center fw-bold">
              <tr>
                <td colspan="2" rowspan="2"></td>
                <td colspan="4">可能性等級</td>
              </tr>
              <tr>
                <td>P4</td>
                <td>P3</td>
                <td>P2</td>
                <td>P1</td>
              </tr>
              <tr>
                <td rowspan="4" width="50px">嚴重度等級</td>
                <td>S4</td>
                <td class="bg-5">5</td>
                <td class="bg-4">4</td>
                <td class="bg-4">4</td>
                <td class="bg-3">3</td>
              </tr>
              <tr>
                <td>S3</td>
                <td class="bg-4">4</td>
                <td class="bg-4">4</td>
                <td class="bg-3">3</td>
                <td class="bg-3">3</td>
              </tr>
              <tr>
                <td>S2</td>
                <td class="bg-4">4</td>
                <td class="bg-3">3</td>
                <td class="bg-3">3</td>
                <td class="bg-2">2</td>
              </tr>
              <tr>
                <td>S1</td>
                <td class="bg-3">3</td>
                <td class="bg-3">3</td>
                <td class="bg-2">2</td>
                <td class="bg-1">1</td>
              </tr>
            </table>
          </div>
          <div class="mx-2 my-3 p-2 border border-2 outer-border-color rounded-3">
            <h3 class="mb-0 fw-bold">風險矩陣法判定基準說明</h3>
            <table class="table table-bordered border-dark align-middle text-center fw-bold ill-table">
              <thead>
                <tr>
                  <th colspan="2">等級</th>
                  <th>人員傷亡</th>
                  <th>危害影響範圍</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="40px">S4</td>
                  <td width="80px">重大</td>
                  <td class="td-auto text-start">造成一人以上死亡、三人以上受傷、或是可能發生無法復原之職業病的災害。</td>
                  <td class="td-auto text-start">大量危害物質洩漏；<br/>危害影響範圍擴及廠外，對環境及公眾健康有立即及持續衝擊。</td>
                </tr>
                <tr>
                  <td>S3</td>
                  <td>高度</td>
                  <td class="text-start">造成永久失能或可能發生可復原之職業病的災害。</td>
                  <td class="text-start">中量危害物質洩漏；<br/>危害影響範圍除廠內外，對環境及公眾健康有暫時性衝擊。</td>
                </tr>
                <tr>
                  <td>S2</td>
                  <td>中度</td>
                  <td class="text-start">須外送就醫，且造成工時損失之災害或可能發生因職業健康問題造成工時損失之狀況。</td>
                  <td class="text-start">少量危害物質洩漏；<br/>危害影響限於工廠局部區域。</td>
                </tr>
                <tr>
                  <td>S1</td>
                  <td>輕度</td>
                  <td class="text-start">僅須急救處理，或外送就醫，但未造成工時損失之輕度災害或可能發生因職業健康問題造成工作效率降低之現象。</td>
                  <td class="text-start">微量危害物質洩漏；<br/>危害影響限於局部設備附近，或無明顯危害。</td>
                </tr>
              </tbody>
            </table>
            <table class="mt-3 table table-bordered border-dark align-middle text-center fw-bold ill-table">
              <thead>
                <tr>
                  <th colspan="2">等級</th>
                  <th>預期危害事件發生的可能</th>
                  <th>防護設施的完整性及有效性</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="40px">P4</td>
                  <td width="80px">極可能</td>
                  <td class="td-auto text-start">每年 1 次（含）以上；<br/>在製程、活動或服務之生命週期內可能會發生 5 次以上。</td>
                  <td class="td-auto text-start">未設置必要的防護設施，或所設置之防護設施並無法發揮其功能。</td>
                </tr>
                <tr>
                  <td>P3</td>
                  <td>較有可能</td>
                  <td class="text-start">每 1-5 年 1 次；<br/>在製程、活動或服務之生命週期內可能會發生 1 至 4 次以上。</td>
                  <td class="text-start">僅設置部分必要的防護設施，或對已設置之防護設施，未定期維護保養或監督查核。</td>
                </tr>
                <tr>
                  <td>P2</td>
                  <td>有可能</td>
                  <td class="text-start">每 5-10 年 1 次；<br/>在製程、活動或服務之生命週期內可能會發生 0.2 - 1 次 。</td>
                  <td class="text-start">已設置必要的防護設施，且有定期維護保養或監督查核使其維持在可用狀態。</td>
                </tr>
                <tr>
                  <td>P1</td>
                  <td>不太可能</td>
                  <td class="text-start">低於 10 年 1 次；<br/>在製程、活動或服務之生命週期內不太會發生(0.2次以下)。</td>
                  <td class="text-start">除已設置必要的防護設施外，另增設其他防護設施，且有定期維護保養或監督查核，以維持其應有的功能。</td>
                </tr>
              </tbody>
            </table>
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
  import sidebar from '../../shared/sidebar_risk.vue';
  import sitemap from '../../shared/sitemap.vue';
  export default {
    components: {
      navbar: navbar,
      sidebar: sidebar,
      sitemap: sitemap,
    },
    props: {
      //
    },
    setup(props) {
      //
    },
    methods: {
      test: function() {
        /*const root = document.documentElement;
        const headerHeight = $("header").height();
        root.style.setProperty('--headerHeight', `${headerHeight}px`);*/
      },
    },
    mounted() {
      /*console.log('[mounted]');
      const vm = this;
      vm.test();
      $(window).resize(function() {
        vm.test();
      })*/
    }, 
  }
</script>