<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-primary">
            <h3>Dafa Berlian</h3>
        </div>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="/img/dafa.png" alt="User Avatar">
        </div>
        <div class="card-footer"></div>
    </div>
    <!-- /.widget-user -->
    </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <div class="card">
        <div class="card-body">
        <div class="tab-content">
            <form class="form-horizontal">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName2" placeholder="Name">
                </div>
                </div>
                <div class="form-group row">
                <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                </div>
                </div>
                <div class="form-group row">
                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                </div>
                </div>
                <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                    </div>
                </div>
                </div>
                <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
                </div>
            </form>
        </div>
        <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
    </div>
  </div>
</div>
</template>

<script>
export default {
    data() {
    return {
      form: new Form({
        id:'',
        name: '',
        email: '',
        password: '',
        profile_picture: '',
      })
    }
  },
  created(){
      axios.get('api/profile')
      .then(({data}) => (this.form.fill(data)));
  },
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
