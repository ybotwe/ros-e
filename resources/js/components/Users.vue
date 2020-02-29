<template>
  <div class="container">
    <div class="col-md-12" v-show="$gate.canManage()">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Users</h3>

          <div class="card-tools">
            <button class="btn btn-success" @click="newModal">
              <i class="fas fa-plus"></i> New User
            </button>
            <!-- Modal -->
            <div
              class="modal fade"
              id="newUser"
              tabindex="-1"
              role="dialog"
              aria-labelledby="newUserTitle"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" v-show="!edit" id="newUserTitle">Add new user</h5>
                    <h5 class="modal-title" v-show="edit" id="newUserTitle">Update user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form @submit.prevent="edit?updateUser():createUser()">
                    <div class="modal-body">
                      <div class="form-group">
                        <input
                          v-model="form.name"
                          placeholder="Full name"
                          type="text"
                          name="name"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('name') }"
                        />
                        <has-error :form="form" field="name"></has-error>
                      </div>
                      <div class="form-group">
                        <input
                          v-model="form.email"
                          placeholder="Email"
                          type="email"
                          name="email"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('email') }"
                        />
                        <has-error :form="form" field="email"></has-error>
                      </div>
                      <div class="form-group">
                        <textarea
                          v-model="form.bio"
                          placeholder="Short Description"
                          type="text"
                          name="bio"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('bio') }"
                        ></textarea>
                        <has-error :form="form" field="bio"></has-error>
                      </div>
                      <div class="form-group">
                        <select
                          v-model="form.role"
                          name="role"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('role') }"
                        >
                          <option value>Select user role</option>
                          <option value="admin">Admin</option>
                          <option value="user">Standard User</option>
                          <option value="author">Author</option>
                        </select>
                        <has-error :form="form" field="role"></has-error>
                      </div>
                      <div class="form-group">
                        <input
                          v-model="form.password"
                          placeholder="Password"
                          type="password"
                          name="password"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('password') }"
                        />
                        <has-error :form="form" field="password"></has-error>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button v-show="!edit" type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add User
                      </button>
                      <button v-show="edit" type="submit" class="btn btn-success">
                        <i class="fas fa-pen"></i> Update User
                      </button>
                    </div>
                  </form>
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
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users.data" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role | textUpper }}</td>
                <td>{{ user.created_at | cutDate }}</td>
                <td>
                  <a href>
                    <i class="fas fa-pen" @click.prevent="editModal(user)"></i>
                  </a>/
                  <a href @click.prevent="deleteUser(user.id)">
                    <i class="fas fa-trash red"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <pagination :data="users" @pagination-change-page="getResults"></pagination>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div v-if="!$gate.canManage()">
      <error-404></error-404>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      edit: false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        role: "",
        bio: "",
        photo: ""
      })
    };
  },
  methods: {
    getResults(page = 1) {
      axios.get("api/user?page=" + page).then(response => {
        this.users = response.data;
      });
    },
    editModal(user) {
      this.edit = true;
      this.form.reset();
      $("#newUser").modal("show");
      this.form.fill(user);
    },
    newModal() {
      this.edit = false;
      this.form.reset();
      $("#newUser").modal("show");
    },
    start() {
      this.$Progress.start();
    },
    finish() {
      this.$Progress.finish();
    },
    fail() {
      this.$Progress.fail();
    },
    loadUsers() {
      if (this.$gate.canManage()) {
        axios.get("api/user").then(({ data }) => (this.users = data));
      }
    },
    createUser() {
      this.form
        .post("api/user")
        .then(() => {
          this.start();
          Fire.$emit("LoadUsers");
          $("#newUser").modal("hide");
          toast.fire({
            icon: "success",
            title: "User created successfully"
          });
          Fire.$emit("LoadUsers");
          this.finish();
        })
        .catch(() => {
          toast.fire({
            icon: "error",
            title: "An error occured"
          });
        });
    },
    deleteUser(id) {
      //Send DELETE request
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        })
        .then(result => {
          if (result.value) {
            this.form
              .delete("api/user/" + id)
              .then(result => {
                Fire.$emit("LoadUsers");
                swal.fire("Deleted!", "User has been deleted.", "success");
              })
              .catch(() => {
                swal.fire(
                  "Failed!",
                  "An error occured while deleting.",
                  "error"
                );
              });
          }
        });
    },
    updateUser() {
      // console.log('updating');
      this.start();
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          Fire.$emit("LoadUsers");
          $("#newUser").modal("hide");
          toast.fire({
            icon: "success",
            title: "User updated successfully"
          });
          Fire.$emit("LoadUsers");
          this.finish();
        })
        .catch(() => {
          this.fail();
        });
    }
  },
  created() {
    // console.log(this.$gate.canManage());
    Fire.$on("searching", () => {
      let query = this.$parent.query;
      axios
        .get("api/findUser?q=" + query)
        .then(data => {
          this.users = data;
        })
        .catch(() => {});
    });
    this.loadUsers();
    Fire.$on("LoadUsers", () => {
      this.loadUsers();
    });

    // setInterval(()=>this.loadUsers(),3000);
  }
};
</script>
