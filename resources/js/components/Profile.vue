<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="card-body mt-4" style="background-color:white; border-radius: 20px;">
            
                <form class="form-horizontal" @submit.prevent="updateProfile">
                  <div class="form-group">
                    <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input
                        type="text"
                        v-model="form.firstname"
                        class="form-control"
                        id="firstname"
                        placeholder="First Name"
                        :class="{ 'is-invalid': form.errors.has('firstname') }"
                      />
                      <has-error :form="form" field="firstname"></has-error>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input
                        type="text"
                        v-model="form.lastname"
                        class="form-control"
                        id="lastname"
                        placeholder="Last Name"
                        :class="{ 'is-invalid': form.errors.has('lastname') }"
                      />
                      <has-error :form="form" field="lastname"></has-error>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        id="inputEmail"
                        placeholder="Email"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                      />
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input
                        type="password"
                        class="form-control"
                        id="inputPassword"
                        placeholder="Password"
                        v-model="form.password"
                        :class="{ 'is-invalid': form.errors.has('password') }"
                      />
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="ml-3 col-sm-10">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
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
      edit: false,
      user: {},
      file: "Choose file",
      form: new Form({
        id: "",
        firstname: "",
        lastname: "",
        email: "",
        password: "",
      })
    };
  },
  methods: {
    
    updateProfile() {
      this.$Progress.start();
      this.form
        .put("api/profile")
        .then(() => {
        //   Fire.$emit("ProfileUpdated");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.form
      .get("api/profile")
      .then(({ data }) => (this.user = this.form.fill(data)));
    // Fire.$on("ProfileUpdated", () => {
    //   this.form
    //   .get("api/profile")
    //   .then(({ data }) => (this.user = this.form.fill(data)));
    // });
  }
};
</script>

<style>
.widget-user-header {
  height: 300px;
  background-size: cover;
}
</style>s