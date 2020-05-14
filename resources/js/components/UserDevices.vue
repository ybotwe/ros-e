<template>
    <div class="container" >
        <div class="row">
            <div class="card-deck" style="color: black">
                <div class="card text-white mb-3" style="width: 18rem; ">
                <div class="card-header" style="color: black">Temperature</div>
                <div class="card-body">
                    <h1 class="card-text mx-auto" style="font-size: 50px; color: black">{{ data[0].temp }}°C</h1>
                </div>
                </div>
                <div class="card text-white mb-3" style="width: 18rem;">
                <div class="card-header" style="color: black">Humidity</div>
                <div class="card-body">
                    <h1 class="card-text mx-auto" style="font-size: 50px; color: black">{{data[0].humid}}%</h1>
                </div>
                </div>
                
                
                <div class="card text-white mb-3" style="width: 18rem;">
                <div class="card-header" style="color: black">Gas Condition</div>
                <div class="card-body">
                    
                    <div v-if="data[0].gasStat == 0">
                        <h5 class="card-title" style="color: black">Gas Level Safe</h5>
                        <h4 class="card-text" style="color: black">No Smoke Detected.</h4>
                    </div>
                    <div v-else>
                        <h5 class="card-title" style="color: black">Gas Level Unsafe</h5>
                        <h4 class="card-text" style="color: black">Smoke Detected.</h4>
                    </div>
                    
                </div>
                </div>
                
                
            </div>
                
            </div>
        
        
        <div class="row">
            <div class="card-deck">
                <div class="card text-white mb-3" style="width: 18rem;">
                <div class="card-header" style="color: black">Light Intensity</div>
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 50px; color: black">{{data[0].ldr}}</h1>
                    <div v-if="data[0].ldr > 550">
                        <p class="card-text" style="color: black">Bright</p>
                    </div>
                    <div v-else>
                         <p class="card-text" style="color: black">Dark</p>
                    </div>
                    
                </div>
                </div>
                <div class="card text-white mb-3" style="width: 18rem;">
                <div class="card-header" style="color: black">Room Occupancy</div>
                <div class="card-body">
                    <div v-if="data[0].pir == 0">
                        <h3 class="card-title" style="color: black">Room Not Occupied</h3>
                    </div>
                    <div v-else>
                        <h3 class="card-title" style="color: black">Room Occupied</h3>
                    </div>
                    
                </div>
                </div>
                
                
                
                
            </div>
                
            </div>
        
        
   </div>
</template>

<script>
    export default {
        mounted() {
            setInterval(() => location.reload(), 60000);
        },
        data(){
            return {
                id: this.$route.params.deviceId,
                data: {}
            }
        },
        created(){
            axios.get('/api/deviceData/' + this.id)
            .then(response => {
                this.data = response.data;
            });
        }
    }
</script>
