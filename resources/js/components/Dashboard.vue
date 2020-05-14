    

<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Temperature Chart</h3>

            
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
              <canvas id="canvas" height="350" width="1000"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>

        
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Humidity Chart</h3>

            
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
              <canvas id="canvas2" height="350" width="1000"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>

        
      </div>

      <div class="col-md-12">
      <div class="card p-3">
        <h4> List of Devices </h4>
        <div class="list-group">
          <div v-for="device in devices.data">
          <a  v-bind:href=" '/user_devices/' + device.id" class="list-group-item list-group-item-action">
            {{device.name}}             >
          </a>
          </div>
          
        </div>
      </div>
      </div>
    </div>
  </div>
</template>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script>
export default {
  mounted() {
    if (localStorage.getItem('reloaded')) {
        // The page was just reloaded. Clear the value from local storage
        // so that it will reload the next time this page is visited.
        localStorage.removeItem('reloaded');
    } else {
        // Set a flag so that we know not to reload the page twice.
        localStorage.setItem('reloaded', '1');
        location.reload();
    }
    setInterval(() => location.reload(), 60000);
    
  }, 
  data(){
    return{
      devices:[],
      errors: []
    }
  },
  created(){
    axios.get('api/device').then()
    .then(response => {
      // JSON responses are automatically parsed.
      this.devices = response.data
      console.log(this.devices)
    })
    .catch(e => {
      this.errors.push(e)
      console.log("Error nana")
    })
  }
  
};

  var url = "api/data";
  
  var Time = new Array();
  var Temps = new Array();
  $(document).ready(function(){
    $.get(url, function(response){
      response.forEach(function(data){
          Time.push(data.timestamp);
          Temps.push(data.temp);
      });
      var ctx = document.getElementById("canvas").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels:Time,
                datasets: [{
                    label: '',
                    data: Temps,
                    borderWidth: 1,
                    borderColor: "#2D2926",
                    backgroundColor: "rgba(0,0,0,0)",
                    pointBackgroundColor: "#2D2926",
                    pointBorderColor: "#2D2926",
                    pointHoverBackgroundColor: "#2D2926",
                    pointHoverBorderColor: "#2D2926",

                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
  });


var Humid = new Array();
  $(document).ready(function(){
    $.get(url, function(response){
      response.forEach(function(data){
          Humid.push(data.humid);
      });
      var ctx2 = document.getElementById("canvas2").getContext('2d');
          var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels:Time,
                datasets: [{
                    label: '',
                    data: Humid,
                    borderWidth: 1,
                    borderColor: "#2D2926",
                    backgroundColor: "rgba(0,0,0,0)",
                    pointBackgroundColor: "#2D2926",
                    pointBorderColor: "#2D2926",
                    pointHoverBackgroundColor: "#2D2926",
                    pointHoverBorderColor: "#2D2926",

                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
  });
</script>


