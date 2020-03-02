

<template>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Devices Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal"  data-target="#addNew">Add New Device<i class="fas fa-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Reference Number</th>
                            <th>Delete</th>
                        </tr>
                        <tr v-for="device in devices" :key="device.id">
                            <td>{{ device.id }}</td>
                            <td>{{ device.name}}</td>
                            <td>{{device.refnum }}</td>

                            <td>
                
                                <a href="#" @click="deleteDevice(device.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>

                            </td>
                        </tr>
                        </tbody></table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    
            </div>

        </div>


        <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="addDevice">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Name or Location"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>

                     <div class="form-group">
                        <input v-model="form.refnum" type="text" name="refnum"
                            placeholder="Reference Number"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('refnum') }">
                        <has-error :form="form" field="refnum"></has-error>
                    </div>

                    <div class="form-group">

                        <input v-model="form.user_id" type="hidden" name="user_id"
                            value="$user_id"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }">
                        <has-error :form="form" field="user_id"></has-error>
                    </div>

                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

                </form>

                </div>
            </div>
            </div>

        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                devices: {},
                form: new Form({
                    name : '',
                    refnum : '',
                    user_id: ''
                })
            }
        },
        methods: {
            

            addDevice(){
                this.$Progress.start(); 
                this.form.post('api/device')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').hide();
                    $('.modal-backdrop').hide();
                    
                    swal({
                        position: 'top-end',
                        icon: 'success',
                        title: 'New device has been added',
                        buttons: {
                            confirm:{
                                visible: false
                            }
                        },
                        timer: 1500
                    })


                    this.$Progress.finish();
                })
                .catch(()=>{
                    console.log('Error when adding')
                });
                
            
            },
            loadDevice(){
                axios.get('api/device').then(({data}) => (this.devices = data.data))
            },

            deleteDevice(id){
                swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        buttons: {
                            confirm: {
                                text: "Delete!",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                            },
                            cancel: {
                                text: "Cancel",
                                value: false,
                                visible: true,
                                className: "",
                                closeModal: true,
                            }
                            
                        }
                    }).then((isConfirm) => {

                    if(isConfirm){
                        this.form.delete('api/device/'+id).then(() =>{

                        swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                        Fire.$emit('AfterCreate'); 
                        }).catch(() => {
                            swal("Failed", "There was something wrong.", "warning");
                        })
                    }
                    
                    
                }).catch(() => {
                    console.log("Error deleting");
                })
            }
        },
        created(){
            this.loadDevice();
            Fire.$on('AfterCreate', () => {
                this.loadDevice();
            });
        }
    }
</script>
