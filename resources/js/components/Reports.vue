<template>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Reports Table</h3>
        <div class="card-tools">
          <button class="btn btn-primary" data-toggle="modal" data-target="#addReport">Add Report</button>
        </div>
      </div>
      <div class="card-body">
        <table id="tabel-user" class="table table-hover table-striped">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Creator</th>
              <th class="text-center">Date</th>
              <th class="text-center">Report</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="report in reports.data" :key="report.id_laporan">
              <td class="text-center">{{report.id_laporan}}</td>
              <td class="text-center">{{report.nama}}</td>
              <td class="text-center">{{report.waktu | myDate}}</td>
              <td class="text-center">
                <a data-toggle="modal" data-target="#show" style="cursor:pointer"><i class="fas fa-external-link-alt"></i></a>
              </td>
              <td class="text-center">
                <a href="#">
                  <i class="fa fa-edit text-blue"></i>
                </a>
                /
                <a href="#" @click="deleteReport(report.id_laporan)">
                  <i class="fa fa-trash text-red"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="card-footer">
        <pagination :data="reports" @pagination-change-page="getResults"></pagination>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="addReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addReportLabel">Add report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form @submit.prevent="createReport">
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input v-model="form.nama" type="text" name="nama" class="form-control" :class="{ 'is-invalid': form.errors.has('nama') }">
              <has-error :form="form" field="nama"></has-error>
            </div>
            <div class="form-group">
              <label>Date</label>
              <input v-model="form.waktu" type="date" name="waktu" class="form-control" :class="{ 'is-invalid': form.errors.has('waktu') }">
              <has-error :form="form" field="waktu"></has-error>
            </div>
            <div class="form-group">
              <label>Report Title</label>
              <input v-model="form.title_laporan" type="text" name="title_laporan" class="form-control" :class="{ 'is-invalid': form.errors.has('title_laporan') }">
              <has-error :form="form" field="title_laporan"></has-error>
            </div>
            <div class="form-group">
              <label>Report Content</label>
              <textarea rows="5" v-model="form.body_laporan" type="text" name="body_laporan" class="form-control" :class="{ 'is-invalid': form.errors.has('body_laporan') }"></textarea>
              <has-error :form="form" field="body_laporan"></has-error>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showLabel">Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      reports: {},
      form: new Form({
        nama: '',
        title_laporan: '',
        body_laporan: '',
        waktu: '',
      })
    }
  },
  methods: {
    deleteReport(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {

        //send req to server
        if (result.isConfirmed) {
          this.form.delete('api/report/' + id).then(() => {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your report data has been deleted.',
              'success'
            )
            Fire.$emit('AfterChange');

          }).catch(() => {
            Swal("Failed!", "There was something wrong.", "warning");
          })
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your report data is safe :)',
            'error'
          )
        }
      })
    },
    getResults(page = 1) {
      axios.get('api/report?page=' + page)
        .then(response => {
          this.reports = response.data;
        });
    },
    loadReports() {
      axios.get('api/report').then(({
        data
      }) => (this.reports = data));
    },
    createReport() {
      this.$Progress.start()
      this.form.post('api/report')
        .then(() => {
          Fire.$emit('AfterChange');
          $('#addReport').modal('hide')

          Toast.fire({
            icon: 'success',
            title: 'Report added successfully'
          })
          this.$Progress.finish()

        })
        .catch(() => {

        })
    }
  },
  created() {
    this.loadReports();
    Fire.$on('AfterChange', () => {
      this.loadReports()
    })
    // setInterval(() => this.loadReports(), 3000);
  },
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
