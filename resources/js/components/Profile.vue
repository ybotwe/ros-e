<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div
            class="widget-user-header text-white"
            style="background:url('./img/user-cover.jpg') center center;"
          >
            <h3 class="widget-user-username text-right">{{ this.form.name }}</h3>
            <h5 class="widget-user-desc text-right">{{ this.form.role }}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle profile-img" :src="getProfilePicture()" alt="User Avatar" />
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">3,200</h5>
                  <span class="description-text">SALES</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">13,000</h5>
                  <span class="description-text">FOLLOWERS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">35</h5>
                  <span class="description-text">PRODUCTS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <div class="col-md-12">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <!-- <li class="nav-item">
              <a class="nav-link " href="#activity" data-toggle="tab">Activity</a>
              </li>-->
              <li class="nav-item">
                <a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
              </li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="settings">
                <form class="form-horizontal" @submit.prevent="updateProfile">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input
                        type="text"
                        v-model="form.name"
                        class="form-control"
                        id="inputName"
                        placeholder="Name"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                      />
                      <has-error :form="form" field="name"></has-error>
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
                    <label for="inputAbout" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-10">
                      <textarea
                        class="form-control"
                        v-model="form.bio"
                        name="bio"
                        id="bio"
                        placeholder="About"
                        :class="{ 'is-invalid': form.errors.has('bio') }"
                      ></textarea>
                      <has-error :form="form" field="bio"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile" class="col-sm-2 col-form-label">Profile Picture</label>
                    <div
                      class="input-group col-sm-10"
                      :class="{ 'is-invalid': form.errors.has('photo') }"
                    >
                      <div class="custom-file">
                        <input
                          type="file"
                          class="custom-file-input"
                          id="exampleInputFile"
                          @change="updateProfileImage"
                        />
                        <label class="custom-file-label" for="exampleInputFile">{{ file }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id>Upload</span>
                      </div>
                      <has-error :form="form" field="photo"></has-error>
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
                      <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
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
    updateProfileImage(e) {
      let file = e.target.files[0];
      //   console.log(file);

      let reader = new FileReader();
      if (file["size"] < 2097152) {
        //5242880 -> 5MB
        reader.onloadend = () => {
          this.form.photo = reader.result;
          this.file = file.name;
        };
        reader.readAsDataURL(file);
      } else {
        toast.fire({
          icon: "error",
          title: "Image should be less than 5MB"
        });
      }
    },
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
    },
    getProfilePicture() {
      let photo =
        this.form.photo.length > 100
          ? this.form.photo
          : "img/profile/" + this.form.photo;
      return photo;
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
</style>