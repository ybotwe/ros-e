    

<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Line Chart</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                  <div class></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                  <div class></div>
                </div>
              </div>
              <line-chart :data="chartData"></line-chart>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Line Chart</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                  <div class></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                  <div class></div>
                </div>
              </div>
              <line-chart :data="chartData"></line-chart>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data(){
      return{
          chartData:{
              '2017-05-13': 2,
              '2017-05-14': 5,
              '2017-05-15': 4,
              
          }
      }
  }
};
</script>


