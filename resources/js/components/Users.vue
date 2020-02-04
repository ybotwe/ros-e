<template>
    <div class="container">
        
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Users</h3>

                <div class="card-tools">
                  <button class="btn btn-success" data-toggle="modal" data-target="#newUser"><i class="fas fa-plus"></i> New User</button>
                  <!-- Modal -->
                <div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserTitle">Add new user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <input v-model="form.username" placeholder='Full name' type="text" name="username"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                        <has-error :form="form" field="username"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Add User</button>
                    </div>
                    </div>
                </div>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>
                          <a href="#"><i class="fas fa-pen"></i></a>
                          <a href="#"><i class="fas fa-trash red"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form:new Form({
                    name: '',
                    email: '',
                    password: '',
                    role: '',
                    bio: '',
                    photo: '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
